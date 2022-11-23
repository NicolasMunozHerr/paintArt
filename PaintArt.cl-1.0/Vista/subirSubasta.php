<?php 
session_start();
include_once '../controlador/controllerValidarTarjeta.php';
?>
<?php ;
$online= false;
if( empty($_SESSION["online"]))
{
  header("Location: iniciarSesion.php");
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
                        <a class="dropdown-item" href="listaObras.php?cat=1">Urbano</a>
                        <a class="dropdown-item" href="listaObras.php?cat=2">Optico</a>
                        <a class="dropdown-item" href="listaObras.php?cat=4">Surrealismo</a>
                        <a class="dropdown-item" href="listaObras.php?cat=5">Neoplasticismo</a>
                        <a class="dropdown-item" href="listaObras.php?cat=6">Dadaismo</a>
                        <a class="dropdown-item" href="listaObras.php?cat=7">Suprematismo</a>
                        <a class="dropdown-item" href="listaObras.php?cat=8">Constructivismo</a>
                        <a class="dropdown-item" href="listaObras.php?cat=9">Minimalismo</a>
                        <a class="dropdown-item" href="listaObras.php?cat=10">Rayonismo</a>
                        <a class="dropdown-item" href="listaObras.php?cat=11">Abastraccion lirica</a>
                        <a class="dropdown-item" href="listaObras.php?cat=12">Expresionismo</a>
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
             <h2 style="margin-top: 20px;">Subir Subasta</h2>
            <div class="form-group formulario" > 
              <form action="../controlador/controllerSubirSubasta.php" method="post" enctype="multipart/form-data">
                
                <table class="formularioRegistrar">
                    <tr> 
                        <td><h5>Titulo</h5></td> 
                    </tr> 
                    <tr>
                        <td><input required type="text" name="titulo" class="form-control" placeholder="Titulo" id="titulo"></td>
                    </tr>

                    <tr> 
                        <td><h5>Categoria</h5></td> 
                    </tr> 

                    <tr>
                        <td> 
                            <select name="categoria" style=" border-radius: 0px; border: 0px;" class="form-select" id="exampleSelect1">
                                <option>Arte urbano</option>
                                <option>Arte optico</option>
                                <option>Arte cinetico</option>
                                <option>Surrealismo</option>
                                <option>Neoplasticismo</option>
                                <option>Dadaismo </option>
                                <option>Suprematismo</option>
                                <option>Contructivismo</option>
                                <option>Minimalismo</option>
                                <option>Rayonismo</option>
                                <option>Abstraccion lirica</option>
                                <option>Expresionismo</option>
                            </select>
                        </td> 
                    </tr>
                    <tr> 

                        <td><h5>Detalles</h5></td> 
                    </tr> 
                    <tr>
                        <td> <input required name="detalles" type="text" class="form-control" placeholder="Detalles" id="inputDefault"></td> 
                    </tr>
                    <tr> 
                        <td><h5>tecnica</h5></td> 
                    </tr> 
                    <tr>
                        <td> <input required name="tecnica"type="text" class="form-control" placeholder="tecnica" id="inputDefault"></td> 
                    </tr>
                    <tr> 
                        <td><h5>Dimensiones</h5></td> 
                    </tr> 
                    <tr>
                        <td><input required name="altura" style="width: 45%; float: left;" type="number" class="form-control" placeholder="Altura (cm)" id="inputDefault"> 
                            <input  required name="ancho" style="width: 45%; float: right; margin-left: 20px;" type="number" type="text" class="form-control" placeholder="Ancho (cm)" id="inputDefault"></td> 
                    </tr>
                    <tr> 
                        <td><h5>Precio Inicial</h5></td> 
                    </tr> 
                    <tr>
                        <td><input name="precioInicial"type="number" class="form-control" id="floatingInput" placeholder="Precio inicial " required></td> 
                    </tr>
                
                    <tr>
                        <td><h5>Duracion de la subasta</h5></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><select name="txtDuracion" style=" border-radius: 0px; border: 0px;" class="form-select" id="">
                            <option value="1">01 horas</option>
                            <option value="2">02 horas</option>
                            <option value="4">04 horas</option>
                            <option value="8">08 horas</option>
                            <option value="12">12 horas</option>
                            <option value="18">18 horas</option>
                            <option value="24">24 horas</option>
                            <option value="36">36 horas</option>
                            <option value="48">48 horas</option>
                            <option value="72">72 horas</option>

                        </select></td>
                    </tr> 
                    <tr> 
                        <td><h5>Precio Minimo</h5></td> 
                    </tr>
                    
                    <tr>
                        <td><textarea name="sobreObra" style= "border: 0px; border-radius:0px ;" class="form-control" id="exampleTextarea" rows="3" required></textarea></td> 
                    </tr>
                    <tr> 
                        <td><h5>Imagen referencial</h5></td> 
                    </tr> 
                    <tr>
                        <td><input name="imagenObra"class="form-control" type="file" id="formFile" required></textarea></td> 
                    </tr>  
                    
                    
                    <tr>
                        
                        <td><input type="submit" name="subir" style="background-color: #212529; border-radius: 0px ; border-color: #212529; " class="btn btn-primary" value="subir obra"></td>
                    </tr>
                </table>


                </form>
            </div>  
      </div> 

</body> 

</html> 