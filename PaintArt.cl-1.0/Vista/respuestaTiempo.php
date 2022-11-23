<?php 
include_once '../modelo/subastas.php';
$subasta= new subasta();
$subasta= $subasta->listarUltimaFecha();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $fechaLimite =$subasta->__getFechaLimite();
    echo $fechaLimite;
    $fechaLimite= strtotime($fechaLimite);    
   //echo "<br>fecha de ahora". date(' M d Y H:i:s ',$fechaLimite)." GMT-0300";
   $mostrar = date(' M d Y H:i:s ',$fechaLimite)." GMT-0300";
   echo $mostrar;
   
    ?>

    <div id="clock">
        cargando
    </div>
   
</body>
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
        el.innerHTML=`${t.remainDay}d:${t.remainHours}h:${t.remainMinutes}m:${t.remainSeconds}s`;
        if(t.remainTime<=1){
            clearInterval(timerUpdate);
            el.innerHTML=finalMessage;

        }
    },1000)

}
countdown("<?php echo $mostrar ?> ", 'clock', 'feliz año nuevo');
</script>