<?php
/**
 * Archivo que conecta con la base de datos mediante mysqli
 */
$con = new mysqli('localhost','root','','libros');

// if(!$con->connect_error){
           
//     if (!$con->set_charset("utf8")) {
//     printf("Error cargando el conjunto de caracteres utf8: %s\n", $con->error);
//     exit();
//     } else {
//         printf("Conjunto de caracteres actual: %s\n", $con->character_set_name());
//     }
//     echo "Conexion establecida" . $con->host_info . "\n" ;
    
// }

?>