<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{asset('../resources/css/reset.css')}}>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{asset('../resources/css/login.css')}}>
    <link rel="stylesheet" href={{asset('../resources/css/app.css')}}>
    <title>Login Usuario</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <img class="icon" src={{asset('../resources/img/logo.svg')}} alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>

        <div class="main_container">
            <h4 class="main_text">Ingresa tus</h4>
            <h4 class="main_text">credenciales</h4>
        </div>

        <form method="POST" action={{route('cliente.auth')}}>
            @csrf
            @method('POST')
            <div class="form_container">
                <label class="form_label" for="correo">Correo electronico</label>
                <input class="form_input" type="text" name="correo">
                <label class="form_label" for="contrasena">Contraseña</label>
                <input class="form_input" type="text" name="contrasena">
            </div>
            <div class="button_container">
                <button class="form_button_success">Iniciar sesion</button>
                <button class="form_button_back">Volver</button>
            </div>
        </form>
        <div class="description_container">
            <p class="description_text">¿No tienes una cuenta?</p>
            <a href=""><b>Registrate</b></a>
        </div>
        <div class="final_container">
        </div>
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src={{asset('../resources/img/social.svg')}} alt="">
            </div>
        </footer>
    </body>
</html>