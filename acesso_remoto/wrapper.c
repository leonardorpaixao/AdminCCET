#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdio.h>
  int
  main (int argc, char *argv[])
  {
     setuid (0);
     char String[255];
     sprintf(String, "/usr/bin/python /srv/http/site/acesso_remoto/check_host.py  %s %s ", argv[1], argv[2]);

     /* WARNING: Only use an absolute path to the script to execute,
      *          a malicious user might fool the binary and execute
      *          arbitary commands if not.
      * */

     system (String);

     return 0;
   }