<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="Css/bootstrap.min.css"> 
    <link rel="stylesheet" href="Css/registrar.css"> 
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
              <!--<table> 
                <td> <a class="nav-link" href="">Registrar</a></td> 
                <td>   <a class="nav-link" href="">Iniciar</a></td> 
              </table>--> 
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
      <div class="container" style="background-color: #f8f9fa;
      border: 1px solid #dee2e6;"> 
             <h2 style="margin-top: 20px;">Subir obra</h2>
            <div class="form-group formulario" > 
              <form action="../controlador/subirObra.php" method="post" enctype="multipart/form-data">
                <table class="formularioRegistrar"> 
                    <tr> 
                      <td><h5>Titulo</h5></td> 
                    </tr> 
                    <tr>
                        <td><input required type="text" name="titulo" class="form-control" placeholder="Titulo" id="titulo"></td>
                    </tr>

                    <tr> 
                      <td><h5>Categoria</h5></td> 
                    </tr> 

                    <tr>
                        <td> 
                            <select name="categoria" style=" border-radius: 0px; border: 0px;" class="form-select" id="exampleSelect1">
                                <option>Arte urbano</option>
                                <option>Arte optico</option>
                                <option>Arte cinetico</option>
                                <option>Surrealismo</option>
                                <option>Neoplasticismo</option>
                                <option>Dadaismo </option>
                                <option>Suprematismo</option>
                                <option>Contructivismo</option>
                                <option>Minimalismo</option>
                                <option>Rayonismo</option>
                                <option>Abstraccion lirica</option>
                                <option>Expresionismo</option>
                              </select>
                        </td> 
                    </tr>
                    <tr> 

                      <td><h5>Detalles tecnicos</h5></td> 
                    </tr> 
                    <tr>
                        <td> <input required name="detalles" type="text" class="form-control" placeholder="Detalles" id="inputDefault"></td> 
                    </tr>
                    <tr> 

                        <td><h5>tecnica</h5></td> 
                      </tr> 
                      <tr>
                          <td> <input required name="tecnica"type="text" class="form-control" placeholder="tecnica" id="inputDefault"></td> 
                      </tr>
                    <tr> 
                      <td><h5>Dimensiones</h5></td> 
                    </tr> 
                    <tr>
                        <td><input required name="altura" style="width: 45%; float: left;" type="number" class="form-control" placeholder="Altura (cm)" id="inputDefault"> 
                            <input  required name="ancho" style="width: 45%; float: right; margin-left: 20px;" type="number" type="text" class="form-control" placeholder="Ancho (cm)" id="inputDefault"></td> 
                    </tr>
                    <tr> 
                      <td><h5>Precio</h5></td> 
                    </tr> 
                    <tr>
                        <td><input name="precio"type="number" class="form-control" id="floatingInput" placeholder="Precio (CLP)" required></td> 
                    </tr>
                    <tr> 
                      <td><h5>Stock</h5></td> 
                    </tr> 
                    <tr>
                        <td><input name="stock"type="number" class="form-control" id="floatingInput" placeholder="Unidades disponibles" required></td> 
                    </tr>

                    <tr> 
                        <td><h5>Sobre obra</h5></td> 
                      </tr> 
                      <tr>
                          <td><textarea name="sobreObra" style= "border: 0px; border-radius:0px ;" class="form-control" id="exampleTextarea" rows="3" required></textarea></td> 
                      </tr>
                      <tr> 
                        <td><h5>Imagen referencial</h5></td> 
                      </tr> 
                      <tr>
                          <td><input name="imagenObra"class="form-control" type="file" id="formFile" required></textarea></td> 
                      </tr>  
                    <tr> 
                      <td style="text-align: right; "> 
                        <br>
                        <input type="submit" name="subir" style="background-color: #212529; border-radius: 0px ; border-color: #212529; " class="btn btn-primary" value="subir obra">
                      </td> 
                    </tr> 
                  </table> 
              </form>
            </div>  
      </div> 

</body> 
<?php include_once 'footer.php';?>
</html> 