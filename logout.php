<?php
    /*En esta página, iniciamos sesión y la destruimos, para que quede libre la variable $_SESSION["dni"] y se pueda iniciar 
    sesión con diferentes usuarios.
    Y, por último, nos redirige directamente a la página de login de nuevo.*/
    session_start();

    session_destroy();

    header('Location:login.php');
?>