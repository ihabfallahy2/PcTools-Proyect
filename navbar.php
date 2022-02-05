<?php
// Recuperamos la información de la sesión     
error_reporting(E_ALL);
session_start();
include "scr/php/conectarbd.php";
include "scr/conf/config.inc";
$error = "";


if (isset($_POST['enviar'])) {
  $usuario = $_POST['usuario'];
  $password = md5($_POST['password']);
  if (empty($usuario) || empty($password)) {
    $error = "Debes introducir un nombre de usuario y una contraseña";
  } else {
    // Comprobamos las credenciales con la base de datos             
    // Conectamos a la base de datos             


    /* aqui vendria incluida las operaciones de bloqueo de un usuario si se equivocara mas de lo debido. */
    /* for further development of the secutrity functionality the team decided to pospone the post of the next versin of this app to 2 months.*/
    $estado = checkUser($usuario, $password);

    if (isset($_SESSION['cont'][$usuario])) {
      if ($_SESSION['cont'][$usuario] >= 2) {
        bloquear($usuario);
        unset($_SESSION['cont'][$usuario]);
        AvisoBloqueo($usuario);
      }
    }

    //funcion de Administrador esta funcional desde 14/12/2021 10:24
    
    if ($estado == ACTIVO && $usuario == "Admin") {
      $_SESSION['usuario'] = $usuario;
      header("Location: crud.php");
    } else {
      
      switch ($estado) {
        
        //case admin 
        case ACTIVO:
          // session_start();
          $_SESSION['usuario'] = $usuario;
          // header("Location: productos.php");
          
          case BLOQUEADO:
            $error = "El usuario está bloqueado, reestablece la contraseña";
            break;
            
            case PENDIENTE:
              $error = "Todavía no has activado la cuenta, revisa tu correo";
              break;
              
              case NOEXISTE:
                if (isset($_SESSION['cont'][$usuario])) {
                  $_SESSION['cont'][$usuario]++;
                } else {
            $_SESSION['cont'][$usuario] = 1;
          }
          break;
        }
      }
    }
  }

//funcion de Administrador esta funcional desde 14/12/2021 10:24

$error = (isset($_REQUEST['error'])) ? $_REQUEST['error'] : "";

if (isset($_REQUEST['Username']) && isset($_REQUEST['Password'])) {
    
    $nombre = $_REQUEST['Username'];
    $pass = md5($_REQUEST['Password']);
    $email = $_REQUEST['Email'];
    $token = md5(time() . $nombre);
    
    // echo "$nombre $pass $email $token";
    
    $reg = addUser($nombre, $pass, $email, $token);
    
    if ($reg > 0) {
      
      if (!enviaCorreoValidacion($email, $token)) {
        
        $error = "No se ha podido enviar el correo";

      }

    }

}

//comprobacion de eliminacion de producto en cesta

if (isset($_REQUEST['eliminar'])) {
  //eliminar producto
  echo "alert('hola')";
}

