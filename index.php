<?php include "navbar.php"?>

<div id="contenedor">
  <div id="error"><?php echo "<p>" . (isset($error)) ? $error : "" . "</p>"; ?></div>
  <div class="productos">
    <?php
    foreach (select() as $row) { ?>
      <div class="col-sm-3">
        <div class="card border-0">
          <?php
          echo "<p><form id='${row['cod']}' action='index.php' method='post'>";
          echo "<input type='hidden' name='producto' value='" . $row['cod'] . "'/>";
          echo "<input type='hidden' name='nombre' value='" . $row['nombre'] . "'/>";
          echo "<input type='hidden' name='precio' value='" . $row['precio'] . "'/>";
          ?>
          <a href="scr/php/detalles-producto/<?php echo $row['nombre'] ?>.php?nombre=<?php echo $row['nombre'] ?>"><img src="./scr/php/productos/<?php echo $row['nombre'] ?>.jpg" class="card-img-top"></a>
          
          
          <div class="card-body">
            <input type='text' style='border-width:0px;border:none;' value='<?php echo $row['nombre']; ?>' disabled='true'>
            <!-- <p class="overflow-ellipsis"></p> -->
            <p class="card-text"><?php echo $row['precio'] . " $  "; ?></p>
            <p class="card-text-center">
              <?php
              if (isset($_SESSION['usuario'])) {
                print "<td><input type='submit' class='card-link' name='enviar-cesta' value='Añadir' /><input type='number' class='card-link' name='numero' id='numero' value='1' min='1' max='100' step='1' style='width:80px'></td>";
              }
              ?>
            </p>
          </div>
        </div>
      </div>
    <?php
      echo "</form>";
      echo "</p>";
    }
    ?>
  </div>
</div>

<?php include "footer.php";?>
</body>
</html>