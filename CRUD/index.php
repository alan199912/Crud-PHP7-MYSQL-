<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center">Listado de personas</h1>

      <?php if(isset($_SESSION['message'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php $_SESSION['message'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertar">
        Nueva Persona
      </button>

      <br>
      <br>

      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Genero</th>
      <th scope="col">DNI</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>
    </tr>
  </thead>
  <tbody>

    <!-- registros de la bbdd -->
    <?php
    include_once("listar.php");
    #Antes del bucle declaramos la variable que usaremos para concatenar
    $html="";
    while($row = mysqli_fetch_assoc($sentencia)) {
        #OJO aquí al uso de .= que sirve para concatenar en PHP
        #En los <td> usamos indices sin comillas simples (ver punto 3 más abajo)
        $html.="<tr>
                    <td>$row[id]</td>
                    <td>$row[nombre]</td>
                    <td>$row[apellidos]</td>
                    <td>$row[genero]</td>
                    <td>$row[DNI]</td>
                    <td><button type='button' class='btn btn-warning editarbtn' data-toggle='modal' data-target='#editar'>
                      Editar
                    </button></td>
                    <td><button type='button' class='btn btn-danger eliminarbtn' data-toggle='modal' data-target='#eliminar'>
                      Eliminar
                    </button></td>
                </tr>";
    }
    #Imprimos los datos concatenados una vez terminado el while
    echo $html;

?>
  </tbody>
</table>

    </div>

<!-- Modal Insertar -->
  <div class="modal fade" id="insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Persona</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- formualrio -->

          <form class=""  action="registrar.php" method="post">
            <div class="form-group">
              <label for="">Nombre</label>
              <input type="text" name="nombre" value="" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Apellidos</label>
              <input type="text" name="apellidos" value="" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Genero</label>
              <select class="form-control" name="genero">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">DNI</label>
              <input type="number" name="DNI" value="" class="form-control">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>


  <!-- Modal Editar -->
  <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Persona</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- formualrio -->

          <form class=""  action="editar.php?id=' . $id '" method="post">
            <input type="hidden" name="id" id="update_id" value="">
            <div class="form-group">
              <label for="">Nombre</label>
              <input type="text" name="nombre" value="" id="nombre" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Apellido</label>
              <input type="text" name="apellidos" value="" id="apellidos" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Genero</label>
              <select class="form-control" name="genero" id="genero">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">DNI</label>
              <input type="number" name="DNI" value="" id="dni" class="form-control">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
              <button type="submit" class="btn btn-primary" name="editar">Editar</button>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>


  <!-- Modal Eliminar -->
    <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar Persona</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <!-- formualrio -->

            <form class=""  action="eliminar.php?id_E=' . $id_E '" method="post">
              <input type="hidden" name="id_E" id="update_id_E" value="">
              <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" name="nombre_E" value="" id="nombre_E" class="form-control" readonly="readonly">
              </div>

              <div class="form-group">
                <label for="">Apellido</label>
                <input type="text" name="apellidos_E" value="" id="apellidos_E" class="form-control" readonly="readonly">
              </div>

              <div class="form-group">
                <label for="">Genero</label>
                <select class="form-control" name="genero_E" id="genero_E" readonly="readonly">
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                </select>
              </div>

              <div class="form-group">
                <label for="">DNI</label>
                <input type="number" name="DNI_E" value="" id="dni_E" class="form-control" readonly="readonly">
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger" name="eliminar">Eliminar</button>
              </div>

            </form>

          </div>

        </div>
      </div>
    </div>


    <script>

    // Editar

      $('.editarbtn').on('click', function() {
        $tr = $(this).closest('tr');
        var datos = $tr.children('td').map(function() {
          return $(this).text();
        });

        $('#update_id').val(datos[0]);
        $('#nombre').val(datos[1]);
        $('#apellidos').val(datos[2]);
        $('#genero').val(datos[3]);
        $('#dni').val(datos[4]);

      });

      // eliminar

      $('.eliminarbtn').on('click', function() {
        $tr = $(this).closest('tr');
        var datosEliminar = $tr.children('td').map(function() {
          return $(this).text();
        });

        $('#update_id_E').val(datosEliminar[0]);
        $('#nombre_E').val(datosEliminar[1]);
        $('#apellidos_E').val(datosEliminar[2]);
        $('#genero_E').val(datosEliminar[3]);
        $('#dni_E').val(datosEliminar[4]);
      });

    </script>
  </body>
</html>
