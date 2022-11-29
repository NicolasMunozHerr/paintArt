<?php 
//include_once '../controlador/listarObra.php';
//$listaObra= new listObra;
$cat= $_GET["cat"];
?>
<?php 
session_start();
$reacciones=0
;
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
    <!-- Google tag (gtag.js) -->
 <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-R912MLFD1Z"></script>-->
<script>
 /* window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R912MLFD1Z');*/
</script>
<head>
<link rel="stylesheet" href="Css/cssListaObras.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/cssListaObras.css">
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
                  <select name="modo" class="form-select " style="width: 120px; margin-right:2px ;background-color: #f0ad4e; border-color: #f0ad4e; color:black" name="" id="buscador">
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
              <td >
                <?php
                  $valor= "";
                  if( empty($_SESSION["obra"])){
                    $valor="nada";
                  }else{
                    
                    $busqueda= $_SESSION["obra"];
                    if($busqueda==""){
                      $valor="nada";
                    }else{
                      
                      $valor=$busqueda;
                      unset($_SESSION["obra"]);
                    }
                  
                  } 
                ?>
                <?php 
                  if(($valor=="nada")){
                    echo  '
                      <h2 id="busqueda" >Obras  <h2>
                      <br>';
                  }else{
                    echo'
                      <h2 id="busqueda">Busqueda: '.$valor.' </h2>
                      <br>'; 
                  }
                ?>
                  
                    
              <td>
              <td> 
                <?php 
                  if($valor=="nada"){
                    echo '<button id="subasta" value="2" style="position:relative; left:25% "type="button" class="btn btn-warning">Subastas</button>
                    <button id="ventas" style="display:none" value="2" style="float:left"type="button" class="btn btn-warning">Ventas</button>';
                  }               
                ?>
                
              </td>
            </tr>
          </table>
        
        </div>
       
        <div id= "cuadros" style="min-height: 100vh;" class="cuadros">
        <img src="imagenes/carga.gif" alt="" srcset="">

      </div>

      </div>
     
</body>

<?php include_once 'footer.php';?>
</html>

<script type="text/javascript">
 
  /*function sumar(){
    var btnElm= document.getElementById('Suma');
    var suma=0;
    btnElm.onclick= function(){
      suma= suma+12;
      $.ajax({
          url:'../controlador/listarObra.php',
          method:'POST',
          data:{reacciones :reacciones,cat:cat,busqueda:busqueda, suma:suma,},
          success:function(data){
            $('#cuadros').html(data);
             alet(data);
          }
        });
    }
  };*/
  var contador=12;
  function sumar(){
    var reacciones=<?php echo $reacciones?>;
    var cat= <?php  echo $cat?>;
    var busqueda='';
    contador= 12+contador;
    var busqueda="";
    
      $.ajax({
        url:'../controlador/listarObra.php',
        method:'POST',
        data:{reacciones :reacciones,cat:cat,busqueda:busqueda, suma:contador,},
        success:function(data){
        
          $('#cuadros').html(data);
        }
      });
  }
  $(document).ready(function(){
   
    var reacciones=<?php echo $reacciones?>;
    var cat= <?php  echo $cat?>;
    var valor= '<?php echo $valor?>';
    if(valor=="nada"){
      if (cat==100) {
        document.getElementById('busqueda').innerHTML="Mas populares";
        document.getElementById('subasta').style.display="none";

      } 
      function obtener_datos(reacciones,cat){
        var suma=contador;
        var busqueda="";
        
        $.ajax({
          url:'../controlador/listarObra.php',
          method:'POST',
          data:{reacciones :reacciones,cat:cat,busqueda:busqueda, suma:suma,},
          success:function(data){
            $('#cuadros').html(data);
          }
        });
          
        }
    
      obtener_datos(reacciones,cat);
      
      $(document).on("click", "#subasta",function(){
        $('#cuadros').html('<img src="imagenes/carga.gif" alt="" srcset="">');
          var reacciones= 2;
          var cat=  <?php echo $_GET["cat"]?>  ;
            obtener_datos(reacciones, cat);

        
        })
        
        $(document).on("click", "#ventas",function(){
          $('#cuadros').html('<img src="imagenes/carga.gif" alt="" srcset="">');
          
          var reacciones= 0;
          var cat=  <?php echo $_GET["cat"]?>  ;
            obtener_datos(reacciones, cat);

        
        })
        document.getElementById('subasta').onclick=function(){
          document.getElementById('busqueda').innerHTML="Subastas";
          document.getElementById('subasta').style.display="none";
          document.getElementById('subasta').style.float="left";
          document.getElementById('ventas').style.display="";
          document.getElementById('ventas').style.float="right";
          document.getElementById('ventas').style.marginRight="23%";
        }
        document.getElementById('ventas').onclick=function(){
          document.getElementById('busqueda').innerHTML="Obras";

          document.getElementById('subasta').style.display="";
          document.getElementById('subasta').style.float="none";
          document.getElementById('ventas').style.display="none";
        }
        suma=0;
        

      
    }else{
      
      
      function obtener_datos(reacciones,cat){
        var busqueda=valor;  
         
        $.ajax({
          url:'../controlador/listarObra.php',
          method:'POST',
          data:{reacciones:reacciones,cat:cat, busqueda:busqueda,},
          success:function(data){
            
            $('#cuadros').html(data);

            }
        });
                
      }
      obtener_datos(0,0);
    }
  });
    
</script>