//comprobacion de eliminacion de producto en cesta

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PcTools</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- script -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- css -->
  <link rel="stylesheet" href="scr/conf/style.css">
  <link rel="stylesheet" href="scr/conf/tienda.css">
  <style>
    body {
      font-family: 'Varela Round', sans-serif;
    }

    .form-control {
      box-shadow: none;
      font-weight: normal;
      font-size: 13px;
    }

    .navbar {
      background: #fff;
      padding-left: 16px;
      padding-right: 16px;
      border-bottom: 1px solid #dfe3e8;
      border-radius: 0;
    }

    .nav-link img {
      border-radius: 50%;
      width: 36px;
      height: 36px;
      margin: -8px 0;
      float: left;
      margin-right: 10px;
    }

    .navbar .navbar-brand {
      padding-left: 0;
      font-size: 20px;
      padding-right: 50px;
    }

    .navbar .navbar-brand b {
      color: #33cabb;
    }

    .navbar .form-inline {
      display: inline-block;
    }

    .navbar a {
      color: #888;
      font-size: 15px;
    }

    .search-box {
      position: relative;
    }

    .search-box input {
      padding-right: 35px;
      border-color: #dfe3e8;
      border-radius: 4px !important;
      box-shadow: none
    }

    .search-box .input-group-text {
      min-width: 35px;
      border: none;
      background: transparent;
      position: absolute;
      right: 0;
      z-index: 9;
      padding: 7px;
      height: 100%;
    }

    .search-box i {
      color: #a0a5b1;
      font-size: 19px;
    }

    .navbar .sign-up-btn {
      min-width: 110px;
      max-height: 36px;
    }

    .navbar .dropdown-menu {
      color: #999;
      font-weight: normal;
      border-radius: 1px;
      border-color: #e5e5e5;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
    }

    .navbar a,
    .navbar a:active {
      color: #888;
      padding: 8px 20px;
      background: transparent;
      line-height: normal;
    }

    .navbar .navbar-form {
      border: none;
    }

    .navbar .action-form {
      width: 280px;
      padding: 20px;
      left: auto;
      right: 0;
      font-size: 14px;
    }

    .navbar .action-form a {
      color: #33cabb;
      padding: 0 !important;
      font-size: 14px;
    }

    .navbar .action-form .hint-text {
      text-align: center;
      margin-bottom: 15px;
      font-size: 13px;
    }

    .navbar .btn-primary,
    .navbar .btn-primary:active {
      color: #fff;
      background: #33cabb !important;
      border: none;
    }

    .navbar .btn-primary:hover,
    .navbar .btn-primary:focus {
      color: #fff;
      background: #31bfb1 !important;
    }

    .navbar .social-btn .btn,
    .navbar .social-btn .btn:hover {
      color: #fff;
      margin: 0;
      padding: 0 !important;
      font-size: 13px;
      border: none;
      transition: all 0.4s;
      text-align: center;
      line-height: 34px;
      width: 47%;
      text-decoration: none;
    }

    .navbar .social-btn .facebook-btn {
      background: #507cc0;
    }

    .navbar .social-btn .facebook-btn:hover {
      background: #4676bd;
    }

    .navbar .social-btn .twitter-btn {
      background: #64ccf1;
    }

    .navbar .social-btn .twitter-btn:hover {
      background: #4ec7ef;
    }

    .navbar .social-btn .btn i {
      margin-right: 5px;
      font-size: 16px;
      position: relative;
      top: 2px;
    }

    .or-seperator {
      margin-top: 32px;
      text-align: center;
      border-top: 1px solid #e0e0e0;
    }

    .or-seperator b {
      color: #666;
      padding: 0 8px;
      width: 30px;
      height: 30px;
      font-size: 13px;
      text-align: center;
      line-height: 26px;
      background: #fff;
      display: inline-block;
      border: 1px solid #e0e0e0;
      border-radius: 50%;
      position: relative;
      top: -15px;
      z-index: 1;
    }

    .navbar .action-buttons .dropdown-toggle::after {
      display: none;
    }

    .form-check-label input {
      position: relative;
      top: 1px;
    }

    @media (min-width: 1200px) {
      .form-inline .input-group {
        width: 300px;
        margin-left: 30px;
      }
    }

    @media (max-width: 768px) {
      .navbar .dropdown-menu.action-form {
        width: 100%;
        padding: 10px 15px;
        background: transparent;
        border: none;
      }

      .navbar .form-inline {
        display: block;
      }

      .navbar .input-group {
        width: 100%;
      }
    }
  </style>
  <script>
    // Prevent dropdown menu from closing when click inside the form
    $(document).on("click", ".action-buttons .dropdown-menu", function(e) {
      e.stopPropagation();
    });
  </script>
