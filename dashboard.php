<?php
	session_start();
	if (!isset($_SESSION['login']))
		header("location: index.php");	
?>
<html>
<head>
	<title>Sistema de Pruebas UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
	<link href="css/cmce-styles.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
	<div class="container-fluid">
    	<a class="navbar-brand"><b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?></a> 
		<a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
  </div>
</nav>
<center>
	<br><br><br><br>
		

	<form action="dashboard.php" method="GET">
	<div class="formpanel" id="f1">
		<b>Buscar producto por precio mayor a:</b> <input type="text" name="pre" size="4">
		<button class="btn btn-primary" type="submit">Buscar</button>
	</div>
	</form>
	
	<br><br>
		<hr>
	<br><br>

	<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  		Nuevo Producto
	</button>

	<br><br>
<?php

	include('conexion.php');
	$con = conectaDB();
if(isset($_GET['pre'])==true) {
    $sql = "select idPro, Nombre, Precio, Existencia from tb_productos where Precio > " . $_GET['pre'];
} else {
    $sql = "select idPro, Nombre, Precio, Existencia from tb_productos";
}

echo "<table class='table' style='width:570;'>";
echo "<thead class='table-dark'>";
echo "<th>Nombre</th>";
echo "<th>Precio</th>";
echo "<th>Existencia</th>";
echo "<th></th>";
echo "</thead>";
echo "<tbody>";

$resultado = mysqli_query($con, $sql);  
while($fila = mysqli_fetch_row($resultado)) {
    echo "<tr>";
    echo "<td>" . $fila[1] . "</td>";
    echo "<td>" . $fila[2] . "</td>";
    echo "<td>" . $fila[3] . "</td>";
    echo "<td>
            <a href='#' class='modificar' 
                data-id='" . $fila[0] . "' 
                data-nombre='" . $fila[1] . "' 
                data-precio='" . $fila[2] . "' 
                data-existencia='" . $fila[3] . "'>
                <img src='iconomodificar.png' width='30' height='30'>
            </a>
          </td>";
	echo "<td><a href='#' class='eliminar' data-nombre='" . $fila[1] . "'><img src='iconoeliminar.png' width='30' heigth='30'></a></td>";
    echo "</tr>";
}
echo "</tbody> </table>";

?>			
<br><br>
<!-- Modal Ventada de Nuevo Producto  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            	<div class="modal-body">
                    <div class="mb-3 mt-3">
                        <label for="nomPro" class="form-label">Nombre del producto:</label>
                        <input type="text" class="form-control" id="nomPro" name="nomPro" required style="background-color: #F0F8FF; width: 90%;">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="precioPro" class="form-label">Precio:</label>
                        <input type="number" class="form-control" id="precioPro" name="precioPro" step="0.01" required style="background-color: #F0F8FF; width: 90%;">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="existenciaPro" class="form-label">Existencia:</label>
                        <input type="number" class="form-control" id="existenciaPro" name="existenciaPro" required style="background-color: #F0F8FF; width: 90%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="gSalir" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="guardar" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal para modificar el producto -->
<div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalModificarLabel">Modificar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formModificarProducto">
          <input type="hidden" id="idProducto" name="idProducto">
          <div class="mb-3">
            <label for="nombreProducto" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
          </div>
          <div class="mb-3">
            <label for="precioProducto" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precioProducto" name="precioProducto" required>
          </div>
          <div class="mb-3">
            <label for="existenciaProducto" class="form-label">Existencia</label>
            <input type="number" class="form-control" id="existenciaProducto" name="existenciaProducto" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardarCambiosProducto">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and necessary dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>






</center>

    <!-- Footer -->
    <footer class="footer bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white" ><b> UC: Desarrollo de aplicaciones web y móviles   [ Juan Luis Gonzalez Villalobos Dominguez y Elda Berenice Galvez Fierros ] </b></p>
      </div>
    </footer>
	<script src="js/registrar.js"></script>
	<script src="js/eliminar.js"></script>
	<script src="js/actualizar.js"></script>
	
</body>
</html>