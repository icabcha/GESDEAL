// Esperamos a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function() {
    var filasPorPagina = 8; // Número de filas por página
    var paginaInicial = 1; // Página inicial
    var tabla = document.getElementById("tabla").getElementsByTagName("tbody")[0]; // Obtener el cuerpo de la tabla
    var paginacionDiv = document.getElementById("paginacion"); // Elemento de paginación

    //Obtener los datos del elemento con el atributo data-*
    var datos = JSON.parse(document.getElementById("datos").getAttribute("data"));

    // Función para mostrar la tabla con los datos de la página especificada
    function mostrarTabla(pagina) {
        // Limpiamos el contenido actual de la tabla
        tabla.innerHTML = ""; 
        // Índice de inicio para los datos de la página
        var inicio = (pagina - 1) * filasPorPagina; 
        // Índice final para los datos de la página
        var final = inicio + filasPorPagina;
        // Obtenemos los elementos para la página actual
        var itemsPaginados = datos.slice(inicio, final);

        // Agregamos filas a la tabla con los datos paginados
        itemsPaginados.forEach(item => {
            // Insertamos una nueva fila en la tabla
            var fila = tabla.insertRow();
            Object.values(item).forEach(texto => {
                // Insertamos una nueva celda en la fila
                var celda = fila.insertCell();
                celda.textContent = texto;
            });
        });
    }

    // Función para configurar la paginación
    function paginar() {
        // Limpiamos el contenido actual de la paginación
        paginacionDiv.innerHTML = ""; 
        // Calculamos el número total de páginas
        var contadorPags = Math.ceil(datos.length / filasPorPagina); 

        // Creamos un botón para cada página
        for (var i = 1; i <= contadorPags; i++) {
            // Establecemos el texto de cada botón con el número de la página
            var boton = document.createElement("button");
            boton.textContent = i;
            // Agregamos la clase "paginacion-boton" al botón
            boton.className = "paginacion-boton"; 
            // Agregamos un evento al botón para cambiar a la página correspondiente cuando se haga clic
            boton.addEventListener("click", function() {
                // Actualizamos la página actual con el número del botón
                paginaInicial = parseInt(this.textContent);
                // Mostramos los datos de la página seleccionada
                mostrarTabla(paginaInicial);
            });
            // Agregamos el botón al div de paginación
            paginacionDiv.appendChild(boton); 
        }
    }

    // Mostramos la tabla con la primera página de datos
    mostrarTabla(paginaInicial); 
    // Configuramos la paginación
    paginar();
});
