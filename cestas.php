<?php     // Recuperamos la información de la sesión
     session_start();
     // Y comprobamos que el usuario se haya autentificado
     if (!isset($_SESSION['usuario'])) {
         die("Error - debe <a href='login.php'>identificarse</a>.<br />");     } ?>

    <head>   
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">   
        <title>Ejemplo Unidad 5: Cesta de la Compra</title>   
        <link href="scr/conf/tienda.css" rel="stylesheet" type="text/css"> 
    </head> 
 
<body class="pagcesta"> 
 
<div id="contenedor">   
    <div id="encabezado">     
        <h1>Cesta de la compra</h1>   
    </div>   <div id="productos"> <?php     
    $total = 0;    
    if(isset($_SESSION['cesta'])){
        foreach($_SESSION['cesta'] as $codigo => $producto) {
            echo "<p><span class='cantidad' style='color:#437cb4;font-weight:bold'>${producto['cantidad']}</span> x <span class='codigo'>$codigo</span>";
            echo "<span class='nombre'>${producto['nombre']}</span>";
            echo "<span class='precio'>${producto['precio']}</span></p>";

            $total += $producto['precio']*$producto['cantidad'];
        } 
        }?>
        <hr />
        <p><span class='pagar'>Precio total: <?php print $total; ?> €</span></p>
        <button onclick="javascript: genera()" name="genera">Pagar</button>
        <button onclick="javascript: volver()" name="genera">Volver</button>
    </div>
    <br class="divisor" />
    <div id="pie">
        <form action='logoff.php' method='post'>
        <input type='submit' name='desconectar' style="margin-top:1%" value='Desconectar <?php echo $_SESSION['usuario']; ?>' />
        </form>
    </div>
</div>

<script src="scr/js/pagar.js"></script>
