<?php 
include_once '../controlador/controllerVentas.php';
session_start();
$controller= new controllerVentas();
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
    <link rel="stylesheet" href="Css/listaPeticiones.css">
    <link rel="stylesheet" href="Css/cssMain.css">
    <link rel="stylesheet" href="Css/cssindexL.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" charset="utf-8"></script>
    <link href="https://canvasjs.com/assets/css/jquery-ui.1.11.2.min.css" rel="stylesheet" />
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery-ui.1.11.2.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



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
                  <li class="nav-item"><a class="nav-link" href="#"><img style="width:30px; max-width:30px; heigth: 30px; max-heigth: 30px" src="imagenes/compras.png" alt="">Mis compras</a></li>
                  <li class="nav-item"><a class="nav-link" href="#"><img style="width:30px; max-width:30px; heigth: 30px; max-heigth: 30px" src="imagenes/notificacion.png" alt="">Mis pedidos</a></li>
                  <li class="nav-item"><a class="nav-link" href="../controlador/controllerAccesadorUsuarios.php"><img style="width:30px; max-width:30px; heigth: 30px; max-heigth: 30px"  src="imagenes/user.png" alt="">Mi perfil</a></li>
                </div>
                ';
              }
            
            
            ?>
          </div>
        </ul>
      </nav>
      <h3 style="margin-top: 10px;margin-left: 10px;">Mis numeros  </h3>
      <p style="margin-top: 10px;margin-left: 10px;"><h6 style="margin-top: 10px;margin-left: 10px;"><b id="mes"></b></h6></p>

    
        
      <div id="Inputs" class="container">
      

        <?php 
        //$controller->listarReporte();
        
        ?>
        <div class="contenedorPetcion">
          <div style="width: 100%; height: auto;" class="listaPeticiones">
          <h3>Resumen de popularidad del mes de <b id= "mes2"></b></h3>

          <br>
          <div style="text-align:left; width: 95%" class="peticion">
                
                <h5>Cantidad de visitas en el perfil  <?php echo $controller->mostrarCantidadDevisitasPerfilEsteMes($online)?></h5>
                <h5>Cantidad de visitas a las obras : <?PHP ECHO $controller->mostrarCantidadDevisitasObrasEsteMes($online)?></h5>
                <h5>Lo mas comentados: <a style="text-decoration: none;color:black" 
                <?php 
                  $resp= $controller->mostrarMayorComentado($online);
                  if($resp== 0){
                    echo '
                    onclick="error()"
                    
                    ';
                  }else{
                    echo 'href="detalleObra.php?id='.$resp.'"';
                  }
                ?>><button type="submit" class="btn btn-warning">Ver Obra</button></a> </h5>     </h5> 
                <h5>Obra mayor visitada:  <a style="text-decoration: none;color:black" 
                <?php $resp= $controller->mostrarObraMasVisitada($online) ;
                    if($resp==0 ){
                      echo '
                        onclick="error()"
                        
                        ';
                    }else{
                      echo 'href="detalleObra.php?id='.$resp.'"';
                    }
                
                ?>><button type="submit" class="btn btn-warning">Ver Obra</button></a> </h5>               
                <br>
          </div>
              <br>
              <br>
              <h3 >Resumen de popularidad ultimos <b>6 meses</b> </h3>
              <br>
              <div style="text-align:left; width: 95%" class="peticion">
              <br>
                <h4 style="text-align:center ;"> <b> Visitas al perfil los ultimos 6 meses</b></h4>
                <div id="VisitasPerfil" style="height: 90%; width: 90%; margin:auto;height:300px " ></div>
                <P></P>
                <h4 style="text-align:center ;"> <b> Visitas a sus obras los ultimos 6 meses</b></h4>

                <div id='VisitasObras'style="height: 90%; width: 90%; margin:auto;height:300px "  ></div>
            </div>
            <br>
            <br>  

            <h3>Resumen contable de Obras a la venta de este mes</h3>
            <div style="text-align:left; width: 95%" class="peticion">
                <?php 
                  echo $controller->mostrarVentasMesGeneral($online);
                ?>
                <h4 style="text-align: center;"><b>Tipos de ingresos</b></h4>
                <div id="chartContainer" style="height: 370px; width: 90%;margin:auto; margin-bottom:10px"></div>
                <h4 style="text-align: center;"><b>Ventas por categoria</b></h4>
                <div id="resizable" style="height: 370px;">
	                <div id="chartContainer1" style="height: 90%; width: 90%; margin:auto"></div>
                </div>
            </div>
            <h3>Resumen contable de Obras a la venta de los ultimos 6 meses</h3>
            <div style="text-align:left; width: 95%" class="peticion">
                <?php 
                  echo $controller->mostrarVentasGeneralUltimosSeisMeses($online);
                ?>
                <h4 style="text-align: center;"><b>Tipos de ingresos</b></h4>
                <div id="tipoIngresosUltimosSeisMeses" style="height: 370px; width: 90%;margin:auto; margin-bottom:10px"></div>
                <h4 style="text-align: center;"><b>Ventas de obras los ultimos seis meses</b></h4>
                <div id="resizable" style="height: 370px;">
	                <div id="ventasObrasUltimosSeisMeses" style="height: 90%; width: 90%; margin:auto"></div>
                </div>
                <h4 style="text-align: center;"><b>Ingresos por peticiones los ultimos seis meses</b></h4>
                <div id="resizable" style="height: 370px;">
	                <div id="peticionesUltimosSeisMeses" style="height: 90%; width: 90%; margin:auto"></div>
                </div>
                <h4 style="text-align: center;"><b>Ingresos por subastas los ultimos seis meses</b></h4>
                <div id="resizable" style="height: 370px;">
	                <div id="subastasUltimosSeisMeses" style="height: 90%; width: 90%; margin:auto"></div>
                </div>
            </div>
            
            
            
          </div>
        </div> 
      
        
         

       
