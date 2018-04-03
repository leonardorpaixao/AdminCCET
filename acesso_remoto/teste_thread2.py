#!/usr/bin/python
import threading
from queue import Queue
import sys
import time
import paramiko as p

lock = threading.Lock()    #evitando uso simultaneo


# O que cada thread  vai  fazer
def executassh(pc,usuario,array_senha,comando):
	time.sleep(.5)
	flag=False #flag para loop
	flag_s=False #flag para atualização de senha
	indice=0;
	tam_array=len(array_senha)
	senha=array_senha[indice]
	client = p.SSHClient()
	client.set_missing_host_key_policy(p.AutoAddPolicy())
	
	while not flag:
	
		try:
			client.connect(pc, username=usuario, password=senha,
			    allow_agent=False, look_for_keys=False,timeout=1.5)
			flag=True
		except IOError:
			print(pc,"\nhost não encontrado\n")
			client.close()		
			break
		except p.SSHException:
			print("Falha de conexão verifique usuarios e senhas, tentativa com a senha: ",senha,", >Tentando senhas anteriores....")
			flag_s=True			
			if indice < (tam_array-1):
				indice=indice+1				
				senha=array_senha[indice]
			else:
				break
			client.close()		
	
	if flag_s:
		comando=comando+";mkdir pass;cd ./pass; echo -e "+array_senha[0]+"'\n'"+array_senha[0]+"'\n' "+" > s.txt;passwd root < s.txt;cd -;rm -rf ./pass"
	if not flag:
		client.close()
		return
	else:
		stdin, stdout, stderr = client.exec_command(comando)
		#print(type(stdout))
		try:		
			#for line in stdout.readlines():
			#	print(line,end="")
			line=stdout.readlines()
			#line[0]="\n"+line[0]
			print(pc,"".join(line))
			t=stderr.readlines()
			qerros=0 if not t  else ''	
			if not t:
				print("~~~~~~~~~ \nErros encontrados : 0\n~~~~~~~~~","\n>Fim de thread\n")			
				#print("Erros encontrados : 0")		
				#print("~~~~~~~~~ ")
			else:
				print("~~~~~~~~~ \n\nErros encontrados : ","\n".join(t),"\n~~~~~~~~~~","\n>Fim de thread\n")						
		except socket.timeout:
			print("Timeout encerrando...\n")
			client.close()
			return
		client.close()
###########################################################
# Organizando as threads, cada thread vai pegar um pc na queue e executarssh. Não há problema no while (true) as threads são deamons e rodam em background.
#O programa principal não parará a execução esperando as threads( q são deamons), espera elas executarem com o q.join e termina, qnd o progrma principal terminar
#as threads tbm irão, parando o laço 
def threader(usuario,senha,comando):
	while True:
		pc = q.get()
		executassh(pc,usuario,senha,comando)
		#
		q.task_done()
 


#############################################################
# 

usuario=sys.argv[1]
senha=sys.argv[2].split("-")

comando=sys.argv[3]

pcs=sys.argv[4].split("-")





###########
#Exemplo de chamada
#/teste_thread2.py usuario senha  ls        127.0.0.1-127.0.0.1
#								 comando	 lista de ips separadaos por '-'
####


q = Queue()

for pc in pcs :
    q.put(pc)




# Determinando qnts threads, uma para cada pc ?
for x in range(len(pcs)):
	#print(x)     
	t = threading.Thread(target=threader,args=(usuario,senha,comando,))

     #as threads  são deamons executam em back ground sem interrromper thread principal
	t.daemon = True

     
	t.start()



# wait until the thread terminates.
q.join()

                
