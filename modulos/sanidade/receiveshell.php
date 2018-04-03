<?php
include '../../includes/topo.php';

	if(isset($_POST['comandos'])){

								
								
								//echo "$script";
									
								$script=$_POST['comandos'];
								//$scr=preg_replace("/[\n]/",";",$script);
								$scr=preg_replace("/[\r\n]{2,}/", ";", $script);
								//echo $scr."</br>";
								$come2="/srv/http/site/acesso_remoto/ssh_shell/execute_shell.py  ".$_SESSION['user']." ".Atalhos::decode($_SESSION["password"])." "."'".$scr."' ".$_SESSION['ips'];
                                                                

								
								$string=exec($come2,$saida,$status);
								$vetor_h=explode('-',$_SESSION['ips']);
								$vetor_saida=array();
								#echo $saida[0];
								

								//seguda versão


								

								foreach ($saida as $line) {
 							   				
										if (in_array($line,$vetor_h)) {

											$atual=$line;
											$vetor_saida[$atual]="";
										}else{

												$vetor_saida[$atual]=$vetor_saida[$atual].$line."<br/>";


										}


 							   		
									}
									

								echo "<div id=\"saida\">\n";	

								echo "<div class=\"nav-tabs-custom \"> \n".
         								"<ul class=\"nav nav-tabs \"> \n".
         								"<li class=\"active\"><a href=\"#".preg_replace('/\./', '-', $vetor_h[0])."\" data-toggle=\"tab\">"."PC ".$_SESSION['pcs1'][0]."</a></li>\n";
								
         						for($i=1; $i < count($vetor_h);$i++){
         							echo "<li><a href=\"#".preg_replace('/\./', '-', $vetor_h[$i])."\" data-toggle=\"tab\">"."PC ". $_SESSION['pcs1'][$i]."</a></li>\n";
         								

         						}

         						echo "</ul>\n<div class=\"tab-content\"> \n";
								echo "<div class=\"tab-pane active linux\" id=\"".preg_replace('/\./', '-', $vetor_h[0])."\">"; 
								echo "comando: $scr <br/>";
								echo $vetor_saida[$vetor_h[0]];	
								echo "</div>\n";
								for($i=1; $i < count($vetor_h);$i++){
										echo "<div class=\"tab-pane linux\" id=\"".preg_replace('/\./', '-', $vetor_h[$i])."\">";
										echo "comando: $scr <br/>";
										echo $vetor_saida[$vetor_h[$i]];
										echo "</div>\n";

								}
								

								echo"</div>\n</div>\n</div>";
								
								
							}


	?>
