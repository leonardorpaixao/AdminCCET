#!/usr/bin/python

import threading
from queue import Queue
import sys
import subprocess as sb
lock = threading.Lock()    #evitando uso simultaneo

#retorno = sb.getstatusoutput("sudo nmap -p 22,80,445 -O 192.168.25.5  | awk '/Host is/{print 1}/Running:/{print $2}/Host seems down./{print 0;print 0}'")
#print(retorno)





 
# O que cada thread  vai  fazer
def check(host):
	retorno = sb.getstatusoutput("ping -c2 -w2 "+host[1]+" | awk '/ttl/{ split($6,a,\"=\");print a[2];exit}'")
	ttl=-1
	try:
		ttl = int(retorno[1])
	except ValueError:
		ttl = 0	

	if ttl == 0:
		status="0-0"	
	elif ttl <= 64:
		status = "1-Linux"
	elif ttl <=128:
		status = "1-Microsoft"
	elif ttl <= 255:
		status = "1-desconhecido"
	else:
		status="erro"				
	
	saida[host[0]][int(host[1].split('.')[3])]=status
	saida[host[0]][0]='0-0'
	#with lock:
	#	print(host,status)


###########################################################
# Organizando as threads, cada thread vai pegar um pc na queue e executarssh. Não há problema no while (true) as threads são deamons e rodam em background.
#O programa principal não parará a execução esperando as threads( q são deamons), espera elas executarem com o q.join e termina, qnd o progrma principal terminar
#as threads tbm irão, parando o laço 
def threader():
    while True:
        #organizando threads 
        host= q.get()
        
        
        check(host)

        # função especial da queue, para cada get seta que a tarefa do thread foi feita.(Caracteristicas da propria biblioteca o relacionamento com threads). 
        q.task_done()

 


#############################################################
# 
saida=dict();
subredes=sys.argv[1].split("-") #array de subredes 

quants_pcs=sys.argv[2].split("-") #array de pcs em cada laboratorios
quants_pcs=[int(a) for a in quants_pcs] #array da qunat de cada laboratorio em inteiro
total=0;

for t in quants_pcs:               #somadano quants pcs no total
	total=total+t


count=0;

for ip in subredes:
	saida[ip]=[a for a in range(quants_pcs[count]+1)]  #criando dicionario para cada subrede com qnt de pcs
	count=count+1
     

###########
#
#				

q = Queue()
count=0
for x in subredes:
	for y in  range(1, quants_pcs[count]+1):
		tupla=x,x[:-1]+str(y)					#colocando na fila (10.12.34.0,10.12.34.1,10.12.34.0,10.12.34.2)
		q.put(tupla)
	count=count+1




# Determinando qnts threads, uma para cada pc ?
for z in range(total):
	     
	t = threading.Thread(target=threader)

     #as threads  são deamons executam em back ground sem interrromper thread principal
	t.daemon = True

     
	t.start()



# wait until the thread terminates.
q.join()
#print(saida)
for k,v in saida.items():
	#print(k+"->"+"/".join(v))   #mostrar sub-rede
	print("/".join(v))


                
