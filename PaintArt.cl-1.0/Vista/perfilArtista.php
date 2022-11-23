<?php 
session_start();
include_once '../controlador/controllerPestañaArtistas.php';
include_once '../controlador/controllerPerfilUsuarioRegistrado.php';
$online= false;
if( empty($_SESSION["online"]))
{
  header( 'location: iniciarSesion.php');
}else{
  $online =  $_SESSION["online"];
  
}
//revisar si esto sigue funcionando xd
$idArtista=1;
$_SESSION['idArtista']=$idArtista;
$controller= new listaArtista(null, 1);
$perfiUsuario= new perfilUusarioRegistrado();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/cssMain.css">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
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
      <h3 style="margin-top: 10px;margin-left: 10px;">Mi perfil</h3>
      <div class="container">
        <div style="margin-bottom: 20px;" class="inforArtista">
            <!--<div class="imgArtista">
              <img style="width: 100%;max-width: 100%;height: 100%;max-height: 100%;" src="imagenes/avatar.png" alt="">
            </div>
            <p></p>
            <span><h4><?php //echo $controller->verArtista($idArtista)?></h4></span>
            <p></p>
            <span><a style="text-decoration: none;" href="listarPeticionesAprobar.php"><h6>Ver lista de nuevas peticiones</h6></a></span>
            <p></p>
            <span><a style="text-decoration: none;" href="listaTrabajosPerso.php"><h6>Lista de trabajo a pedido</h6></a></span>
            <br>
            
            <span class="bio" ><h5>BIOGRAFIA: </h5></span>
          
            <span style="margin-top: 5px;" class="bio" ><h6> <a href="">edita tu informacion</a></h6></span>
            <br>
            
            
            <span  class="biografia">
              <div  class="contenidoBiografia">
              <p>
              <?php //echo $controller->verBiografiaArtista($idArtista)?>
            </p>
              </div></span>
-->

          <?php 
            $perfiUsuario->mostrarPerfilArtista($online);
          ?>
        </div>
        <div class= "histoObras" style="border: none;">
          <button id="verObras" type="button" class="btn btn-warning disabled">Obras</button>
          <button id="verSubasta" type="button" class="btn btn-warning"> Subastas</button>

        </div>
        <div class="histoObras">
            <span style="width: 100%;" class="tituloObras"><h4>Obras disponibles</h4></span>
            
            <div id='Cuadros' class="cuadrosArista">
                <!--<div class="cuadroArtista">
                  <img  class="imagenObraArista" src="imagenes/Vangogh-1024x829.jpg" alt="">
                  <h6>Obra <a  href="">✏️</a>  </h6>
                </div>-->
                
               <?php $perfiUsuario->listarObra($online)?>
                      
            </div>
        </div>
       
      </div>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<script type="text/javascript">
  
 
  $(document).ready(function(){

  /*function obtener_datos(){
    var parametros=1;
    $.ajax({
      url:'../controlador/controllerListarPeticiones.php',
      method:'POST',
      data:{parametros:parametros,},
      success:function(data){
        $('#Inputs').html(data);
        
      }
    });
  }
  obtener_datos();*/
  $(document).on("click", "#eliminar",function(){
    swal({
      title: "Esta seguro de querer eliminar?",
      text: "En caso de querer eliminar se borrar todo los registros de visita y en su defecto las compras o pujas asociadas a la obra",
      incon:"warning",
      buttons: true,
      dangermode:true,
      
    }).then((willDelete)=>{
        if (willDelete) {
          var parametros=<?php echo $online ?>;
          var id=$(this).data("id");
          
          $.ajax({
            url:'../controlador/controllerPerfilUsuarioRegistrado.php',
            method:"POST",
            data:{parametros:parametros,id:id, },
            success: function(data){
              $('#Cuadros').html(data);
              swal("Ha sido eliminado con exito", {icon:"info",});
          }
          });
            
        }else{
          swal("No se ha eliminado nada");
        }
    });
      
        

    })
  
  $(document).on("click", "#verSubasta",function(){
    var subasta= 1;
    var idUser=<?php echo $online ?>;
    
    
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:"POST",
      data:{subasta:subasta, idUser:idUser},
      success: function(data){
        $('#Cuadros').html(data);
        let sub= document.getElementById('verSubasta');
        sub.className='btn btn-warning disabled';
        let ob= document.getElementById('verObras');
        ob.className= 'btn btn-warning';
      }
    });

  })
  $(document).on("click", "#verObras",function(){
    var subasta= 2;
    var idUser=<?php echo $online ?>;
    
    
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:"POST",
      data:{subasta:subasta, idUser:idUser},
      success: function(data){
        $('#Cuadros').html(data);
        let sub= document.getElementById('verSubasta');
        sub.className='btn btn-warning ';
        let ob= document.getElementById('verObras');
        ob.className= 'btn btn-warning disabled';
      }
    });

  })


  });
  

  
</script>

