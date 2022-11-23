<?php 
include_once '../controlador/listarObra.php';
$listaObra= new listObra;
$cat= $_GET["cat"];
?>
<?php 
session_start();
?>
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
    <link rel="stylesheet" href="Css/cssListaObras.css">
    <link rel="stylesheet" href="Css/cssindexL.css">
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
      <div class="container">
        
        <div class="noticia">
          
          <table class="table ">
            <tr>
              <td ><h2>Obras <?php echo $listaObra->mostraCate($cat)?></h2><td>
          </table>
        </div>
       
        <div class="cuadros">
        <?php 
       
        if( empty($_SESSION["obra"])){
          $listaObra->listarObrasCat($cat);
        }else{
          
          $busqueda= $_SESSION["obra"];
          if($busqueda==""){
            $listaObra->listarObrasCat($cat);
          }else{
            
            $listaObra->listarObrasBusqueda($busqueda);
            unset($_SESSION["obra"]);
          }
         
        }

       
       
       
       ?>
         <!-- <div class="cajaArtista">
            <div style="text-align: center;" class="cuadro">
              <div class="fotoArtista"> <img src="imagenes/Vangogh-1024x829.jpg" alt=""></div>
                <br>
                <div class="cuadroTexto">
                    <span><h6>Titulo</h6></span>
                    <div class="detalles">
                        <span>  Autor</span>
                        <br>
                        <span>  categoria</span>    
                    </div>
                    <div class="precio"><h6>$Precio</h6></span></div>
                </div>
              </div>
              
          </div>

          <div class="cajaArtista">
            <div style="text-align: center;" class="cuadro">
              <div class="fotoArtista"> <img src="imagenes/Vangogh-1024x829.jpg" alt=""></div>
                <br>
                <div class="cuadroTexto">
                    <span><h6>Titulo</h6></span>
                    <div class="detalles">
                        <span>  Autor</span>
                        <br>
                        <span>  categoria</span>    
                    </div>
                    <div class="precio"><h6>$Precio</h6></span></div>
                </div>
              </div>
              
          </div>

          <div class="cajaArtista">
            <div style="text-align: center;" class="cuadro">
              <div class="fotoArtista"> <img src="imagenes/Vangogh-1024x829.jpg" alt=""></div>
                <br>
                <div class="cuadroTexto">
                    <span><h6>Titulo</h6></span>
                    <div class="detalles">
                        <span>  Autor</span>
                        <br>
                        <span>  categoria</span>    
                    </div>
                    <div class="precio"><h6>$Precio</h6></span></div>
                </div>
              </div>
              
          </div>
          <div class="cajaArtista">
            <div style="text-align: center;" class="cuadro">
              <div class="fotoArtista"> <img src="imagenes/Vangogh-1024x829.jpg" alt=""></div>
                <br>
                <div class="cuadroTexto">
                    <span><h6>Titulo</h6></span>
                    <div class="detalles">
                        <span>  Autor</span>
                        <br>
                        <span>  categoria</span>    
                    </div>
                    <div class="precio"><h6>$Precio</h6></span></div>
                </div>
              </div>
              
          </div>
          <div class="cajaArtista">
            <div style="text-align: center;" class="cuadro">
              <div class="fotoArtista"> <img src="imagenes/Vangogh-1024x829.jpg" alt=""></div>
                <br>
                <div class="cuadroTexto">
                    <span><h6>Titulo</h6></span>
                    <div class="detalles">
                        <span>  Autor</span>
                        <br>
                        <span>  categoria</span>    
                    </div>
                    <div class="precio"><h6>$Precio</h6></span></div>
                </div>
              </div>
              
          </div>
          <div class="cajaArtista">
            <div style="text-align: center;" class="cuadro">
              <div class="fotoArtista"> <img src="imagenes/Vangogh-1024x829.jpg" alt=""></div>
                <br>
                <div class="cuadroTexto">
                    <span><h6>Titulo</h6></span>
                    <div class="detalles">
                        <span>  Autor</span>
                        <br>
                        <span>  categoria</span>    
                    </div>
                    <div class="precio"><h6>$Precio</h6></span></div>
                </div>
              </div>
              
          </div>-->

      </div>


      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>