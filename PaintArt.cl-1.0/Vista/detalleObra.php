<?php 
session_start();
$id=$_GET['id'];
$_SESSION['idCompra']= $id;

include_once '../controlador/accesadorSubasta.php';
$id=$_GET['id'];
$acc= new cambiaraSubasta($id);
include_once '../controlador/controllerDetalleObra.php';




$id=$_GET['id'];
$_SESSION['idCompra']= $id;
$ob= new mostrarObra($id);
/*$resp= $ob->validarSubasta($id);

if($resp==false){
 
  echo $resp;
}else{
  
  unset($_SESSION['idCompra']);
  header("Location: subasta.php?id=".$id."");
}*/






?>
<?php 
$online= false;
if( empty($_SESSION["online"]))
{
  $online= false;
}else{
  $online =  $_SESSION["online"];
  
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/cssMain.css">
    <link rel="stylesheet" href="Css/cssDetalleObra.css">
    <link rel="stylesheet" href="Css/cssindexL.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" charset="utf-8"></script>
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
            
            <div class="anuncio">
                <div class="big-Image">
                    <img style= "width: 100%; max-width: 100%; height: 100%; max-height: 100%; object-fit: cover; object-position: center;" src="<?php echo $ob->mostrarImagen($id) ?>" alt="">
                </div>
                <div class="reporte">
                  <a href="subirReporte.php?idObra=<?php echo $id ?>">  <img style="width: 150%; max-width:150% ; height:150% ; max-height:150% ;" src="imagenes/bandera.png" alt=""></a>
                </div>
                <div  class="titulares">
                    <span><h4><?php echo $ob->mostraObra($id)->getTitulo()?></h6></span>
                    <span><h5><?php echo $ob->mostraNonmbre($id) ?></h5></span>
                    <br>
                    <div class="detalleCompra">
                        <span><h3>$<?php echo $ob->mostraObra($id)->getPrecio()?></h5></span>
                        <span><h6>Stock disponible: <?php echo $ob->mostraObra($id)->getStock()?></h6></span>
                        <P></P>
                        <table >
                          <?php 
                            $stock= $ob->mostraObra($id)->getStock();
                            if($stock==0){
                              echo '<tr><td><button id= "compra" type="button" class="btn btn-dark  btn-lg">Comprar</button></span></td></tr>';
                            }else{
                              echo '<tr><td> <a href="comprar.php"><button type="button" class="btn btn-primary btn-lg">Comprar</button></a></span></td></tr>';
                            }
                          ?>
                          
                          <tr><td> <a style="text-decoration: none;" href="verArtista.php?idArtista=<?php echo $ob->mostraObra($id)->getIdArtista()?>"><button type="button" class="btn btn-primary btn-lg">Ver mas del artista</button></a> </span></td></tr> 
                        </table>
                       
                                             
                       

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
                <div class="cajaComentar">
                  <form action="" method="post"></form>
                  <h4 style="float:left; margin-left:2%; margin-top: 5px;"> Opinar</h4>
                  <div class="textoComentar"> 
                    <textarea class="comentario" name="" id="critica" cols="30" rows="10"></textarea>
                  </div>
                  <div class="botonEstrella">
                    <select name="estrellas" style=" border-radius: 0px; border: 0px;" class="form-select" id="exampleSelect1">
                      <option>★★★★★</option>
                      <option>★★★★</option>
                      <option>★★★</option>
                      <option>★★</option>
                      <option>★</option>
                    </select></div>
                  <div class="botoneraComentar">
                    <button type="button" id="criticar" class="btn btn-dark" sytle="margin-top: 20px;">Opinar</button>
                  </div>
                </div>

                <div style="text-align: left;" id="listaCometarios" class="listaCometarios">
                    <h4 style="margin-top: 10px;margin-left:10px ;">Opiniones</h4>
                    <div class="itemComentario">
                      <b>Nombre y Apellido</b>
                      <p>enunciado enunciado enunciado enunciado enunciado enunciado enunciado enunciado enunciado enunciado enunciado</p>
                      <div class="valoracion">★★★★★</div>
                      <div class="reportar"> <b>REPORTAR</b> </div>
                    </div>

                    <div class="itemComentario">
                      <b>Nombre y Apellido</b>
                      <p>enunciado enunciado enunciado enunciado enunciado enunciado enunciado enunciado enunciado enunciado enunciado</p>
                      <div class="valoracion">★★★★★</div>
                      <div class="reportar"> <b>REPORTAR</b> </div>
                    </div>
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
        echo '
        <script type="text/javascript">
          $(document).ready(function(){
            function obtener_datos(){
            alert("'.$erroCompra.'");
            }
            mostrarAlerta();
            });
        </script>
        ';
        unset($_SESSION['errorCompra']);
      }
      
    ?>
    
    </body>
    <?php include_once 'footer.php';?>
</html>
<script type="text/javascript">
  $(document).ready(function(){

  function obtener_datos(){
    var parametros=1;
    $.ajax({
      url:'../controlador/controllerCritica.php',
      method:'POST',
      data:{parametros:parametros,},
      success:function(data){
        $('#listaCometarios').html(data);
        
      }
    });
  }
  obtener_datos();
  $(document).on("click", "#criticar",function(){
        var parametros= 2;
        var critica=document.getElementById("critica").value;
        var estrella= document.getElementById("exampleSelect1").value;
        
        $.ajax({
        url:"../controlador/controllerCritica.php",
        method:"POST",
        data:{parametros:parametros,critica:critica,estrella, estrella, },
        success: function(data){
            obtener_datos();
            swal(data, {icon:"success",});
            
    }
    });
    
    })

    $(document).on("click", "#compra",function(){
        
        swal("No hay stock en estos momentos", {icon:"info",});
    })

   
  });
</script>