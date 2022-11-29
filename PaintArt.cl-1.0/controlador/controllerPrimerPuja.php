<?php
session_start();
include_once '../modelo/obra.php';
include_once '../modelo/imagen.php';
include_once '../modelo/arraylist.php';
include_once '../modelo/artista.php';
include_once '../modelo/compra.php';
include_once '../modelo/direccion.php';
include_once '../modelo/registroPujadores.php';
include_once '../modelo/subastas.php';
include_once '../modelo/tarjetaUser.php';
include_once '../modelo/usuarioRegistrado.php';

if(empty($_SESSION['online'])){
    header("Location: ../Vista/iniciarSesion.php");
}else{
    $idUser = $_SESSION['online'];

    $user= new usuarioRegistrado();
    $resp= $user->buscarUusuarioId($idUser);
    if($resp==false){
        header("Location: ../Vista/iniciarSesion.php");
    }else{
        $user= $resp;
        if($user->getPermisos()==5){
            $_SESSION['informacion']="No puede acceder a su perfil por incumplir normas comunitarias, muchas gracias";
            header("Location: ../Vista/Index.php");
        }else{
            $tarjeta = new tarjetaUser();
            $resp= $tarjeta->buscarTarjetaUserId($idUser);
            $estadoTarjet=0;
            if($resp==false){
                if(empty($_POST["numTarjeta"])||empty($_POST["mesC"])|| empty($_POST["Año"])|| empty($_POST["codigoV"]|| empty($_POST["tipoTarjeta"])))
                {
                    echo 'Error, faltan campos por completar'; 
                }else{
                    $numTarjet= $_POST["numTarjeta"];
                    $mesC= $_POST["mesC"];
                    $año= $_POST["Año"];
                    $codigoV= $_POST["codigoV"];
                    $tipoTarjeta= $_POST["tipoTarjeta"];
                    $estadoTarjet= 1;
                    $resp= $tarjeta->agregarTarjeta($numTarjet,$mesC, $año, $codigoV, $idUser, $tipoTarjeta);
                    if($resp==false){
                        $resp=false;
                    }
                }
            }
            
            if($resp==false){
                echo 'No se pudo agregar la tarjeta';
            }else{
                $idUser= $_SESSION['online'];
                //$metodo=$_POST['metodoPago'];
                $region=$_POST['region'];
                $ciudad=$_POST['Ciudad'];
                $comuna=$_POST['comuna'];
                $calle=$_POST['calle'];
                $numeracion=$_POST['numeracion'];
                $tipoHogar=$_POST['tipoHogar'];
                if($tipoHogar=='casa'){
                    $tipoHogar=1;
                }elseif ($tipoHogar=='departamento') {
                    $tipoHogar=2;    
                }
    
                date_default_timezone_set("America/Santiago");
                $fecha= date("Y-m-d");
    
                $idObra=  $_POST['idCompra'];;
                $ob =new obra($idObra,null, null,null, null,null, null,null, null);
                $obra= $ob->buscarObraId($idObra);
                
                if($obra== false){
                    $_SESSION['errorCompra']= 'hemos tenido problemas al buscar su obra';
                    header("Location: ../Vista/Subasta.php");
                }else{
                    $direccion= new direccion(null,$region,$ciudad, $comuna, $calle,$tipoHogar,$numeracion);
                    $resp= $direccion->crearDireccion($direccion);
                    if($resp== false){
                        $_SESSION['errorCompra']= 'hemos tenido problemas introducir su direccion';
                        header("Location: ../Vista/Subasta.php?id='.$ob->getIdObra().'");
                    
                    }else{
                        $direccion=$direccion->ultimaDireccion();
                        if($direccion==false){
                        $_SESSION['errorCompra']= 'hemos tenido problemas busar la direccion';
                        header("Location: ../Vista/Subasta.php");
                        }else{
                            //$compra= new compra(null, $fecha, $metodo,$idObra,$idUser,$obra->getIdArtista(), $direccion->getIdDireccion());
                            //$stock=$obra->getStock();
                            
                            //$resp= $compra->crearCompra($compra);
                           // unset($_SESSION['idCompra']);
                            //if ($resp==false) {
                               // $_SESSION['errorCompra']= 'hemos tenido problemas procesar su compra';
                                //header("Location: ../Vista/Subasta.php?id='.$ob->getIdObra().'");
                            
                            //}else{
                                //$_SESSION['errorCompra']= 'compra exitosa';
                                //header("Location: ../Vista/Index.php");   
                                $registro= new registroPujadores();
                                
                                $subasta= new subasta();
                                $resp= $subasta->validaAsociacionObra($ob->getIdObra());
                                if($resp==false){
                                    echo 'no se ha podido buscar la subasta';
                                }else{
                                    $registro->__setDireccion_IdDireccion($direccion->getIdDireccion());
                                    $valorPuja=$_SESSION['valorPuja'];
                                    $valor = $valorPuja+$resp->__getPrecioPuja();
                                    $registro->__setValor($valor);
                                    $registro->__setSubasta($resp->__getidSubasta());
                                    $idSub=$resp->__getidSubasta();
                                    $subasta->__setPrecioPuja($valor);
                                    $registro->__setIdUser($idUser);
                                    $resp= $registro->agregarRegistro($registro);
                                    
                                    if($resp== false){
                                        echo 'no se ha podido agregar registro';
                                        echo $registro->mostrarRegistro();
                                    }else{
                                        
                                        $resp=$subasta->aumentarPujaActual($valor, $idSub);
                                        
                                        if($resp==false){
                                            echo 'Opps problemas';
                                        }else{
                                            
                                            
                                                //echo 'no se ha podido modificar la puja del usuario';
                                            
                                                header("Location: ../Vista/subasta.php?id=".$obra->getIdObra()."");
                                            
                                           
                                        }
                                        
                                    }
                                }
    
    
                            }
                        }
                    }
                        
            }
        }
    } 
    
}





?>