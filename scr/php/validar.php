<?php
    require_once "conectarbd.php";
    if(isset($_REQUEST['token'])){
        if (validaUser($_REQUEST['token'])>0){
            echo "validado";
            header("Location: ../../index.php");
        }  else{          
            $error="No se ha podido validar el usuario";
            header("Location:../../../../registrar.php?error=$error");
           
        }
    }
    ?>