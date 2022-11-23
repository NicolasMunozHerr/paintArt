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
  $informacion = 'nada';
  if(empty($_SESSION["informacion"])){

  }else{
    $informacion=$_SESSION["informacion"];
  }

  
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
            
          <?php 
            $perfiUsuario->mostrarPerfilArtista($online);
          ?>
        </div>
        <div class= "histoObras" style="border: none;">
          <button id="verObras" data-id="false" type="button" class="btn btn-warning disabled">Obras</button>
          <button id="verSubasta" data-id="true" type="button" class="btn btn-warning"> Subastas</button>
          <button  style="float: right;" id="verArchivadas" data-id="true" type="button" class="btn btn-danger"> Obras archivadas</button>

        </div>
        <div class="histoObras">
            <span style="width: 100%;" class="tituloObras"><h4 id='titular'>Obras disponibles</h4></span>
            
            <div id='Cuadros' class="cuadrosArista">
                <!--<div class="cuadroArtista">
                  <img  class="imagenObraArista" src="imagenes/Vangogh-1024x829.jpg" alt="">
                  <h6>Obra <a  href="">✏️</a>  </h6>
                </div>-->
                
                      
            </div>
        </div>
      </div>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<?php include_once 'footer.php';?>
</html>

<script type="text/javascript">
  var contador=4;
  function sacarContador(){
    var elm= document.getElementById('cuenta');
    var contador= elm.dataset.id;
    return contador;
  }

  function sumar(){
    contador= 4+contador;
    var estado= document.getElementById('verObras');
    var direccion= estado.dataset.id;
    var subasta= 1000;
    var idUser= <?php echo $online?> ;
    if(direccion=='false'){
      //alert('Estas en obras');
      subasta=2;
    }else{
      //alert('Estas en subasta');
      subasta=1;
    }
    //var subasta=
   
    
      $.ajax({
        url:'../controlador/controllerPerfilUsuarioRegistrado.php',
        method:'POST',
        data:{subasta:subasta, contador:contador,idUser:idUser},
        success:function(data){
       
          $('#Cuadros').html(data);
        }
      });
    }
    function sumarSub(){
     
      var subasta=5;
      var idUser=<?php  echo $online?>;
      var contador=4+ parseInt(sacarContador());
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:"POST",
      data:{subasta:subasta, idUser:idUser, contador:contador},
      success: function(data){
        $('#Cuadros').html(data);
   

       
      }
    });
    }
 
  $(document).ready(function(){
    var info= "<?php echo $informacion?>";
    if(info=="nada"){

    }else{
      swal(info, {icon:"info",});
      <?php unset($_SESSION["informacion"])?>
    }    
  function obtener_datos(contador){
    $('#Cuadros').html('<img style="margin-left: 132%;" src="imagenes/carga.gif" alt="" srcset="">');
    var subasta=2;
    var idUser= <?php echo $online ?>;
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:'POST',
      data:{subasta:subasta,idUser:idUser,contador:contador},
      success:function(data){
        $('#Cuadros').html(data);
       
      }
    });
  }
  obtener_datos(contador);
  function archivadas(contador){
    $('#Cuadros').html('<img style="margin-left: 132%;" src="imagenes/carga.gif" alt="" srcset="">');
    var subasta= 5;
    var idUser=<?php  echo $online?>;
    var contador= contador;
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:'POST',
      data:{subasta:subasta, idUser:idUser, contador:contador},
      success:function(data){
        $('#Cuadros').html(data);
        let sub= document.getElementById('verSubasta');
              sub.className='btn btn-warning ';
              sub.dataset.id=true;
              let ob= document.getElementById('verObras');
              ob.className= 'btn btn-warning ';
              ob.dataset.id=true;
      }
    });
  }
  function subastadas(contador){
    $('#Cuadros').html('<img style="margin-left: 132%;" src="imagenes/carga.gif" alt="" srcset="">');
    var subasta= 1;
    var idUser=<?php  echo $online?>;
    var contador= contador;
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:'POST',
      data:{subasta:subasta, idUser:idUser, contador:contador},
      success:function(data){
        $('#Cuadros').html(data);
        let sub= document.getElementById('verSubasta');
              sub.className='btn btn-warning ';
              sub.dataset.id=true;
              let ob= document.getElementById('verObras');
              ob.className= 'btn btn-warning ';
              ob.dataset.id=true;
      }
    });
  
  }

  $(document).on("click", "#archivar",function(){
    swal({
      title: "Esta seguro de querer archivar?",
      text: "La obra quedara archivado, es decir, fuera del ojo publico y tu lista de 'obras'",
      incon:"warning",
      buttons: true,
      dangermode:true,
      
    }).then((willDelete)=>{
        if (willDelete) {
          var parametros=<?php echo $online ?>;
          var id=$(this).data("id");
          var contador=$(this).data("web");
          
          $.ajax({
            url:'../controlador/controllerPerfilUsuarioRegistrado.php',
            method:"POST",
            data:{parametros:parametros,id:id,contador:contador },
            success: function(data){
              $('#Cuadros').html(data);
             
              swal("Ha sido archivado con exito", {icon:"info",});
              obtener_datos(contador);
          }
          });
            
        }else{
          swal("No se ha archivado nada");
        }
    });  
        

    })
    $(document).on("click", "#desarchivar",function(){
    swal({
      title: "Esta seguro de querer desaarchivar?",
      text: "La obra saldra al ojo publico, es decir, se vera para el publico en tu lista de 'obras'",
      incon:"warning",
      buttons: true,
      dangermode:true,
      
    }).then((willDelete)=>{
        if (willDelete) {
          subasta=6;
          var parametros=<?php echo $online ?>;
          var id=$(this).data("id");
          var contador=$(this).data("web");
          
          $.ajax({
            url:'../controlador/controllerPerfilUsuarioRegistrado.php',
            method:"POST",
            data:{subasta:subasta,parametros:parametros,id:id,contador:contador },
            success: function(data){
              $('#Cuadros').html(data);
              swal("Ha sido archivado con exito", {icon:"info",});
              archivadas(contador);
             
          }
          });
            
        }else{
          swal("No se ha editado nada");
        }
    });  
        

    })
  
  $(document).on("click", "#verSubasta",function(){
    var subasta= 1;
    var idUser=<?php echo $online ?>;
    let btn= document.getElementById("cuenta");
    btn.dataset.id=4;
  
    var contador= sacarContador();
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:"POST",
      data:{subasta:subasta, idUser:idUser, contador:contador},
      success: function(data){
        $('#Cuadros').html(data);
        $('#titular').html("Subastas disponibles");
        let sub= document.getElementById('verSubasta');
        sub.className='btn btn-warning disabled';
        sub.dataset.id=false;
        let ob= document.getElementById('verObras');
        ob.className= 'btn btn-warning';
        ob.dataset.id=true;
      }
    });

  })
  $(document).on("click", "#verObras",function(){

    var subasta= 2;
 
    var idUser=<?php echo $online ?>;
    
    var btn= document.getElementById("cuenta");
    var newCuenta=4;
    
    var contador= sacarContador(newCuenta);
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:"POST",
      data:{subasta:subasta, idUser:idUser, contador:contador},
      success: function(data){
        $('#Cuadros').html(data);
        $('#titular').html("Obras disponibles");

        let sub= document.getElementById('verSubasta');
        sub.className='btn btn-warning ';
        sub.dataset.id=true;
        let ob= document.getElementById('verObras');
        ob.className= 'btn btn-warning disabled';
        ob.dataset.id=false;
      }
    });

  })

  $(document).on("click", "#verArchivadas", function(){
    var subasta=5;
    var idUser=<?php  echo $online?>;
    var contador= 4;
    $.ajax({
      url:'../controlador/controllerPerfilUsuarioRegistrado.php',
      method:"POST",
      data:{subasta:subasta, idUser:idUser, contador:contador},
      success: function(data){
        $('#Cuadros').html(data);
        $('#titular').html("Obras archivadas");

        let sub= document.getElementById('verSubasta');
        sub.className='btn btn-warning ';
        sub.dataset.id=true;
        let ob= document.getElementById('verObras');
        ob.className= 'btn btn-warning ';
        ob.dataset.id=true;
      }
    });



  })
  ///acqui coloco lo nuevo
  $(document).on("click", "#eliminar", function(){
    swal({
      title: "¿Esta seguro de querer eliminar?",
      text: "La obra borrara toda la informacion asociadas, compras, imagen, numeros de ventas y de visitas entre otros",
      incon:"warning",
      buttons: true,
      dangermode:true,
      
    }).then((willDelete)=>{
      if (willDelete) {
        var subasta=7;
        var idUser=<?php  echo $online?>;
        var idObra= $(this).data("id");
        var contador= $(this).data("web");
        var estado = $(this).data('estado');
        
        $.ajax({
          url:'../controlador/controllerPerfilUsuarioRegistrado.php',
          method:"POST",
          data:{subasta:subasta, idUser:idUser, contador:contador, idObra:idObra},
          success: function(data){
            swal(data);
            if(estado=='ar'){
              archivadas(contador);
            }else{
              subastadas(contador);
            }
            
          }
        });
        
      }else{
        swal("No se ha elminado nada", {icon:"info",});
      }
      
    });

    
  })


  });
  

  
</script>

