<?php
session_start();
require 'includes/conexion.php';

// Si no ha iniciado sesión, de vuelta al login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit();
}

// Traer solo los módulos activos de este usuario
$stmt = $conection->prepare("
    SELECT m.nombre, m.ruta, m.icono
    FROM modulos m
    INNER JOIN usuario_modulo um ON um.id_modulo = m.id_modulo
    WHERE um.id_usuario = ? AND um.activo = 1
    ORDER BY m.orden
");
$stmt->bind_param("i", $_SESSION["usuario_id"]);
$stmt->execute();
$modulos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulos | SeiPos</title>
    <link rel="stylesheet" href="assets/css/modulos.css">
</head>
<body>

    <header class="barra-superior">
        <img src="img/logo-horizontal.png" alt="SeiPos" class="logo-esquina">
    </header>

    <main class="modulos">
        <?php if (empty($modulos)): ?>
            <p class="sin-modulos">No tienes módulos asignados. Contacta al administrador.</p>
        <?php else: ?>
            <?php foreach ($modulos as $m): ?>
                <a href="<?= htmlspecialchars($m["ruta"]) ?>" class="modulo">
                <img src="assets/img/iconos/<?= htmlspecialchars($m["icono"]) ?>" alt="" class="icono">
                <span><?= htmlspecialchars($m["nombre"]) ?></span>
                </a>
        <?php endforeach; ?>
        <?php endif; ?>
    </main>

</body>
</html>