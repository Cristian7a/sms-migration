function nuevo_id(id,valor){
    var doc= document.getElementById(id);
      doc.setAttribute('value',valor);
    } 

function contar(){
        alert("Dentro de script");
        var checkboxes = document.getElementById("enviar").checkbox;
        var cont = 0; 
        alert("Despues de declaracion de variables");
        for(var x=0; x < checkboxes.length; x++){
            alert("Dentro de FOR");
            if (checkboxes[x].checked) {
                alert("Dentro de IF");
                cont = cont + 1;
                alert("Despues del conteo");
            }
        }
        nuevo_id("cuenta","4");
    }  