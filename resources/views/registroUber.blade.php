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
    <title>Registro Uber</title>
</head>

    <body>
        <header>
            <div class="header_container">
                <img class="icon" src="../resources/img/logo.svg" alt="">
                <h3 class="title">LightDriving</h3>
            </div>
        </header>

        <div class="main_container">
            <h4 class="main_text">Ingresa los</h4>
            <h4 class="main_text">datos de tu vehiculo</h4>
        </div>

        <form action="">
            <div class="form_container">
                <label class="form_label" for="marca">Marca</label>
                <input class="form_input" type="text" name="marca">
                <label class="form_label" for="color">Color</label>
                <input class="form_input" type="text" name="color">
                <label class="form_label" for="anio">Año</label>
                <input class="form_input" type="text" name="anio">
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
        <div class="final_container">
            <img class="form_img" src="../resources/img/auto.jpg" alt="">
        </div>
        <footer>
            <div class="footer_container">
                <h3 class="footer_text">LightDriving</h3>
                <img class="footer_social" src="../resources/img/social.svg" alt="">
            </div>
        </footer>
    </body>
</html>