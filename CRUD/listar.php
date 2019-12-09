<?php
  // incluye todo lo que contiene
  include_once("conexion.php");

  $query = "SELECT * FROM `personas`";

  $sentencia = mysqli_query($conn, $query);

  //$personas = $sentencia->fetchAll(PDO::FETCH_OBJ());  // devuelve todas las filas de la bbdd
  /*while($row = mysqli_fetch_array($sentencia)){
  print_r($row);
}*/
  //print_r($personas);

 ?>
