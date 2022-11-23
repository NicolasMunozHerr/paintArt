<?php 
$id=$_GET['id'];
session_start();
$_SESSION['idCompra']= $id;


include_once '../controlador/controllerDetalleObra.php';
$ob= new mostrarObra;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/cssMain.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">PaintArt</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="barraBusqueda">
            
              <thead>
                <form class="d-flex ">
                  <input class=" form-control Search" type="text" placeholder="Buscar">
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
              </thead>
            </div>
            <div class="login">
              <table>
                <td> <a class="nav-link" href="">Registrar</a></td>
                <td>   <a class="nav-link" href="">Iniciar</a></td>
              </table>
             
           
            </div>
        </div>
      </nav>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <ul class="navbar-nav me-auto barrita">
        <div class="collapse navbar-collapse" id="navbarColor03">
            <li class="nav-item">
              <a class="nav-link active" href="#">Inicio
                <span class="visually-hidden">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Noticias</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Populares de la semana</a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle show " data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categoria</a>
              <div class="dropdown-menu show" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 42px);" data-popper-placement="bottom-start">
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
        <div class="container">
            
            <div class="anuncio">
                <div class="big-Image">
                    <img style= "width: 100%; max-width: 100%; height: 100%; max-height: 100%;" src="<?php echo $ob->mostrarImagen($id) ?>" alt="">
                </div>
                <div class="reporte">
                    <h1>a</h1>
                </div>
                <div class="titulares">
                    <span><h4><?php echo $ob->mostraObra($id)->getTitulo()?></h6></span>
                    <span><h5>autor</h6></span>
                    <br>
                    <div class="detalleCompra">
                        <span><h3>$<?php echo $ob->mostraObra($id)->getPrecio()?></h5></span>
                        <span><h6>detalles del envio</h6></span>
                        <p></p>
                        <a href="comprar.html"><button type="button" class="btn btn-primary btn-lg">Comprar</button></a>
                        <p></p> 
                      <button type="button" class="btn btn-primary">Ver mas del artista</button>

                    </div>
                    <span><h6>Cantidad de reacciones</h6></span>
                    <br>
                    <span><h6>tecnica: <?php echo $ob->mostraObra($id)->getTecnica()?></h6></span>
                    <br>
                    <span><h6>otros detalles:</h6></span>
                    <span><p><?php echo $ob->mostraObra($id)->getDetalles()?></p></span>  

                    <span><h6>Sobre la obra</h6></span>
                    <span><p><?php echo $ob->mostraObra($id)->getSobreObra()?></p></span>

                </div>

                
            </div>

        </div>
       
       
                
        </div>
      </div>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?php 
      
      if(isset($_SESSION['errorCompra']))
      {
        $erroCompra= $_SESSION['errorCompra'];
        echo '<script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(){
          if(!Notification){
            alert ("Las notificaciones no se soportan en tu navegador");
            return
          }
          alert("'.$erroCompra.'")
        })';
      }
      
    ?>
    
    </script>
    </body>
</html>