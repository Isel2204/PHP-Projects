<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ingreso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/Login.css">
</head>    
<body>
    <div class="contenedor">
        <div class="login-container">
            <div class="login-box">
                <img class="avatar" src="assets/img/logo.png">
                <h1>SeiPos</h1>
                <form action="Validar_login.php" method="POST">
                    <div>
                        <label for="username">Usuario:</label>
                        <input type="text" id="username" name="username" placeholder="Nombre de usuario">
                    </div>
                    <div>
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" placeholder="Contraseña">
                    </div>
                        <button type="submit" value="btn_login"> Ingresar </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
