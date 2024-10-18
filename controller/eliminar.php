<?php
include '../conexion.php';
$conn = conectaDB();

$nombreProducto = $_GET['nombreProducto'];

$sql = "DELETE FROM tb_productos WHERE Nombre='$nombreProducto'";

if ($conn->query($sql) === TRUE) {
    echo "1"; 

} else {
    echo "Error: " . $conn->error;
}

$conn->close();

exit();
?>