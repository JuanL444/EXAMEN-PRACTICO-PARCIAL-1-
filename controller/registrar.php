<?php
$nomPro = $_POST['nomPro'];
$precioPro = $_POST['precioPro'];
$existenciaPro = $_POST['existenciaPro'];

include('../conexion.php');
$con = conectaDB();
$sql = "INSERT INTO tb_productos (Nombre, Precio, Existencia) VALUES ('".$nomPro."', ".$precioPro.", ".$existenciaPro.");";

mysqli_query($con,$sql);  

if(mysqli_affected_rows($con)>0){
	echo "1";
}
else{
	echo "2";  
} 
?>