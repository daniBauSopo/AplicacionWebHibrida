<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
 <body>

<?php
// Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_autor") 
{
    //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
    $app_info = file_get_contents('http://localhost/Ejercicio/api.php?action=get_datos_autor&id=' . $_GET["id"]);
    // Se decodifica el fichero JSON y se convierte a array
    $app_info = json_decode($app_info, true);
    $array_datos=[$app_info];
?>
    <?php foreach($app_info as $infor){
         for( $i = 1;$i<count($infor) ; $i++ ){
            $nombre =  $infor["nombre"];
            $apellido = $infor["apellidos"];
            $nacionalidad = $infor["nacionalidad"];
    } } ?>
    <div class="contenedor-padre lista">
        <div class="autor--izq">
                <table>
                        <tr>
                            <td>Nombre: </td><td> <?php echo $nombre ?> </td>
                        </tr>
                        <tr>
                            <td>Apellidos: </td><td> <?php echo $apellido ?> </td>
                        </tr>
                        <tr>
                            <td>Nacionalidad: </td><td> <?php echo $nacionalidad ?> </td>
                        </tr>
                </table>
        </div>
        <div class="autor--derecha">
                <table>
                <?php foreach($app_info as $inf){ ?>
                    <tr>
                        <td>Titulo: </td><td> <?php echo $inf["titulo"] ?></td>
                    </tr>
                    <tr>
                        <td>Fecha de publicacion: </td><td> <?php echo $inf["f_publicacion"] ?></td>
                    </tr>
                    <?php } ?>
                </table>
        </div>
        <br />
        
        <!-- Enlace para volver a la lista de autores -->
        
    </div>
    <div class="centrar-a">
    <a class="debajo-a" href="http://localhostEjercicio/index.php?action=get_lista_autores" alt="Lista de autores">Volver a la lista de autores</a>
    </div>
<?php
}
else if(!isset($_REQUEST["q"])){
//sino muestra la lista de autores

    // Pedimos al la api que nos devuelva una lista de autores. La respuesta se da en formato JSON
    $lista_autores = file_get_contents('http://localhost/Ejercicio/api.php?action=get_lista_autores');
    // Convertimos el fichero JSON en array
	
    $lista_autores = json_decode($lista_autores, true);
    $array_autores=[$lista_autores];
    
?>
    <div class="centrar">
        <div class="lista">
            <ul>
            <!-- Mostramos una entrada por cada autor -->
            <p class="titulo">Escritores</p>
            <?php foreach($lista_autores as $autores): ?>
                <li>
                    <!-- <?php var_dump($autores); ?> -->
                    <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                    <a class="elemento" href="<?php echo "http://localhost/Ejercicio/index.php?action=get_datos_autor&id=" . $autores["id"]  ?>">
                        <?php echo $autores["nombre"] . " " . $autores["apellidos"] ?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
  <?php
} 
// Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_libro") 
{
    //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
    $app_info = file_get_contents('http://localhost/Ejercicio/api.php?action=get_datos_libro&id=' . $_GET["id"]);
    // Se decodifica el fichero JSON y se convierte a array
    $app_info = json_decode($app_info, true);


?>
    <div class="centrar " >
        <div class="lista">
            <table class="tabla-libro">
                <tr>
                    <td>Titulo: </td><td> <?php echo $app_info["titulo"] ?></td>
                </tr>
                <tr>
                    <td>Fecha de publicacion: </td><td> <?php echo $app_info["f_publicacion"] ?></td>
                </tr>
                <tr>
                    <td>Nombre Autor: </td><td> <?php echo $app_info["nombre"] ?></td>
                </tr>
                <tr>
                    <td>Apellido Autor: </td><td> <?php echo $app_info["apellidos"] ?></td>
                </tr>
                <tr>
                    <td>
                     <a class="boton-id" href="<?php echo "http://localhost/Ejercicio/index.php?action=get_datos_autor&id=" . $app_info["id_autor"] ?>">
                    ID Autor: </a> </td><td> <?php echo $app_info["id_autor"] ?></td>
                </tr>

            </table>
    <br />
        </div>
    </div>
    <!-- Enlace para volver a la lista de autores -->
    <div class="centrar-a">
    <a class="debajo-a" href="http://localhost/Ejercicio/index.php?action=get_lista_libros" alt="Lista de libros">Volver a la lista de libros</a>
    </div>
<?php
}else if(isset($_REQUEST["q"])){
    $lista_libros = file_get_contents('http://localhost/Ejercicio/api.php?action=get_lista_libros');
// Convertimos el fichero JSON en array
$lista_libros = json_decode($lista_libros, true);
$array_autores=[$lista_libros];


 $q=$_REQUEST["q"];
            $hint = "";
            if($q !== ""){
                $q=strtolower($q); 
                $len=strlen($q);
                ?>
        <div class="centrar">
            <div class="lista" id="list-libros">
                <ul>
                <p class="titulo">Autor Buscado</p>
                <?php
                
                foreach($lista_libros as $libro){
                    
                    if (stristr($q, substr($libro["nombre"],0,$len))) { ?>
                   
                        <li>
                        <a class="elemento" href="<?php echo "http://localhost/Ejercicio/index.php?action=get_datos_libro&id=" . $libro["id"]  ?>">
                        <?php echo  $libro["nombre"] . " -> " . $libro["id"] . " - " . $libro["titulo"] ?>
                    </a>
                        </li>
                  <?php  }
                 } ?>
                </ul>
            </div>
        </div>
           <?php     
            } 
}
else if(!isset($_REQUEST["q"])) //sino muestra la lista de autores
{
    // Pedimos al la api que nos devuelva una lista de autores. La respuesta se da en formato JSON
    $lista_libros = file_get_contents('http://localhost/Ejercicio/api.php?action=get_lista_libros');
    // Convertimos el fichero JSON en array
	
    $lista_libros = json_decode($lista_libros, true);
    $array_autores=[$lista_libros];
    
?>
    <div class="centrar">
        <div class="lista" id="list-libros">
            <ul>
            <!-- Mostramos una entrada por cada autor -->
            <p class="titulo">Libros</p>
            <?php foreach($lista_libros as $libro): ?>
                <li>
                    
                    <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                    <a class="elemento" href="<?php echo "http://localhost/Ejercicio/index.php?action=get_datos_libro&id=" . $libro["id"]  ?>">
                        <?php echo $libro["id"] . " " . $libro["titulo"]?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
  <?php
}
              

?>
 </body>
</html>