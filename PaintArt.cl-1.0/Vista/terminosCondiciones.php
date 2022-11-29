
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/cssMain.css">
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
            
          </div>
        </ul>
      </nav>
      <div style="background-color:  #f8f9fa!important;     border: 1px solid rgba(0,0,0,.1);" class="container">
              <br>
      <div class="noticia"> <img style="width: 30% ;max-width: 30%; height: 30%; max-height: 30%;" src="imagenes/logoGiganPaintArt.jpg" alt=""></div>

        <h1>Terminos y condiciones</h1>
        <h6> Los términos y condiciones son una serie de normativas de la organización a cargo de PaintArt.cl que se aplican para cualquier usuario dentro de la página, estas tienen el objetivo mantener un orden y declarar responsabilidades legales a los dichos usuarios.</h6>
        <br>
      
        <h2>Terminos y condiciones de convivencia</h2>
        <br>
        <p>Los usuarios que utilicen PaintArt.cl están dispuestas a utilizar las funciones disponibles de una manera moral y éticamente correcto, sin conductas que inciten odio, estafas, trampas entre otros métodos concebidos como de uso malicioso o que afecten la experiencia de uso a los demás. En caso de que se vea envuelto en una clase de actividades sancionable podrá ser revocados de sus permisos dentro de la página.   </p>
        <h2>Terminos y condiciones derechos de autor</h2>
        <br>
        <p>Los derechos de autor son una medida sobre la protección intelectual que puede aplicar penas en el ámbito judicial, los usuarios solo deberán de subir contenido a PaintArt.cl que sean exclusivamente de su procedencia, que tengan permisos de realizar alguna reproducción del contenido o que sea material del interés público.
          Los usuarios son completamente responsables por su contenido ya que PaintArt.cl solo es un mediador por encima de un productor comercial. Igualmente, como organización damos la voluntad a combatir contra la violación de la propiedad intelectual.
          
         </p>
         <p> Para más información por favor visitar el siguiente enlace. <a href="https://www.bcn.cl/leychile/navegar?idNorma=28933">Ley num. 17336, propiedad intelectual</a>
        </p>
        
        <h2>Mas informacion sobre material no apto para PaintArt.cl</h2>
        <p>PaintArt mantiene una postura de libre expresión siempre y cuando estas no violenten y/o
             atenten contra el juicio de la actividad pública basada en el respeto. Es decir, no se permitirán 
             publicaciones que ataquen a ideologias politicas, regilios y/o grupos minoritarios. La actividad de cada usuario debe ser comprendida y ejercida 
             bajo estos parámetros. Por lo que en caso que el grupo de administradores/moderadores crean que la 
             visión de PaintArt se pueda ver afectada y/o perjudicada se aplicaran las medidas y/o sanciones 
             correspondientes dentro del sitio web. </p>

        <h2>Politica y privacidad</h2>
        <p>
        Los datos recolectados seran solo para uso estadístico, el acceso y el tratamiento de estos seran responsables solo personal que sea parte de la organización de PaintArt. Ahora bien comprende como datos personales de los usuarios como la información que desprende de registros de cuenta, medios de pago y compras o adquisiciones dentro de la pagina.
        PaintArt.cl se compromete a utilizar la información recolectada de manera profesional y con transparencia en caso de realizar actividades sobre los datos personales y además como organización tiene la obligación de garantizar el estado de confidencialidad de la información que este trabajandose. 
        Cualquier incoveniente y/o incomodida puede comunicarse al siguiente correo: paintartcl@gmail.com

        </p>
        

       
       
      </div>
              <br>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     
      
     
    </body>
    <?php include_once 'footer.php';?>

</html>