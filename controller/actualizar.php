<?php
include('../conexion.php');
$con = conectaDB();

$idProducto = $_POST['idProducto'];
$nombreProducto = $_POST['nombreProducto'];
$precioProducto = $_POST['precioProducto'];
$existenciaProducto = $_POST['existenciaProducto'];

// Actualizar el producto en la base de datos
$sql = "UPDATE tb_productos SET Nombre='$nombreProducto', Precio=$precioProducto, Existencia=$existenciaProducto WHERE idPro=$idProducto";
$result = mysqli_query($con, $sql);

if (mysqli_affected_rows($con) > 0) {
    echo "1"; // Producto actualizado correctamente
} else {
    echo "2"; // Error al actualizar el producto
}
?>
