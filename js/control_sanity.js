//ControledeSanidade

var estado_anterior=new Array();
var pc_selecionados =new Array();








function go_menusanity(lab,op,arg){

//alert("oi");
//var x=$.post( "sanity.php", { name: "keomas" },function() {
//location.replace("/sanidade/");
//document.location.href = "http://localhost/sanidade/";
//});
 //testscore ="tryagain"; //testvalue to enter into the mysql database
  /*$.ajax({  
    type: "POST",  
    url: "teste.php",  
    data: { 'vetor[]':pc_selecionados },      
    success: function(data){  
      alert(data);
    } 
  })*/
if(op=='1'){

post("sanity/",lab);
}else{
 
 aux=''; 
 aux2=new Array();

 for(i=1;i<=parseInt(arg);i++){
    
    if(i<10){
      aux='0'+i;

    }else{


      aux=i;
    }


    aux2.push(aux.toString());

 }

lab=lab+">"+aux2.toString();
  post_todos("sanity/",lab);


}

}




function post_todos(path, lab ,method) {
    method = method || "post"; // Set method to post by default if not specified.
    
    params=lab;
   // alert(params);
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name",'lab' );
    hiddenField.setAttribute("value",params);
    form.appendChild(hiddenField);
         
    

    document.body.appendChild(form);
    form.submit();
}



function post(path, lab ,method) {
    method = method || "post"; // Set method to post by default if not specified.
    if(pc_selecionados.length > 0){
      pc_selecionados.sort();
      params=lab+">"+pc_selecionados.toString();
      // The rest of this code assumes you are not using a library.
      // It can be made less wordy if you use one.
      var form = document.createElement("form");
      form.setAttribute("method", method);
      form.setAttribute("action", path);
      var hiddenField = document.createElement("input");
      hiddenField.setAttribute("type", "hidden");
      hiddenField.setAttribute("name",'lab' );
      hiddenField.setAttribute("value",params);
      form.appendChild(hiddenField);
           
      

      document.body.appendChild(form);
      form.submit();
  }else{

    alert('nenhum pc selecionado');


  }
}




function select_pc(n_pc){

pc_selecionados.push(n_pc);

}

function deselect_pc(n_pc){
var ind=pc_selecionados.lastIndexOf(n_pc);
var aux;
aux=pc_selecionados[0];
pc_selecionados[ind]=aux;
pc_selecionados.shift();



}


function set_class(pc){
  var array =pc.split("-");
  var id="#pc"+pc;
  
  //var power=$('#of').attr('src'); location.replace("http://www.w3schools.com")
  
  var atrib =$(id).attr('class');

  if(atrib == 'buttonok' ){
    $(id).attr({
      "class":"button_selected1",
      "data-toggle":"tooltip",
      "data-original-title":"desfazer"
       
      });
    estado_anterior[parseInt(array[0])]="buttonok";
    select_pc(array[0]);    
    //Ajax aki

  }else if(atrib == 'buttonerro'){
     $(id).attr({
      "class":"button_selected2",
      "data-toggle":"tooltip",
      "data-original-title":"desfazer"
       
      });
    estado_anterior[parseInt(array[0])]="buttonerro";
    select_pc(array[0]);

  }else if(atrib == 'button_selected1'){

    $(id).attr({
      "class":estado_anterior[parseInt(array[0])],
      "data-toggle":"tooltip",
      "data-original-title":"configurar"

      });
    deselect_pc(array[0]);

    
  }else if(atrib == 'button_selected2'){

    $(id).attr({
      "class":estado_anterior[parseInt(array[0])],
      "data-toggle":"tooltip",
      "data-original-title":"configurar"

      });
    deselect_pc(array[0]);

    
  }else{


    alert('erro');
  }  
  
}