<?php 
session_start();
?>
<!DOCTYPE html> 

<html lang="en"> 

<head> 

    <meta charset="UTF-8"> 

    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 

    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link rel="stylesheet" href="Css/bootstrap.min.css"> 

    <link rel="stylesheet" href="Css/registrar.css"> 
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" charset="utf-8"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 

    <title>Document</title> 

</head> 

<body> 

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> 

        <div class="container-fluid"> 

          <a class="navbar-brand" href="Index.php">PaintArt</a> 

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation"> 

            <span class="navbar-toggler-icon"></span> 

          </button> 

          <div class="barraBusqueda"> 

              <thead>
                <form class="d-flex " style="height: 40px;" action="../controlador/controllerBusqueda.php" method="POST">
                  <input name="buscador" class=" form-control Search"  style=" margin-right:3px;margin-top: 2px; " type="text" placeholder="Buscar">
                  <select name="modo" class="form-select " style="width: 120px; margin-right:2px ;background-color: #f0ad4e; border-color: #f0ad4e; color:black" name="" id="">
                    <option value="artista"><h6>Artista</h6> </option>
                    <option value="obra">Obra</option>
                  </select>
                  <button class="btn btn-secondary my-2 my-sm-0" style="height:40px ;" type="submit">Buscar</button>
                </form>
              </thead>
            </div> 
            <div class="login"> 
              <table> 
                
              </table> 
            </div> 
        </div> 
      </nav> 
      <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
      <ul class="navbar-nav me-auto barrita"> 
        <div class="collapse navbar-collapse" id="navbarColor03"> 
            <li class="nav-item"> 
              <a class="nav-link active" href="Index.php">Inicio 
                <span class="visually-hidden">(current)</span> 
              </a> 
            </li> 
            <li class="nav-item"> 
              <a class="nav-link" href="listaNoticias.php">Noticias</a> 
            </li> 
            <li class="nav-item"> 
            <a class="nav-link" href="listaObras.php?cat=100">Obras populares</a>
            </li>
            <li class="nav-item dropdown"> 
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categorias</a>
              <div class="dropdown-menu" > 
                <a class="dropdown-item" href="#">Urbano</a> 
                <a class="dropdown-item" href="#">Optico</a> 
                <a class="dropdown-item" href="#">Cinetico</a> 
                <a class="dropdown-item" href="#">Surrealismo</a> 
                <a class="dropdown-item" href="#">Neoplasticismo</a> 
                <a class="dropdown-item" href="#">Dadaismo</a> 
                <a class="dropdown-item" href="#">Suprematismo</a> 
                <a class="dropdown-item" href="#">Constructivismo</a> 
                <a class="dropdown-item" href="#">Minimalismo</a> 
                <a class="dropdown-item" href="#">Rayonismo</a> 
                <a class="dropdown-item" href="#">Abastraccion lirica</a> 
                <a class="dropdown-item" href="#">Expresionismo</a> 
              </div> 
            </li> 
          </div> 
        </ul> 
      </nav> 
      <div class="container" style="background-color: #f8f9fa;
      border: 1px solid #dee2e6;"> 
             <h2 style="margin-top: 20px;">Registrar</h2>
            <div class="form-group formulario" >   
                <table class="formularioRegistrar"> 
                  <form action="../controlador/controllerRegistrar.php" method="post" enctype="multipart/form-data">
                     
                    <tr> 
                      <td><h5>Nombres</h5></td> 
                    </tr> 
                    <tr>
                        <td><input type="text" name="NOMBRE" class="form-control" placeholder="Nombres" id="inputDefault" required></td>
                    </tr>
                    <tr> 
                      <td><h5>Apellidos</h5></td> 
                    </tr> 
                    <tr>
                        <td> <input type="text" name="APELLIDO" class="form-control" placeholder="Apellidos" id="inputDefault" required></td> 
                    </tr>
                    <tr> 
                      <td><h5>rut</h5></td> 
                    </tr> 
                    <tr>
                        <td> <input type="text"  name="RUT" class="form-control" placeholder="Rut" id="inputDefault" required></td> 
                    </tr>
                    <tr> 
                      <td><h5>Correo electronico</h5></td> 
                    </tr> 
                    <tr>
                        <td><input type="email" name="EMAIL" class="form-control" id="floatingInput" placeholder="ejemplo@paintArt.cl" required></td> 
                    </tr>
                    <tr> 
                      <td><h5>Numero de contacto</h5></td> 
                    </tr> 
                    <tr>
                        <td><input type="number"  maxlength="11" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="NUMTELEFONO" class="form-control" id="floatingInput" placeholder="+56 9 1234 5678" required></td> 
                    </tr>
                    <tr> 
                      <td><h5>Fecha de nacimiento</h5></td> 
                    </tr> 
                    <tr>
                        <td><input type="date" name="FECHANAM" class="form-control" id="floatingInput" placeholder="+56 9 1234 5678" required></td> 
                    </tr>
                    <tr> 
                      <td><H5>Contraseña</H5></td> 
                    </tr> 
                    <tr>
                        <td><input type="password" name="PASSWORD" class="form-control" id="floatingPassword" placeholder="Contraseña" minlength="5" required></td> 
                    </tr>
                    <tr> 
                      <td><h5>Vuelva introducir contraseña</h5></td> 
                    </tr> 
                    <tr>
                        <td><input type="password" name="PASSWORD2" class="form-control" id="floatingPassword" placeholder="Contraseña" minlength="5" required ></td> 
                    </tr>
                     <tr> 
                      <td></td> 
                    </tr> 
                     <tr>
                        <td>  <div class="form-check form-switch" sytle=" margin-top:10px">
                            <p>
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault"><b><a href="terminosCondiciones.php">He leido y aceptado los terminos y condiciones de PaintArt.cl</a></b></label>
                            </p> </div></td> 
                    </tr>
                    <tr> 
                      <td style="text-align: right; "> 

                        <br>

                        <button type="submit" style="background-color: #212529; border-radius: 0px ; border-color: #212529; "id="registrar" class="btn btn-primary disabled">Registrar</button> 

                      </td> 
                    </tr> 
                  </form>

                </table> 
            </div>  
      </div> 

</body> 
<?php include_once 'footer.php';?>
<?php 
if( empty( $_SESSION["error"]))
{}
else{
  $error =  $_SESSION["error"];
  echo "<script>
  
  swal('".$error."', {icon:'info',});
  


</script>";
}

unset($_SESSION["error"]);

?>
</html> 

<script>
    var checkbox = document.getElementById('flexSwitchCheckDefault');
checkbox.addEventListener("change", validaCheckbox, false);
function validaCheckbox()
{
  var checked = checkbox.checked;
  if(checked){
    

    $('#registrar').removeClass('"btn btn-primary disabled');
    $('#registrar').addClass('"btn btn-primary ');
       
  }else{
      $('#registrar').removeClass('"btn btn-primary ');
    $('#registrar').addClass('"btn btn-primary disabled ');
  }
}
    
    
</script>


