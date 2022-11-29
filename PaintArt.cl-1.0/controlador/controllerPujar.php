<?php         session_start();

include_once '../modelo/subastas.php';
include_once '../modelo/obra.php';
include_once '../modelo/compra.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/registroPujadores.php';
include_once '../modelo/usuarioRegistrado.php';

class controllerPuja{

    public function comprobarSiPujoONo($idUser, $idObra, $valorPuja){
        /*$compra= new compra(null,null, null, null, null, null, null, null);
        $listaCompras= $compra->listarCompraIdObra($idObra);
        if($listaCompras==false){
            return "Opps problemas para percibir las pujas de la subasta";


        }else{
            
            $size= $listaCompras->size();
            $comprobar= false;
            for ($i=0; $i <$size ; $i++) { 
                if($listaCompras->get($i)->getIdUsuarioRegistrado()==$idUser){
                    $comprobar =true;
                }

            }
            if($comprobar==true)
            {
                $registro = new registroPujadores();


            }else{
                session_start();
                $_SESSION['idCompra']= $idObra;
                $_SESSION['valorPuja']= $valorPuja;
                return 0;  

              
            }          
        }*/
        $user= new usuarioRegistrado();
        $user= $user->buscarUusuarioId($idUser);
        if($user==false){
            //header("Location: ../Vista/iniciarSesion.php");
            echo ('Se necesista inicar la sesion');
        }else{
            if($user->getPermisos()==5){
                echo("No puede pujar por incumplir normas comunitarias, muchas gracias");
                //header("Location: ../Vista/Index.php");
                }else{
                    $subasta = new subasta();
                    $resp= $subasta->validaAsociacionObra($idObra);
                    if($resp==false ){
                        return "error en la busqueda de la subasta";
                    }else{
                        $registro = new registroPujadores();
                        $subasta= $resp;
                        $resp= $registro->listarRegistroIdSubUser($idUser, $subasta->__getidSubasta());
                        
                        if($resp==false){
            
                           
                            return 0;
                        }else{
                            $idSubasta=$resp->__getSubasta_idSubasta();
                            $valorPujaMayor= $valorPuja+ $subasta->__getPrecioPuja();
                            $resp=$registro->modificarPuja($valorPujaMayor,$idUser,$idSubasta);
                            if($resp==true)
                            {
                                
                                $valorCambiar= $valorPuja+$subasta->__getPrecioPuja();
                                $resp= $subasta->aumentarPujaActual($valorCambiar, $idSubasta); 
                                if($resp==false){
                                    
                                    return 2;
                                }else{echo ('se a efectuado la puja correctamente');
                                    return 1;
                                }
                            }else{
                                return 1;
                            }
                        }
                }
            }    
            
        }
        
        
        
    }
    public function mostrarPujaActual($idObra){
        $subasta = new subasta();
        $resp= $subasta->validaAsociacionObra($idObra);
        if($resp==false){
            echo "No podimos cargar la puja actual";
        }else{
            echo "$".$resp->__getPrecioPuja();
        }
    }
}
$ajax= $_POST['parametros'];

if($ajax==1){
    $ctrl= new controllerPuja();
    $idUser=$_POST["idUser"];
    $idObra=$_POST["idObra"];
    $valorPuja= $_POST["valorPuja"];
    $resp=$ctrl->comprobarSiPujoONo($idUser, $idObra, $valorPuja);
    if ($resp== 0) {
        $_SESSION['idCompra']= $idObra;
        $_SESSION['valorPuja']= $valorPuja;
    }
    echo  $resp;
}elseif ($ajax== 2) {
    $ctrl= new controllerPuja();
    $idObra= $_POST["idObra"];
    echo $ctrl->mostrarPujaActual($idObra);
}



?>