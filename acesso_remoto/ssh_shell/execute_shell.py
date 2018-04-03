#!/usr/bin/python
import threading
from queue import Queue
import sys
import subprocess

lock = threading.Lock()    #evitando uso simultaneo


# O que cada thread  vai  fazer
def executassh(host,usuario,senha,comando):
	len_senha=len(senha)

	point_to_passwd=0
	check_loop=True


	while check_loop:
		if point_to_passwd == len_senha:
			print(host,"\nNenhuma senha é valida para conexão")
			break
		received_from_sh=subprocess.run(["/srv/http/site/acesso_remoto/ssh_shell/execute_ssh.sh",senha[point_to_passwd],usuario,host,comando],stdout=subprocess.PIPE,stderr=subprocess.PIPE)
		#variavel=subprocess.call(["pacman","Sy"])
		#saida=(str) (received_from_sh.stdout)

		if not received_from_sh.stdout.decode("utf-8"):                                              #verifica sem tem stdout, se tiver vai para else 
			pass
		else:
			print(host,"\n"+received_from_sh.stdout.decode("utf-8"))
			check_loop=False	


		if not received_from_sh.stderr.decode("utf-8"):  #verifica se tem erro, se tiver cai no else  
			pass
		else:
			if (received_from_sh.stderr.decode("utf-8") == "Permission denied, please try again.\r\n"):   #verifica se é erro de autenticação
				print("sennha alterada")
				point_to_passwd=point_to_passwd + 1                                                      #incrementa ponteiro para proxima senha
			else:	                                                                                    #não foi erro de autenticação exiba
				print(host,"\nerros e Warningns :",received_from_sh.stderr.decode("utf-8"))	
				check_loop=False




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

                
