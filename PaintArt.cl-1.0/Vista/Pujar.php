<?php 
session_start();
include_once '../controlador/controllerValidarTarjeta.php';
?>
<?php ;
$online= false;
if( empty($_SESSION["online"]))
{
  header('Location: iniciarSesion.php');
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
             <h2 style="margin-top: 20px;">Incripcion para pujadores</h2>
            <div class="form-group formulario" > 
              <form action="../controlador/controllerPrimerPuja.php" method="post" enctype="multipart/form-data">
                <table class="formularioRegistrar" > 
                     
                    <tr> 
                         <td><h5>Region</h5></td> 
                    </tr> 
                    <tr>
                        <td>
                          <select name="region" style=" border-radius: 0px; border: 0px;" class="form-select" id="exampleSelect1">
                            <option>Arica-Parinacota</option>
                            <option>Tarapaca</option>
                            <option>Antofagasta</option>
                            <option>Atacama</option>
                            <option>Coquimbo</option>
                            <option>Valparaiso</option>
                            <option>Metropolitana</option>
                            <option>O'Higgins</option>
                            <option>Maule</option>
                            <option>Ñuble</option>
                            <option>Bio Bio</option>
                            <option>Araucania</option>
                            <option>Los Rios</option>
                            <option>Los Lagos</option>
                            <option>Aysen</option>
                            <option>Magallanes</option>
                          </select>
                        </td>
                    </tr>
                      <td><h5>Ciudad</h5></td> 
                    </tr> 
                    <tr>
                        <td> <input name="Ciudad" type="text" class="form-control" placeholder="Ciudad..." id="inputDefault" required></td> 
                    </tr>
                    <tr> 
                        <td><h5>Comuna</h5></td> 
                      </tr> 
                      <tr>
                          <td> <input name="comuna"type="text" class="form-control" placeholder="Comuna..." id="inputDefault" required></td> 
                      </tr>
                    <tr> 
                      <td><h5>Calle</h5></td> 
                    </tr> 
                    <tr>
                        <td>
                            <input name="calle"  type="text" class="form-control" placeholder="Calle.." id="inputDefault" required> 
                        </td> 
                    </tr>
                    
                    <tr> 
                        <td><h5>Numeracion</h5></td> 
                      </tr> 
                      <tr>
                          <td>
                              <input name="numeracion"  type="number" class="form-control" placeholder="600.." id="inputDefault" required> 
                          </td> 
                      </tr>
                      <tr> 
                        <td><h5>Tipo de hogar</h5></td> 
                      </tr> 
  
                      <tr>
                          <td> 
                              <select name="tipoHogar" style=" border-radius: 0px; border: 0px;" class="form-select" id="exampleSelect1">
                                  <option>casa</option>
                                  <option>departamento</option>
                                  
                                </select>
                          </td> 
                      </tr>
                      
                    <tr>
                      <td><h5>Condiciones de primera puja</h4>
                        <p style="position: relative; left  : 15px;"><b>Esta formulario solo se llena una sola vez para mantener una Incripcion con sus datos asociados al registro de pujadores de esta subasta. Las siguientes veces no sera necesario dicha inscripcion. </b></p>
                    
                      </td>
                    </tr> 
                    <?php 
                    $controller= new validarTarjeta();
                    echo $controller->validarExistenciaTarjet($online) 
                    
                    
                    ?> 
                      
                    <tr> 
                      <td style="text-align: right; "> 
                        <br>
                        <input type="submit" name="subir" style="background-color: #212529; border-radius: 0px ; border-color: #212529; color: #dee2e6;" class="btn btn-primary" value="Comprar">
                      </td> 
                    </tr> 
                </table> 
              </form>

            </div>  
      </div> 

</body> 
<?php include_once 'footer.php';?>
</html> 
