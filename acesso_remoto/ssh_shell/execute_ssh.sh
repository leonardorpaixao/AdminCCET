#!/bin/bash

#senha hostname comandos
sshpass -p $1 ssh -o StrictHostKeyChecking=no -o ConnectTimeout=1 $2@$3 $4 
