<?php

  include_once("conexion.php");

  if(isset($_POST['guardar'])) {

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $genero = $_POST["genero"];
    $dni = $_POST["DNI"];

    $query = "INSERT INTO personas(nombre,apellidos,genero,dni)VALUES('$nombre','$apellidos','$genero','$dni')";

    $result = mysqli_query($conn, $query);

    if(!$result) {
      die("fallo");
    }

    $_SESSION['message'] = 'Persona guardada satisfactoriamente';
    $_SESSION['message_tipo'] = 'success';

    header("Location:index.php");
  }

 ?>
