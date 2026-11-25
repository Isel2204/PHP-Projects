<?php
session_start();
require 'includes/conexion.php';

// Solo aceptar envíos del formulario
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

// Valores del formulario
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

// Buscar al usuario SOLO por su nombre de usuario (consulta preparada)
$stmt = $conection->prepare(
    "SELECT id_usuario, password FROM usuarios WHERE username = ? AND activo = 1"
);
$stmt->bind_param("s", $username);
$stmt->execute();
$u = $stmt->get_result()->fetch_assoc();

// Comparar la contraseña escrita con el hash guardado
if ($u && password_verify($password, $u["password"])) {
    session_regenerate_id(true);
    $_SESSION["usuario_id"] = $u["id_usuario"];
    header("Location: modulos.php");
    exit();
}

// Credenciales incorrectas: volver al login con un aviso
header("Location: index.php?error=1");
exit();