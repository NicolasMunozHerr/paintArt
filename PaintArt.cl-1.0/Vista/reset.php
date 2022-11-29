<?php 
session_start();
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email= $_GET['email'];
    $token= $_GET['token'];
}else{
    header('Location: ../Vista/index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php ;
$online= false;
if( empty($_SESSION["online"]))
{
  $online= false;
}else{
  $online =  $_SESSION["online"];
  
}?>
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="Css/bootstrap.min.css"> 
    <link rel="stylesheet" href="Css/registrar.css"> 
    <link rel="stylesheet" href="Css/cssindexL.css">
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
              <?php 
                if($online == false)
                {
                  echo ' <table>
                          <td> <a class="nav-link" href="registrar.php">Registrar</a></td>
                          <td>   <a class="nav-link" href="iniciarSesion.php">Iniciar</a></td>
                        </table>';
                }else{
                  echo '<table>
                          <td style="width: 40px;" ><div class="icon"><a style="text-decoration: none;" href="listaCompra.php"> <img style="width:40px; max-width:40px; heigth: 40px; max-heigth: 40px ; margin-top: 15px" src="imagenes/compras.png" alt=""></a><</td>
                          <td style="width: 40px"> <div class="icon"> <a style="text-decoration: none;" href="listarMisPeticiones.php"><img style="width:40px; max-width:40px; heigth: 40px; max-heigth: 40px" src="imagenes/notificacion.png" alt=""></a></td>
                          <td style="width: 40px"> <div class="icon"> <a style="text-decoration: none;" href="../controlador/controllerAccesadorUsuarios.php"><img  style="width:40px; max-width:40px; heigth: 40px; max-heigth: 40px" src="imagenes/user.png" alt=""></a></td>            
                      </table>';

                }
              ?>
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
            <?php
              if ($online== false){

              }else{
                echo '
                <div  class="lista"> 
                  <li class="nav-item"><a class="nav-link" href="listaCompra.php"><img style="width:30px; max-width:30px; heigth: 30px; max-heigth: 30px" src="imagenes/compras.png" alt="">Mis compras</a></li>
                  <li class="nav-item"><a class="nav-link" href="listarMisPeticiones.php"><img style="width:30px; max-width:30px; heigth: 30px; max-heigth: 30px" src="imagenes/notificacion.png" alt="">Mis pedidos</a></li>
                  <li class="nav-item"><a class="nav-link" href="../controlador/controllerAccesadorUsuarios.php"><img style="width:30px; max-width:30px; heigth: 30px; max-heigth: 30px"  src="imagenes/user.png" alt="">Mi perfil</a></li>
                </div>
                ';
              }
            
            
            ?>
          </div> 
        </ul> 
      </nav> 
      <div class="container" style="background-color: #f8f9fa;
      border: 1px solid #dee2e6;"> 
             <h2 style="margin-top: 20px;">Restablcer Contraseña</h2>
            <div class="form-group formulario" > 
                <table class="formularioRegistrar"> 
                <form action="../controlador/controllerResetPass.php" method="post" >
                <td><input type="hidden" name="email" required class="form-control" id="floatingInput" placeholder="hola1234" value="<?php echo $email?>"></td> 
                <td><input type="hidden" name="token" required class="form-control" id="floatingInput" placeholder="hola1234" value="<?php echo $token?>"></td> 
                   
                  <tr> 
                    <td><h5>Contraseña</h5></td> 
                  </tr> 
                  <tr>
                      <td><input type="password" required name="password" class="form-control" id="floatingInput" placeholder="hola1234" ></td> 
                      
                  </tr>
                  <tr> 
                    <td><h5>Vuelva a escribir su contraseña</h5></td> 
                  </tr> 
                  <tr>
                      <td><input type="password" required name="password2" class="form-control" id="floatingInput" placeholder="hola1234" ></td> 
                      
                  </tr>                                 
                       
                  <tr> 
                    
                    <td style="text-align: right; ">
                      <br>
                      <button type="submit" style="background-color: #212529; border-radius: 0px ; border-color: #212529; " class="btn btn-primary">Restablecer</button> 
                    </td> 
                  </tr> 
                </form>
                </table>

            </div>  
      </div> 

</body> 
<?php include_once 'footer.php';?>
</html> 

<?php 
if( empty( $_SESSION["error"]))
{}
else{
  $error =  $_SESSION["error"];
  echo "<script>

  
  confirm('".$error."');
  


</script>";
}

unset($_SESSION["error"]);

?>
</body>
</html>