</head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- <a href="#" class="navbar-brand">Brand<b>Name</b></a> -->
    <!-- <a href="#" class="navbar-brand"><img src="./scr/img/LogoSample1.jpg" style="background-color: #F4F4F7;background-image: url('wa.jpg');background-repeat: no-repeat;background-position: right bottom;background-size: 200px 280px;mix-blend-mode: multiply;" align="left"></a> -->
    <a href="#" class="navbar-brand"><img src="./scr/img/LogoSample3.jpg"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
      <div class="navbar-nav ml-auto action-buttons">

        <div class="nav-item dropdown">
          <a href="#" data-toggle="dropdown" class="nav-item nav-link dropdown-toggle">Cesta</a>
          <div class="dropdown-menu">
            <div id="encabezado">
              <?php
              // Comprobamos si se ha enviado el formulario de vaciar la cesta     
              if (isset($_POST['vaciar'])) {
                unset($_SESSION['cesta']);
              }

              if (isset($_POST['enviar-cesta'])) {

                $producto['nombre'] = $_POST['nombre'];
                $producto['precio'] = $_POST['precio'];
                $producto['cantidad'] = $_POST['numero'];
                $_SESSION['cesta'][$_POST['producto']] = $producto;
              }

              // Si la cesta está vacía, mostramos un mensaje    
              $cesta_vacia = true;
              if (isset($_SESSION['cesta'])) {

                if (count($_SESSION['cesta']) == 0) {
                  print "<p>Cesta vacía</p>";
                }        // Si no está vacía, mostrar su contenido
                else {
                  echo "<form action='index.php' method='post'>";
                  foreach ($_SESSION['cesta'] as $codigo => $producto) {
                    // echo "<div id='añadido'> <input type='button' name='eliminar' value='x'> <input type='text' style='border-width:0px;border:none;' value='" . $producto['cantidad'] . " " . $producto["nombre"] . "' disabled='true'> </div>";
              ?>
                    <div id='añadido'>
                      <input type='text' style='border-width:0px;border:none;' value='<?php echo $producto['cantidad'] . " " . $producto['nombre']; ?>' disabled='true'>
                      <input type="hidden" name="nombre">
                    </div>
              <?php
                  }
                  echo "</form>";
                  $cesta_vacia = false;
                }
              }

              ?>
              <div class="text-center">

                <form id='vaciar' action='index.php' method='post'>
                  <input type='submit' style="width:100px;margin-bottom:0.5%" name='vaciar' value='Vaciar cesta ' <?php if ($cesta_vacia) {
                                                                                                                    print "disabled='true'";
                                                                                                                  } ?> />
                </form>

                <form id='comprar' action='cestas.php' method='post'>
                  <input type='submit' style="width:100px" name='comprar' value='Comprar' <?php if ($cesta_vacia) {
                                                                                            print "disabled='true'";
                                                                                          } ?> />
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- aqui empieza el login -->

        <div class="nav-item dropdown">
          <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle mr-4"><?php if (isset($_SESSION['usuario'])) {
                                                                                      echo $_SESSION['usuario'];
                                                                                    } else {
                                                                                      echo "Login";
                                                                                    } ?>
            <div class="dropdown-menu action-form">
              <?php
              if (isset($_SESSION['usuario'])) {
              ?>
                <form action='index.php' method='post'>
                  <p class='hint-text text-dark'>Sign in with your social media account</p>
                  <div class='form-group social-btn clearfix'>
                    <a href='#' class='btn btn-secondary facebook-btn float-left'><i class='fa fa-facebook'></i> Facebook</a>
                    <a href='#' class='btn btn-secondary twitter-btn float-right'><i class='fa fa-twitter'></i> Twitter</a>
                  </div>
                  <div class='or-seperator'><b>or</b></div>
                </form>
                <div id='user'>
                  <div id='boton'>
                    <form action='logoff.php' method='post'>
                      <input type='submit' class='btn btn-primary btn-block' name='desconectar' style='margin-top:1.5%;width:239px' value='Desconectar Usuario' />
                    </form>
                  </div>
                  </div>
                  <?php
                } else {
                  ?>
                    <form action="index.php" method="post">
                      <p class="hint-text">Sign in with your social media account</p>
                      <div class="form-group social-btn clearfix">
                        <a href="#" class="btn btn-secondary facebook-btn float-left"><i class="fa fa-facebook"></i> Facebook</a>
                        <a href="#" class="btn btn-secondary twitter-btn float-right"><i class="fa fa-twitter"></i> Twitter</a>
                      </div>
                      <div class="or-seperator"><b>or</b></div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="usuario" placeholder="Username" required="required">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                      </div>
                      <input type="submit" class="btn btn-primary btn-block" name="enviar" value="Login">
                      <div class="text-center mt-2">
                        <a href="#">Forgot Your password?</a>
                      </div>
                    </form>
                  <?php
                }
                  ?>
                  </div>
          </a>
        </div>

        <div class="nav-item dropdown">
          <a href="index.php" data-toggle="dropdown" class="btn btn-primary dropdown-toggle sign-up-btn">Sign up</a>
          <div class="dropdown-menu action-form">
            <!-- <form action="/examples/actions/confirmation.php" method="post"> -->
            <form action="index.php" method="post">
              <p class="hint-text">Fill in this form to create your account!</p>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="Username" required="required">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="Password" required="required">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirm Password" name="Confirm-Password" required="required">
              </div>
              <div class="form-group">
                        <input type="email" class="form-control" name="Email" placeholder="Email" name="Email" required="required">
                    </div>
              <div class="form-group">
                <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms &amp; Conditions</a></label>
              </div>
              <input type="submit" class="btn btn-primary btn-block" value="Sign up">
            </form>
          </div>
        </div>

      </div>
    </div>
  </nav>
</body>

</html>