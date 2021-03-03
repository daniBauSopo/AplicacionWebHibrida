<?php
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.
/**
 * Funcion que recibe el archivo de la conexion, hace una consulta a la base
 * de datos con la sentencia query, se hace un while para recorrer las
 * filas resultado de la sentencia y se mete en un array
 * @param no recibe parametros
 * @return la funcion retorna el array de las filas resultado
 */
function get_lista_autores(){
    //Esta información se cargará de la base de datos
    include 'conexion.php';

    $res = $con->query("SELECT * FROM autor");

    $al = [];
    while($fin = $res->fetch_assoc()){
      $al[] = $fin;
    }
    return $al;
}
/**
 * Funcion que recibe el archivo de la conexion,se hace un switch para mostrar
 * datos segun una id pasada hace una consulta a la base
 * de datos con la sentencia query, se hace un while para recorrer las
 * filas resultado de la sentencia y se mete en un array
 * @param no recibe la id
 * @return la funcion retorna el array de las filas resultado
 */
function get_datos_autor($id){
    include 'conexion.php';
    //Esta información se cargará de la base de datos
    switch ($id){
        case 3:
          $res = $con->query("SELECT libro.titulo,libro.f_publicacion,autor.nombre,autor.apellidos,autor.nacionalidad FROM autor,libro WHERE autor.id=libro.id_autor AND autor.id=$id");
          $al = [];
          while($fila = $res->fetch_assoc()){
            $al[] = $fila;
          } 
          break;
        case 4:
          $res = $con->query("SELECT libro.titulo,libro.f_publicacion,autor.nombre,autor.apellidos,autor.nacionalidad FROM autor,libro WHERE autor.id=libro.id_autor AND autor.id=$id");
          $al = [];
          while($fila = $res->fetch_assoc()){
            $al[] = $fila;
          } 
          break;
          default:
          echo "Error";
    }
    
    return $al;
}
/**
 * Funcion que recibe el archivo de la conexion, hace una consulta a la base
 * de datos con la sentencia query, se hace un while para recorrer las
 * filas resultado de la sentencia y se mete en un array
 * @param no recibe parametros
 * @return la funcion retorna el array de las filas resultado
 */
function get_lista_libros(){
  include 'conexion.php';

  $res = $con->query("SELECT autor.nombre,libro.id,libro.titulo FROM libro,autor WHERE libro.id_autor=autor.id");
  $al = [];
    while($fin = $res->fetch_assoc()){
      $al[] = $fin;
    }
    return $al;
}

/**
 * Funcion que recibe el archivo de la conexion,se hace un switch para mostrar
 * datos segun una id pasada hace una consulta a la base
 * de datos con la sentencia query, se hace un while para recorrer las
 * filas resultado de la sentencia y se mete en un array
 * @param no recibe la id
 * @return la funcion retorna el array de las filas resultado
 */
function get_datos_libro($id){
  include 'conexion.php';
  switch($id){
    case 8:
      $res = $con->query("SELECT libro.titulo,libro.f_publicacion,libro.id_autor,autor.nombre,autor.apellidos FROM libro,autor WHERE libro.id_autor=autor.id AND libro.id=$id");
      $fila = $res->fetch_assoc();
      break;
    case 9:
      $res = $con->query("SELECT libro.titulo,libro.f_publicacion,libro.id_autor,autor.nombre,autor.apellidos FROM libro,autor WHERE libro.id_autor=autor.id AND libro.id=$id");
      $fila = $res->fetch_assoc();
      break;
    case 10:
      $res = $con->query("SELECT libro.titulo,libro.f_publicacion,libro.id_autor,autor.nombre,autor.apellidos FROM libro,autor WHERE libro.id_autor=autor.id AND libro.id=$id");
      $fila = $res->fetch_assoc();
      break;
    case 11:
      $res = $con->query("SELECT libro.titulo,libro.f_publicacion,libro.id_autor,autor.nombre,autor.apellidos FROM libro,autor WHERE libro.id_autor=autor.id AND libro.id=$id");
      $fila = $res->fetch_assoc();
      break;
    case 12:
      $res = $con->query("SELECT libro.titulo,libro.f_publicacion,libro.id_autor,autor.nombre,autor.apellidos FROM libro,autor WHERE libro.id_autor=autor.id AND libro.id=$id");
      $fila = $res->fetch_assoc();
      break;
    case 13:
      $res = $con->query("SELECT libro.titulo,libro.f_publicacion,libro.id_autor,autor.nombre,autor.apellidos FROM libro,autor WHERE libro.id_autor=autor.id AND libro.id=$id");
      $fila = $res->fetch_assoc();
      break;
    case 14:
      $res = $con->query("SELECT libro.titulo,libro.f_publicacion,libro.id_autor,autor.nombre,autor.apellidos FROM libro,autor WHERE libro.id_autor=autor.id AND libro.id=$id");
      $fila = $res->fetch_assoc();
      break;
    default:
      $fila = "Error en el switch";
  }
  return $fila;
}

$posibles_URL = array("get_lista_autores", "get_datos_autor","get_lista_libros","get_datos_libro");

$valor = "Ha ocurrido un error";

if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL))
{
  switch ($_GET["action"])
    {
      case "get_lista_autores":
        $valor = get_lista_autores();
        break;
      case "get_datos_autor":
        if (isset($_GET["id"])){
            $valor = get_datos_autor($_GET["id"]);
        }else{
            $valor = "Argumento no encontrado";
        }
        break;
      case "get_lista_libros":
        $valor = get_lista_libros();
        break;
      case "get_datos_libro":
        if (isset($_GET["id"])){
          $valor = get_datos_libro($_GET["id"]);
      }else{
          $valor = "Argumento no encontrado";
      }
      break;
      default:
        echo "Error";
    }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>