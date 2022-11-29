<?php 
session_start();
$id=$_GET['id'];

$_SESSION['idCompra']= $id;

include_once '../controlador/controllerDetalleObra.php';
include_once '../controlador/controllerSubasta.php';
$sb= new controllerSubasta;
$ob= new mostrarObra($id);

?>
<?php ;
$online= false;
if( empty($_SESSION["online"]))
{
  $online= false;
}else{
  $online =  $_SESSION["online"];
  
}

$resp= $ob->validarSubasta($id);

if($resp==false){
    unset($_SESSION['idCompra']);
    header("Location: index.php");
 
}else{
  
  
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
            
            <div class="subasta" >
                <div class="big-Image">
                    <img style= "width: 100%; max-width: 100%; height: 100%; max-height: 100%; object-fit: cover; object-position: center;" src="<?php echo $ob->mostrarImagen($id) ?>" alt="">
                </div>
                <div class="reporte">
                  <a href="subirReporte.php?idObra=<?php echo $id ?>">  <img style="width: 150%; max-width:150% ; height:150% ; max-height:150% ;" src="imagenes/bandera.png" alt=""></a>
                </div>
                <div  class="titulares">
                <span><b >Termina:</b><h3><div  id="clock">
                         <?php if($online ==false){
                            echo 'Incie sesion para ver el tiempo de la subasta';
                        }else{
                         echo ('cargando');
                        }  ?>
                    </div></h3></span>
                    <br>
                    <span><h4><?php echo $ob->mostraObra($id)->getTitulo()?></h6>
                    </span>
                    
                    <span><h6>Por: <?php echo $ob->mostraNonmbre($id) ?></h6></span>
                    <br>
                    <div class="detalleCompra">
                        
                       
                        <br>
                        <span><h5>Puja actual</h5> <p></p><h5 id="PujaActual">$<?php echo $sb->mostrarPujaAcTual($id)?></h5></span>
                        <br>
                        <span><h5>Precio inicial <p></p> $<?php echo $sb->mostrarPrecioMinimo($id)?></h6></span>

                        <P></P>
                        <table >
                        
                          <?php 
                            
                            /*if($stock==0){
                              echo '<tr><td><button id= "compra" type="button" class="btn btn-dark  btn-lg">Comprar</button></span></td></tr>';
                            }else{
                              echo '<tr><td> <a href="comprar.php"><button type="button" class="btn btn-primary btn-lg">Comprar</button></a></span></td></tr>';
                            }*/
                          ?>
                          <p></p>
                          
                          <b>Pujar por:</b><br>
                          <div class="valorPuja">
                          <select id="valorPuja"   name="region" style=" border-radius: 0px; border: 0px; width: 200px;" class="form-select " id="exampleSelect1">
                            <option value="10000">$10.000</option>
                            <option value="20000">$20.000</option>
                            <option value="50000">$50.000</option>
                            <option value="80000">$80.000</option>
                            <option value="100000">$100.000</option>
                          </select>
                          </div>
                          <tr><td><button id="carga" type="button" style= "width:200px; "class="btn btn-primary btn-lg " >Pujar</button> </span></td></tr> 
                        </table>
                    </div>
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

<script>
    const getRemainTime= deadline=>{
    let now= new Date(),
        remainTime=(new Date(deadline)-now+1000)/1000,
        remainSeconds=('0'+Math.floor(remainTime %60)).slice(-2),
        remainMinutes=('0'+Math.floor(remainTime/60%60)).slice(-2),
        remainHours=('0'+Math.floor((remainTime/3600%24))).slice(-2),
        remainDay=('0'+Math.floor(remainTime/(3600*24)));

    return{
        remainTime,
        remainSeconds,
        remainMinutes,
        remainHours,
        remainDay


    }

};
const countdown=(deadline, elem, finalMessage)=>{

    const el= document.getElementById(elem);
    const timerUpdate= setInterval(() =>{
        let t= getRemainTime(deadline);
        el.innerHTML=`${t.remainDay}d ${t.remainHours}h:${t.remainMinutes}m:${t.remainSeconds}s`;
        if(t.remainTime<=1){
            clearInterval(timerUpdate);
            el.innerHTML=finalMessage;
            const button2= document.getElementById('carga');
            button2.removeAttribute("id");
            button2.setAttribute("id", "pujar");
            const button= document.getElementById('pujar');
            button.removeAttribute("id");
            button.setAttribute("id", "Bloqueo");
            
        }else{
          const button2= document.getElementById('carga');
            button2.removeAttribute("id");
            button2.setAttribute("id", "pujar");
           
        }
    },1000)

}
countdown("<?php echo $resp->__getFechaLimite() ?> ", 'clock', 'subasta Terminada');



  $(document).ready(function(){
    function obtener_datos(){
      
      var parametros="2";
      var idObra= <?php echo $id ?>;
      $.ajax({
        url:'../controlador/controllerPujar.php',
        method:'POST',
        data:{parametros:parametros,idObra:idObra,},
        success:function(data){
        $('#PujaActual').html(data);
          
        }
      });
    }
    obtener_datos();
    $(document).on("click", "#pujar",function(){
          var parametros=1;
          var idObra=<?php echo $id?>;
          var idUser=<?php echo $online  ?>;
          var valorPuja=document.getElementById("valorPuja").value;
          
          $.ajax({
          url:'../controlador/controllerPujar.php',
          method:"POST",
          data:{parametros:parametros,idObra:idObra, idUser:idUser,valorPuja:valorPuja,},
          success: function(data){
              if(data==0)
              {
                
                window.location.href = "Pujar.php?idObra="+idObra;
              }
              if(data!=0){
                  alert(data);
              }
              
              obtener_datos();       
          }
      });

      })

      $(document).on("click", "#Bloqueo",function(){
        alert("La subas ya ha finalizado");
      }) 

  });

</script>


