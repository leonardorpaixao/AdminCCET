#!/usr/bin/python

import threading
from queue import Queue
import sys
import paramiko as p
import subprocess as sp
print_lock = threading.Lock()    #evitando uso simultaneo


# O que cada thread  vai  fazer
def ip_status2(host):
	status,result = sp.getstatusoutput("ping -c2 -w2 " + host[1])
	x=len(host[1])
	indice=0
	saida[host[0]][indice]='0'
	with print_lock:
		if x == 11:
			#print(host[1][x-2:])
			indice=int(host[1][x-2:])
		else:
			#print(host[1][x-1])
			indice=int(host[1][x-1])
		#print(">>>>>>> ",host[0])
		if status == 0:
			saida[host[0]][indice]='1'
			#print("host" + host[1] + " is UP !")
			#return 1
		else:
			saida[host[0]][indice]='0'
			#print("host " + host[1] + " is DOWN !")
			#return 0



###########################################################
# Organizando as threads, cada thread vai pegar um pc na queue e executarssh. Não há problema no while (true) as threads são deamons e rodam em background.
#O programa principal não parará a execução esperando as threads( q são deamons), espera elas executarem com o q.join e termina, qnd o progrma principal terminar
#as threads tbm irão, parando o laço 
def threader():
    while True:
        #organizando threads 
        host= q.get()

        
        ip_status2(host)

        # função especial da queue, para cada get seta que a tarefa do thread foi feita.(Caracteristicas da propria biblioteca o relacionamento com threads). 
        q.task_done()

 


#############################################################
# 
saida=dict();
subredes=sys.argv[1].split("-") #array de subredes 

quants_pcs=sys.argv[2].split("-") #array de pcs em cada laboratorios
quants_pcs=[int(a) for a in quants_pcs]
total=0;

for t in quants_pcs:
	total=total+t


count=0;
for ip in subredes:
	saida[ip]=[a for a in range(quants_pcs[count]+1)]
	count=count+1
subredes=[x[:-1] for x in subredes]


###########
#
#				

q = Queue()
count=0
for x in subredes:
	for y in  range(1, quants_pcs[count]+1):
		tupla=x+'0',x+str(y)
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

for k,v in saida.items():
	#print(k+"->"+"-".join(v))
	print("-".join(v))


                
