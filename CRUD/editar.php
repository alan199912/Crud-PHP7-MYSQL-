<?php

    include_once("conexion.php");
    if ($conn) {
        $id=!empty($_POST['id']) ? $_POST['id']: NULL;
        $info=array();
        if ($id){
            $query = "SELECT * FROM personas WHERE id = $id";
            if ($result = mysqli_query($conn, $query)) {
                if(mysqli_num_rows($result) > 0) {
                   $row = mysqli_fetch_assoc($result);
                   $nombre = $row['nombre'];
                   $apellidos = $row['apellidos'];
                   $genero = $row['genero'];
                   $dni = $row['DNI'];
                }else{
                    $info[]="No se encontraron filas";
                }
            } else {
                $info[]="Error en la consulta SELECT: {mysqli_error($conn)}";
            }
        } else {
            $info[]="No se pasó el ID";
        }


        if(isset($_POST['editar'])) {
            $nombre=!empty($_POST['nombre']) ? $_POST['nombre']: NULL;
            $apellidos=!empty($_POST['apellidos']) ? $_POST['apellidos']: NULL;
            $genero=!empty($_POST['genero']) ? $_POST['genero']: NULL;
            $dni=!empty($_POST['DNI']) ? $_POST['DNI']: NULL;
            if ($nombre && $apellidos && $genero && $dni) {
                $query = "UPDATE personas set nombre = '$nombre', apellidos = '$apellidos', genero = '$genero', dni = '$dni' WHERE id = $id";
                if($result = mysqli_query($conn, $query)) {
                   $_SESSION['message'] = 'Persona guardada satisfactoriamente';
                   $_SESSION['message_tipo'] = 'primary';
                   header("Location:index.php");
                } else {
                    $info[]="Error en la consulta del UPDATE: {mysqli_error($conn)}";
                }
         }else {
             $info[]="Faltan datos para el UPDATE";
        }
        }else{
            $info[]="No se posteó opción de editar";
        }
    }else{
        $info[]="No hay conexion";
    }
    if ($info) {
        echo implode("\n", $info);
    }


 ?>
