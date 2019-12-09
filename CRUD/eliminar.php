<?php

  include_once("conexion.php");
  if ($conn) {
      $id_E=!empty($_POST['id_E']) ? $_POST['id_E']: NULL;
      $info=array();
      if ($id_E){
          $query = "SELECT * FROM personas WHERE id = $id_E";
          if ($result = mysqli_query($conn, $query)) {
              if(mysqli_num_rows($result) > 0) {
                 $row = mysqli_fetch_assoc($result);
                 $nombre = $row['nombre_E'];
                 $apellidos = $row['apellidos_E'];
                 $genero = $row['genero_E'];
                 $dni = $row['DNI_E'];
              }else{
                  $info[]="No se encontraron filas";
              }
          } else {
              $info[]="Error en la consulta SELECT: {mysqli_error($conn)}";
          }
      } else {
          $info[]="No se pasó el ID";
      }


      if(isset($_POST['eliminar'])) {
          $nombre=!empty($_POST['nombre_E']) ? $_POST['nombre_E']: NULL;
          $apellidos=!empty($_POST['apellidos_E']) ? $_POST['apellidos_E']: NULL;
          $genero=!empty($_POST['genero_E']) ? $_POST['genero_E']: NULL;
          $dni=!empty($_POST['DNI_E']) ? $_POST['DNI_E']: NULL;
          if ($nombre && $apellidos && $genero && $dni) {
              $query = "DELETE FROM personas WHERE id = $id_E";
              if($result = mysqli_query($conn, $query)) {
                 $_SESSION['message'] = 'Persona eliminadas satisfactoriamente';
                 $_SESSION['message_tipo'] = 'danger';
                 header("Location:index.php");
              } else {
                  $info[]="Error en la consulta del DELETE: {mysqli_error($conn)}";
              }
       }else {
           $info[]="Faltan datos para el DELETE";
      }
      }else{
          $info[]="No se posteó opción de eliminar";
      }
  }else{
      $info[]="No hay conexion";
  }
  if ($info) {
      echo implode("\n", $info);
  }

 ?>