</body>
</html>
<script type="text/javascript">

  function error(){
    swal({
      text: "No hay registros asociados para ver!",
    });
  }

  const MESES = [
  "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
  "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre",
  ];
  const date = new Date();
  document.getElementById("mes").innerHTML= MESES[date.getMonth()]+ " de "+ date.getFullYear();
  document.getElementById("mes2").innerHTML= MESES[date.getMonth()]+ " de "+ date.getFullYear();
  


 window.onload = function () {

// Construct options first and then pass it as a parameter
var ventasObra= <?php echo $controller->mostrarVentasObras($online) ?>;
var ventasPet= <?php echo $controller->mostrarVentasPeticiones($online) ?>;
var ventasSub= <?php echo $controller->mostraVentasSubasta($online) ?>;
var total= ventasObra+ventasPet+ventasSub;
var pocenObra=  ventasObra/total*100;
var porcenPet= ventasPet/total*100;
var porcenSub= ventasSub/total*100;
<?php date_default_timezone_set("America/Santiago");setlocale(LC_TIME,"spanish");?>
var visitarAr= {
  theme:'dark2',
  
  axisX:{
   title:"MESES - AÑO "    
  },
  axisY:{
    title:'CANTIDAD DE VISITAS '
  },
  data:[{
    type:'line',
    showInLegend:true,
    name:'Visitas al perfil',
    markerType:'square',
    color: "#F08080",
    dataPoints:  <?php echo json_encode($controller->visitasPorMesArtista($online), JSON_NUMERIC_CHECK) ;?>
    
  }]
};
$('#VisitasPerfil').CanvasJSChart(visitarAr);

var visitarOB={
  theme:'dark2',
	
  axisY:{
    title:"CANTIDAD DE VISITAS "    
  },
  axisX:{
    title:"MES - AÑO "    
  },
	data: [              
	{
		type: "line",
    dataPoints:  <?php echo json_encode($controller->visitasPorMesObras($online), JSON_NUMERIC_CHECK) ;?>

  }]
};
$('#VisitasObras').CanvasJSChart(visitarOB);

var options = {
	title: {
		
	},
  theme:"dark2",

	subtitles: [{
		text: "Mes de <?php echo strftime("%B")?>, <?php echo date("Y")?>"
	}],
	data: [{
		type: "pie",
		startAngle: 40,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
			{ y: porcenPet.toFixed(2), label: "Peticiones" },
			{ y: porcenSub.toFixed(2), label: "Subasta " },
			{ y: pocenObra.toFixed(2), label: "Ventas de obras" }
			
		]
	}]
};
$("#chartContainer").CanvasJSChart(options);


var options = {
  theme:'dark2',
	title: {
		//text: "Column Chart in jQuery CanvasJS"              
	},
  axisY:{
    title:"Monto (CLP) "    
  },
  axisX:{
    title:"CATEGORIAS "    
  },
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "column",
		dataPoints: <?php echo json_encode($controller->ordenarCat($online), JSON_NUMERIC_CHECK) ;?>
	}
	]
};

$("#chartContainer1").CanvasJSChart(options);


var ventasObra= <?php echo $controller->mostrarVentasObrasUltimosSeisMeses($online) ?>;
var ventasPet= <?php echo $controller->mostrarVentasPeticionUltimoSeisMeses($online) ?>;
var ventasSub= <?php echo $controller->mostrarVentasSubasUltimosSeisMeses($online) ?>;
var total= ventasObra+ventasPet+ventasSub;
var pocenObra=  ventasObra/total*100;
var porcenPet= ventasPet/total*100;
var porcenSub= ventasSub/total*100;

var options = {
	title: {
		
	},
  theme:"dark2",

	subtitles: [{
		text: "Ultimos seis meses",
	}],
	data: [{
		type: "pie",
		startAngle: 40,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
			{ y: porcenPet.toFixed(2), label: "Peticiones" },
			{ y: porcenSub.toFixed(2), label: "Subasta " },
			{ y: pocenObra.toFixed(2), label: "Ventas de obras" }
			
		]
	}]
};
$("#tipoIngresosUltimosSeisMeses").CanvasJSChart(options);
 

var ventasOb={
  theme:'dark2',
	
  axisY:{
    title:"MONTOS [CLP] "    
  },
  axisX:{
    title:"MES - AÑO "    
  },
	data: [              
	{
    color: "#F08080",

		type: "line",
    dataPoints:  <?php echo json_encode($controller->ventasUltimosSeisMeses($online), JSON_NUMERIC_CHECK) ;?>

  }]
};
$('#ventasObrasUltimosSeisMeses').CanvasJSChart(ventasOb);



var peti={
  theme:'dark2',
	
  axisY:{
    title:"MONTOS [CLP] "    
  },
  axisX:{
    title:"MES - AÑO "    
  },
	data: [              
	{
    color: "#F08080",
	

		type: "line",
    dataPoints:  <?php echo json_encode($controller->peticionesUltimosSeisMeses($online), JSON_NUMERIC_CHECK) ;?>

  }]
};
$('#peticionesUltimosSeisMeses').CanvasJSChart(peti);
var sub={
  theme:'dark2',
	
  axisY:{
    title:"MONTOS [CLP] "    
  },
  axisX:{
    title:"MES - AÑO "    
  },
	data: [              
	{
    color: "#F08080",
	

		type: "line",
    dataPoints:  <?php echo json_encode($controller->subUltimosSeisMeses($online), JSON_NUMERIC_CHECK) ;?>

  }]
};
$('#subastasUltimosSeisMeses').CanvasJSChart(sub);

}

</script>
