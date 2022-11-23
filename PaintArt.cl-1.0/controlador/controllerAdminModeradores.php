<?php 

include_once '../modelo/arraylist.php';
include_once '../modelo/usuarioRegistrado.php';
$parametros= $_POST['parametros'];
class controllerAdm{

    public function listarUsuario(){
        $user= new usuarioRegistrado();
        $lista= $user->listarUsuarioRegistrado();
        $size= $lista->size();
        if($size==0){
            echo '<h6>Actualmente no hay usuario</h6>';
        }else{
            for ($i=0; $i < $size; $i++) { 
                echo'
                <div style="text-align:left " class="peticion">
                    <div class="foto"><img src="imagenes/usuario.png" alt=""></div>
                    <div class="nombreYapellido">
                    <h6>'.$lista->get($i)->getNombre().'</h6>
                    <br>
                    <h6>'.$lista->get($i)->getApellido().'</h6></div>
                </div>
                <div style="float: right; border: none;" class="botoneraApruebaRechazo">
                    <div class="apruebo"  ><button type="submit"  style="width: 100%; height:100% ; border: none;" id="apruebo" data-id="'.$lista->get($i)->getId().' "><img src="imagenes/aceptar.png" alt=""></button></div>
                </div>
                ';
            }
        }
    }
    public function lisMod(){

        $user= new usuarioRegistrado();
        $lista= $user->listarModeradores();
        $size= $lista->size();
        if($size==0){
            echo '<h6>Actualmente no hay usuario</h6>';
        }else{
            for ($i=0; $i < $size; $i++) { 
                
                    echo'
                <div style="text-align:left " class="peticion">
                    <div class="foto"><img src="imagenes/usuario.png" alt=""></div>
                    <div class="nombreYapellido">
                    <h6>'.$lista->get($i)->getNombre().'</h6>
                    <br>
                    <h6>'.$lista->get($i)->getApellido().'</h6></div>
                </div>
                <div style="float: right; border: none;" class="botoneraApruebaRechazo">
                    <div class="apruebo"  ><button type="submit"  style="width: 100%; height:100% ; border: none;" id="apruebo" data-id="'.$lista->get($i)->getId().' "><img src="imagenes/aceptar.png" alt=""></button></div>
                </div>
                ';
               
                
            }
        }
    }

    public function hacerloAdmin($id){
        $user= new usuarioRegistrado();
        $resp = $user->cambiarPermiso(4, $id);
        if($resp==false){
            echo "No se ha podido ascender a moderador";
        }else{
            echo 'Se ha podido exitosamente ascender a moderador';
        }


    }

    public function sacaleAmin($id){
        $user= new usuarioRegistrado();
        $resp = $user->cambiarPermiso(1, $id);
        if($resp==false){
            echo "No se ha podido descender de moderador";
        }else{
            echo 'Se ha podido exitosamente descender de moderador';
        }
    }

    public function busquedaUsuario($name){
        $user= new usuarioRegistrado();
        $lista= $user->buscarUsuarioNombres($name);
        
        $size= $lista->size();
        if($size==0 ||$lista== false){
            echo '<h6>Actualmente no hay usuario</h6>';
        }else{

            for ($i=0; $i < $size; $i++) { 
                if($lista->get($i)->getPermisos()==2||$lista->get($i)->getPermisos()==5 ||$lista->get($i)->getPermisos()==3){
                   
                }else{
                    echo'
                    <div style="text-align:left " class="peticion">
                        <div class="foto"><img src="imagenes/usuario.png" alt=""></div>
                        <div class="nombreYapellido">
                        <h6>'.$lista->get($i)->getNombre().'</h6>
                        <br>
                        <h6>'.$lista->get($i)->getApellido().'</h6></div>
                    </div>
                    <div style="float: right; border: none;" class="botoneraApruebaRechazo">
                        <div class="apruebo"  ><button type="submit"  style="width: 100%; height:100% ; border: none;" id="apruebo" data-id="'.$lista->get($i)->getId().' "><img src="imagenes/aceptar.png" alt=""></button></div>
                    </div>
                    ';
                }
                
            }
        }
    }

    public function busquedaMod($name){
        $user= new usuarioRegistrado();
        $lista= $user->buscarUsuarioNombres($name);
        
        $size= $lista->size();
        if($size==0 ||$lista== false){
            echo '<h6>Actualmente no hay usuario</h6>';
        }else{

            for ($i=0; $i < $size; $i++) { 
                if($lista->get($i)->getPermisos()==4){
                    echo'
                    <div style="text-align:left " class="peticion">
                        <div class="foto"><img src="imagenes/usuario.png" alt=""></div>
                        <div class="nombreYapellido">
                        <h6>'.$lista->get($i)->getNombre().'</h6>
                        <br>
                        <h6>'.$lista->get($i)->getApellido().'</h6></div>
                    </div>
                    <div style="float: right; border: none;" class="botoneraApruebaRechazo">
                        <div class="apruebo"  ><button type="submit"  style="width: 100%; height:100% ; border: none;" id="apruebo" data-id="'.$lista->get($i)->getId().' "><img src="imagenes/aceptar.png" alt=""></button></div>
                    </div>
                    ';
                }
                
            }
        }

    }

}


if ($parametros==1) {
    $controller= new controllerAdm();
    echo $controller->listarUsuario();
}elseif ($parametros==2) {
   $id= $_POST['id'];
    $controller = new controllerAdm;
    echo $controller-> hacerloAdmin($id);
}elseif ($parametros==3) {
    $controller= new controllerAdm();
    echo $controller->lisMod();
}elseif ($parametros==4) {
    $id= $_POST['id'];
    $controller= new controllerAdm();
    echo $controller->sacaleAmin($id);
}elseif ($parametros==5) {
    $id= $_POST['id'];
    $controller= new controllerAdm();
    echo $controller->busquedaUsuario($id);
}elseif ($parametros==6) {
    $id= $_POST['id'];
    $controller= new controllerAdm();
    echo $controller->busquedaMod($id);
}


?>