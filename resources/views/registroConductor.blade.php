<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../resources/css/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/login.css">
    <link rel="stylesheet" href="../resources/css/app.css">
    <title>Registro Cliente</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <img class="icon" src="../resources/img/logo.svg" alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>

        <div class="main_container">
            <h4 class="main_text">Ingresa tus</h4>
            <h4 class="main_text">datos personales</h4>
        </div>

        <form action="">
            <div class="form_container">
                <label class="form_label" for="nombre">Nombre</label>
                <input class="form_input" type="text" name="nombre">
                <label class="form_label" for="nombre">Apellido</label>
                <input class="form_input" type="text" name="apellido">
                <label class="form_label" for="correo">Correo electronico</label>
                <input class="form_input" type="email" name="correo">
                <label class="form_label" for="contrasena">Contraseña</label>
                <input class="form_input" type="password" name="contrasena">
                <label class="form_label" for="telefono">Telefono</label>
                <input class="form_input" type="tel" name="telefono">
                <label class="form_label" for="fechaNacimiento">Fecha de nacimiento</label>
                <input class="form_input" type="date" name="fechaNacimiento">
            </div>
            <div class="button_container">
                <button class="form_button_success">Registrarse</button>
                <button class="form_button_back">Volver</button>
            </div>
        </form>
        <div class="description_container">
            <p class="description_text">¿Ya tienes una cuenta?</p>
            <a href=""><b>Inicia Sesion</b></a>
        </div>
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src="../resources/img/social.svg" alt="">
            </div>
        </footer>
    </body>
</html>