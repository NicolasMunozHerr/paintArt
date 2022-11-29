<?php 
include_once '../modelo/subastas.php';

class cambiaraSubasta{
    public function __construct($id){
        $subasta= new subasta();
        $resp= $subasta->validaAsociacionObra($id);
        if($resp==false){
            return $resp;
        }else{
            header("Location: ../Vista/subasta.php?id=".$id."");;
        }

    }
}


?>