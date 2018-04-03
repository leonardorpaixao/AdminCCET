function get_passwd(){
					
					$('#mymodal').css("display","block");
					$('#mymodal').attr("class","modal modal-info in");
					exit=false;
					
					$.ajax({ 
						method:"POST", 
						url:"managerpw.php", 
						cache:false,
						data:{flag:1},
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
function gerar_senha(){
					$('#mymodal').css("display","block");
					$('#mymodal').attr("class","modal modal-info in");
					
					
					$.ajax({ 
						method:"POST", 
						url:"managerpw.php", 
						cache:false,
						data:{flag:2},
						dataType:"html" 
						}).done(function(result){
            					$("#request").html(result);
            					$('#mymodal').css("display","none");
            					$('#mymodal').attr("class","modal modal-info");
            					
								            					
								

    							 }).fail(function(jqXHR, textStatus,erro){
    									if(textStatus === 'timeout'){     
        								alert('Timeout, servidor não respondeu a tempo entre em contanto com o suporte');
        								}else{
        								alert(erro);
        								}
        								$('#mymodal').css("display","none");
            							$('#mymodal').attr("class","modal modal-info");
            							
            									
        								});



}
			