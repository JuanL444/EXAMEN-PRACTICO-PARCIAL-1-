<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include ('../conexion.php'); // Asegúrate de que la ruta sea correcta

// Verificar si se enviaron los datos del formulario
if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    
    // Obtener la conexión de la base de datos
    $conn = conectaDB(); // Asegúrate de que esta función devuelva la conexión correcta

    // Escapar caracteres especiales en las entradas para prevenir inyecciones SQL
    $username = mysqli_real_escape_string($conn, $_POST['loginUsername']);
    $password = mysqli_real_escape_string($conn, $_POST['loginPassword']);

    // Preparar y ejecutar la consulta SQL
    $query = "SELECT * FROM tb_usuarios WHERE NomUser = '$username' AND Passwd = '$password'";
    $result = mysqli_query($conn, $query);

    // Verificar si se encontró un usuario
    if (mysqli_num_rows($result) > 0) {
        // Usuario y contraseña válidos
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['login'] = "true";
        $_SESSION['nomusuario'] = $user['NomUser'];
        
        echo json_encode(array('success' => 1));
    } else {
        // Usuario o contraseña incorrectos
        echo json_encode(array('success' => 0));
    }
} 
?>