		//referente ao execuções 
		var request;	
		function get_request(comd){
					var cmd="";
					if(comd === undefined ){

					cmd=document.getElementById("comandos").value;
					}else{

						cmd=comd;
					}
					$('#mymodal').css("display","block");
					$('#mymodal').attr("class","modal modal-info in");
					exit=false;
					
					request=$.ajax({ 
						method:"POST", 
						url:"receiveshell/", 
						cache:false,
						data:{comandos:cmd},
						dataType:"html" 
						}).done(function(result){
            					$("#request").html(result);
            					$('#mymodal').css("display","none");
            					$('#mymodal').attr("class","modal modal-info");
            					
								exit=true;            					
								

    							 }).fail(function(jqXHR, textStatus,erro){
    									if(textStatus === 'timeout'){     
        								alert('Timeout, servidor não respondeu a tempo entre em contanto com o suporte');
        								}else{
        								alert(erro);
        								}
        								$('#mymodal').css("display","none");
            							$('#mymodal').attr("class","modal modal-info");
            							
            							exit=true;		
        								});

		
			}
			function interrupt(){
				
				request.abort();

				method = "post"; // Set method to post by default if not specified.
    
			   // alert(params);
			    // The rest of this code assumes you are not using a library.
			    // It can be made less wordy if you use one.
			    var form = document.createElement("form");
			    form.setAttribute("method", method);
			    form.setAttribute("action","back/");
			    var hiddenField = document.createElement("input");
			    hiddenField.setAttribute("type", "hidden");
			    hiddenField.setAttribute("name",'kill' );
			    hiddenField.setAttribute("value","1");
			    form.appendChild(hiddenField);
			         
			    

			    document.body.appendChild(form);
			    form.submit();


			}
			//referentes a espelhemaneto
			function show_list(){
					
				
				exit=false;
				request=$.ajax({ 
						method:"POST", 
						url:"controleEspelhamento.php", 
						cache:false,
						data:{op:0},
						dataType:"html" 
						}).done(function(result){
            					$("#tabela").html(result);
            					
            					
								exit=true;            					
								

    							 }).fail(function(jqXHR, textStatus,erro){
    									if(textStatus === 'timeout'){     
        								alert('Timeout, servidor não respondeu a tempo entre em contanto com o suporte');
        								}else{
        								alert(erro);
        								}
        								$('#mymodal').css("display","none");
            							$('#mymodal').attr("class","modal modal-info");
            							
            							exit=true;		
        								});





				$("#bodylist").css("height","300px");
				$("#bodylist").css("overflow-y","auto");
				$('#lista').modal("toggle");
			}

			


			function add_pacote(){

				var pkg = document.getElementById("nomepacote").value;
					$('#lista').modal("hide");	
					exit=false;
					
					request=$.ajax({ 
						method:"POST", 
						url:"controleEspelhamento.php", 
						cache:false,
						data:{pacote:pkg,op:1},
						dataType:"html" 
						}).done(function(result){
            					
            					alert("Pacote Adicionado");
            					show_list();
								exit=true;            					
								

    							 }).fail(function(jqXHR, textStatus,erro){
    									if(textStatus === 'timeout'){     
        								alert('Timeout, servidor não respondeu a tempo entre em contanto com o suporte');
        								}else{
        								alert(erro);
        								}
        								$('#mymodal').css("display","none");
            							$('#mymodal').attr("class","modal modal-info");
            							
            							exit=true;		
        								});		


			}


		function del(pacote){
			var pkg = pacote.replace(/[\n\r]+/g,'');
				$('#lista').modal("hide");	
					exit=false;
					
					request=$.ajax({ 
						method:"POST", 
						url:"controleEspelhamento.php", 
						cache:false,
						data:{pac:pkg,op:2},
						dataType:"html" 
						}).done(function(result){
            					
            					alert("Pacote removido");
            					show_list();
								exit=true;            					
								

    							 }).fail(function(jqXHR, textStatus,erro){
    									if(textStatus === 'timeout'){     
        								alert('Timeout, servidor não respondeu a tempo entre em contanto com o suporte');
        								}else{
        								alert(erro);
        								}
        								$('#mymodal').css("display","none");
            							$('#mymodal').attr("class","modal modal-info");
            							
            							exit=true;		
        								});		



		}
		function espelha(){
			$('#lista').modal("hide");
			get_request('wget -O /opt/lista.txt  https://admin.dcomp.ufs.br/log/lista.txt; cd /opt/; pacman -Sy --noconfirm --needed $(< lista.txt)');



		}	

