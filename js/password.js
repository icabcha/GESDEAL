function togglePassword() {
    //Obtenemos la contraseña a partir del id
    var contraseña = document.getElementById("pass");

    //Obtenemos el elemento correspondiente a la imagen "Mostrar contraseña"
    var showImagen = document.querySelector(".show-pass");

    //Obtenemos el elemento correspondiente a la imagen "Ocultar contraseña"
    var hideImagen = document.querySelector(".hide-pass");

    //Verificmos si el tipo del campo de contraseña es "password"
    if (contraseña.type === "password") {
        //Si es "password", cambiamos el tipo a "text" para mostrar la contraseña
        contraseña.type = "text";
        //Ocultamos la imagen "Mostrar contraseña" y mostramos la imagen "Ocultar contraseña"
        showImagen.style.display = "none";
        hideImagen.style.display = "inline";
    } else {
        //Si el tipo no es "password", lo convertimos a "password" para ocultar la contraseña
        contraseña.type = "password";
        //Mostramos la imagen "Mostrar contraseña" y ocultamos la imagen "Ocultar contraseña"
        showImagen.style.display = "inline";
        hideImagen.style.display = "none";
    }
}
