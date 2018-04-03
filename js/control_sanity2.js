function get_labs(data1,id,data2){
id="#"+id;
$(id).html('<div id="test" class="teste"></div>');

$.ajax({ 
						method:"POST", 
						url:"response_labs/", 
						cache:false,
						
						data:{lab:data1,pcs:data2},
						dataType:"html" 
						}).done(function(result){
            					$(id).html(result);
            					

    							 }).fail(function(jqXHR, textStatus,erro){
    									if(textStatus === 'timeout'){     
        								alert(' servidor não respondeu a tempo entre em contanto com o suporte');
        								}else{
        								alert(erro);
        								}
        										
        								});

		




}

