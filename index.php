<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicacion web hibrida</title>
    
</head>
<body>
    <form>
    <div class="centrar-a">
        <label for="">Buscar Autor</label>
        <input id="texto" type="text" class="texto-libro" onkeyup="validarForm(this.value)">
        <p class="respuesta"></p>
    </div>
    </form>
    <script>
        function validarForm(str){
    let texto = document.querySelector('#texto').value;
    let ex = new RegExp(/[A-Za-z\sáéíóú]/);
    let res = ex.test(texto);

    if(texto === ''){
        document.querySelector('.respuesta').innerHTML="No puede estar vacio"; 
    }else{
            if(!res){
               document.querySelector('.respuesta').innerHTML="No se pueden poner numeros";     
            }else{
                if(str.length == 0){
                    document.querySelector('.respuesta').innerHTML="";
                    return;   
                }else{
                let xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.querySelector(".respuesta").innerHTML=xhr.responseText;
                    }
                };
                xhr.open("GET","cliente.php?q="+str,true);

                xhr.send();
            }
        }
    }
        
}
    </script>

    <?php include 'cliente.php' ?>
    
    

    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>