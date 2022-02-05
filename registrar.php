<?php
    include "scr/php/conectarbd.php";
    $error=(isset($_REQUEST['error']))?$_REQUEST['error']:"";
    if (isset($_REQUEST['Username']) && isset($_REQUEST['Password'])){
       
        if ($_REQUEST['Password']==$_REQUEST['Confirm-Password']){
            $nombre=$_REQUEST['Username'];
            $pass=md5($_REQUEST['Password']);
            $email=$_REQUEST['Email'];
            $token=md5(time().$nombre);
            //echo "$nombre $pass $email $token";
            $reg=addUser($nombre,$pass,$email,$token);
            if ($reg > 0) {
                if (!enviaCorreoValidacion($email,$token)){
                    $error="No se ha podido enviar el correo";
                }
            }else{
                $error="No se ha  podido insertar el usuario";
            }
        }else{
            $error="Las contraseñas no coinciden";
        }
    }
    echo "<p>".(isset($error))?$error:""."</p>";
?>

<form action="" method="POST">
    <p>Nombre: <input required type="text" name="Username" size=30/></p> 
    <p>Contraseña: <input required type="password" name="Password" size=10/></p> 
    <p>Re-Contraseña: <input required type="password" name="Confirm-Password" size=10/></p> 
    <p>Email: <input required type="email" name="Email" size=30/></p> 
    <input type="submit" value="Registrar"/>
    <input type="reset" value="Borrar"/>
</form>
