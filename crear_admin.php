<?php
require 'includes/conexion.php';

$username = 'admin';
$clave = 'CambiaEstaClave123';

// Evitar crearlo dos veces
$chk = $conection->prepare("SELECT 1 FROM usuarios WHERE username = ?");
$chk->bind_param("s", $username);
$chk->execute();

if ($chk->get_result()->num_rows > 0) {
    exit("El usuario '$username' ya existe.");
}

// Guardar la contraseña como hash, nunca en texto plano
$hash = password_hash($clave, PASSWORD_DEFAULT);

$stmt = $conection->prepare("INSERT INTO usuarios (id_usuario, id_negocio, nombre, apellido, cedula, username, password) VALUES (100000, 100, 'Admin', 'SeiPos', '0000000000', ?, ?)");
$stmt->bind_param("ss", $username, $hash);
$stmt->execute();

// Darle todos los módulos
$conection->query("INSERT INTO usuario_modulo (id_usuario, id_modulo) SELECT 100000, id_modulo FROM modulos");

echo "Usuario '$username' creado correctamente.";