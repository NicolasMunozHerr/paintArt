<?php 
 include_once '../modelo/obra.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/arraylist.php';
 include_once '../modelo/imagen.php';
 include_once '../modelo/artista.php';
 include_once '../modelo/usuarioRegistrado.php';
include_once '../modelo/click.php';
class listaArtista{
   
    public function __construct($idAr, $accion)
    {
      if($idAr!=null && $accion!=null)
      {
        if($accion==0){
          date_default_timezone_set('America/Santiago');
          $fecha= date('Y-m-d');
          $click = new click;
          $resp= $click->agregarClick($fecha);
          if ($resp== false) {
              echo 'ta mal';
          }else{
              $idClick= $click->listarUltimoClick();
              $resp = $click->agregarClickArtistaHasClick($idAr, $idClick->__getIdClick());
              if ($resp==false) {
                  echo 'Error al tomar la cuenta de visita';
              }
          }
        }
      }
      
      
    }
    public function listar($contador){
        $listaAr= new artista(null, null, null);
        $lista= $listaAr->listarArtista();
        $size= $lista->size();
        if($size==0){
          echo "<h6>No hay artistas en la plataforma todavia</h6>";
        }else{
          $a=0;
          for ($i=0; $i <$size ; $i++) {
            if($i<$contador){
              $user= new usuarioRegistrado();
              $inforUser= $user->buscarUusuarioId($lista->get($i)->getIdUsuarioRegistrado());
              //echo '<h1>'.$lista->get($i)->__toString().'</h1>';
              $nombreUsuario= $inforUser->getNombreYApellido();
              $obra=new obra(null, null, null, null , null , null, null, null, null);
              $numObra=$obra->listarObrasArtistas($lista->get($i)->getIdArtista());
              $idImagen= $inforUser->getIdImagen();
              $imagen= new imagen(null);
              $imagen= $imagen->buscarImagenID($idImagen);
              if ($imagen==false) {
                echo '<h6>No se pudo ver la imagen asociada</h6>';
              }else{
                $url =$imagen->getUrlImagen();
                echo '
                  <div class="cajaArtista">
                  <a href="../Vista/verArtista.php?idArtista='.$lista->get($i)->getIdArtista().'">
                      <div style="text-align: center;" class="cuadro">
                      <div class="fotoArtista"> <img src="'.$url.'" alt="" style="height: 100%;
                      object-fit: cover;
                      object-position: center center; "></div>
                        <br>
                        <div class="cuadroTexto">
                          <span><h6>'.$nombreUsuario.'</h6></span>
                        <span><h6>obras Disponible:'.$numObra->size().' </h6></span>
                        </div> 
                      </div>
                  </a>
                  </div>
                '; 
                $a++;
              }
           
            }
           
           
          }
          if( $a<$size){
            echo '
                <table style="width:100%"> 
                    <td>      
                        <button type="button" onClick="sumar()"   id="cuenta" data-id="'.$contador.'" class="btn btn-warning btn-lg">Cargar mas obras</button>
                    </td> 
                </table>';
          }
        }
        
    }

    public function verArtista($idArtista){
      $artista= new artista(null, null,null,null,null);
      $inforArtista= $artista->buscarIdArtista($idArtista);
      if($inforArtista==false){
        echo 'Upsss, no encontramos al artista';
      }else{
        $user= new usuarioRegistrado();
        $inforUser=$user->buscarUusuarioId($inforArtista->getIdUsuarioRegistrado());
        if ($inforUser==false) {
          echo 'Upsss, no encontramos al artista';
        }else{
          echo $inforUser->getNombreYApellido();
        }
      }
    }

    public function verBiografiaArtista($idArtista){
      $artista= new artista(null, null,null,null,null);
      $inforArtista= $artista->buscarIdArtista($idArtista);
      if($inforArtista==false){
        echo 'Upsss, no encontramos al artista';
      }else{
        $biografia= $inforArtista->getBiografia();
        if($biografia==''|| $biografia==null){
          echo 'No se a registrado una biografia aun';
        }else{

          echo $biografia;
        }
      }
    }

    public function listarArtistaNombre($busqueda,$contador){
      $usuario= new usuarioRegistrado();
      $listaUsuarios= $usuario->buscarArtistas($busqueda);
      if ($listaUsuarios==false) {
        echo '<h6>No hay artistas bajo ese nombre</h6>';
      }else{
        $a=0;
        $size= $listaUsuarios->size();
        for ($i=0; $i <$size ; $i++) {
          if($i<$contador){
            $ar= new artista(null, null, null);
            $idAr= $ar->buscarArtistaIdUser($listaUsuarios->get($i)->getId());
            if ($idAr==false) {
              //echo '<h6>No encontramos el artista en concreto</h6>';
            }else{
              $idAr= $idAr->getIdArtista();
              $idImagen= $listaUsuarios->get($i)->getIdImagen();
              $imagen= new imagen(null);
              $imagen= $imagen->buscarImagenID($idImagen);
              if ($imagen== false) {
                echo '<h6>No encontramos a la imagen asociada</h6>';
              }else{
                $url = $imagen->getUrlImagen();
                $obra=new obra(null, null, null, null , null , null, null, null, null);
                $numObra=$obra->listarObrasArtistas($idAr);
                echo '
                <div class="cajaArtista">
                <a href="../Vista/verArtista.php?idArtista='.$idAr.'">
                    <div style="text-align: center;" class="cuadro">
                    <div class="fotoArtista"> <img src="'.$url.'" alt="" style="height: 100%;
                    object-fit: cover;
                    object-position: center center; "></div>
                      <br>
                      <div class="cuadroTexto">
                        <span><h6>'.$listaUsuarios->get($i)->getNombreYApellido().'</h6></span>
                      <span><h6>obras Disponible:'.$numObra->size().' </h6></span>
                      </div> 
                    </div>
                </a>
                </div>
                '; 
              
              }
              $a++;
            }
         
          }
        }
        if( $a<$size){
          echo '
              <table style="width:100%"> 
                  <td>      
                      <button type="button" onClick="sumar()"   id="cuenta" data-id="'.$contador.'" class="btn btn-warning btn-lg">Cargar mas obras</button>
                  </td> 
              </table>';
        }
      }

    }

    public function mostrarFotoPerfil($idArtista){
      $artista= new artista(null, null,null);
      $artista= $artista->buscarIdArtista($idArtista);
      if ($artista==false) {
          echo '<h6>No hay una artista asociado</h6>';

      }else{
          $idUser= $artista->getIdUsuarioRegistrado();
          $user= new usuarioRegistrado();
          $user= $user->buscarUusuarioId($idUser);
          if($user==false){
              echo '<h6>No hay usuarios asociados</h6>';
          }else{
              $idImagen= $user->getIdImagen();
              $imagen= new imagen(null);
              $imagen = $imagen->buscarImagenID($idImagen);
              if ($imagen==false) {
                  echo '<h6>No hay imagen asociados</h6>';
              }else{
                  $url= $imagen->getUrlImagen();
                  echo $url;
              }
          }
      }
  }




}

if(!empty($_POST['param'])){
  $param = $_POST['param'];
  if($param== "nada"){
    $lista= new listaArtista(null,null);
    $contador= $_POST['contador'];
    echo $lista->listar($contador);
    
  }else{
    $lista= new listaArtista(null, null);
    $contador= $_POST['contador'];
    echo $lista->listarArtistaNombre($param, $contador);
  }
  
}

?>