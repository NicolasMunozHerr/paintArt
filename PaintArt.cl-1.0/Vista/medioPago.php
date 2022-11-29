<?php 
include_once '../controlador/controllerValidarTarjeta.php';
session_start();
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
             <h2 style="margin-top: 20px;">Agregar/modificar medio de pago</h2>
             <br>
            <h5 style="margin: auto;width: 50% ; text-align: justify;"><b>los medios de pagos son guardados para futuras actividades como peticiones personalizadas de obras o pujas de subastas y asi efectuar el cobro correspondiente</b> </h5>
            <p></p>
            <div id="infoTarjeta" style="display: inline-block;">
            
            </div>
            
            <div class="form-group formulario" > 
              <form action="../controlador/controllerMedioPago.php" method="post" enctype="multipart/form-data">
                <table class="formularioRegistrar" > 
                <select name="parametros" value=2 hidden style=" border-radius: 0px; border: 0px;" class="form-select" id="exampleSelect1">
                    <tr> 
                      <td><h5>Tipo de tarjeta</h5></td> 
                    </tr> 
                    <tr>
                        <td> 
                            <select name="tipoTarjeta" style=" border-radius: 0px; border: 0px;" class="form-select" id="exampleSelect1">
                                <option>Debito</option>
                                <option>Credito</option>
                              </select>
                        </td> 
                    </tr>
                    <tr> 
                    <tr> 
                         <td><h5>Numero de tarjeta</h5></td> 
                    </tr> 
                    <tr>
                        <td>
                        <input name="numTarjeta"  maxlength="16" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"type="number" class="form-control" placeholder="1234 1234 1234 1234" id="inputDefault" required> 
                        </td>
                    </tr>
                      <td><h5>Fecha de caducidad</h5></td> 
                    </tr> 
                    <tr>
                        <td> <select required name="mesC" style="width: 45%; float: left;" type="number" class="form-select" placeholder="mes" id="inputDefault">
                                <option hidden selected>Mes</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>  
                                <option value="4">04</option>  
                                <option value="5">05</option>  
                                <option value="6">06</option>  
                                <option value="7">07</option>  
                                <option value="8">08</option>  
                                <option value="9">09</option>  
                                <option value="10">10</option>  
                                <option value="11">11</option> 
                                <option value="12">12</option> 
                          </select>
                          
                            <input name="añoC" required min="22" max="99"oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2"  style="width: 45%; float: right; margin-left: 20px;" type="number" type="text" class="form-control" placeholder="Año (ulimos dos digitos)" id="inputDefault"></td> 
                    </td> 
                    </tr>
                    <tr> 
                        <td><h5>cvv</h5></td> 
                      </tr> 
                      <tr>
                          <td> <input  required min="100" max="999" maxlength="3" name="codigoV"  type="number" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="123" id="inputDefault"></td> </td> 
                      </tr>                     
                    <tr>
                     
                    </tr>  
                      
                    <tr> 
                      <td style="text-align: right; "> 
                        <br>
                        <input type="submit" name="subir" style="background-color: #212529; border-radius: 0px ; border-color: #212529; color: #dee2e6;" class="btn btn-primary" value="guardar">
                      </td> 
                    </tr> 
                </table> 
              </form>

            </div>  
      </div> 

</body> 
<?php include_once 'footer.php';?>
</html> 


<script>
$(document).ready(function(){

  function obtener_datos(){
    var parametros=1;
    $.ajax({
      url:'../controlador/controllerMedioPago.php',
      method:'POST',
      data:{parametros:parametros,},
      success:function(data){
        $('#infoTarjeta').html(data);
        
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
            alert(data);
            
    }
    });
    
    })


});


</script>


