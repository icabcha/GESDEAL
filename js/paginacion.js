//Esperamos a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function() {
    var filasPorPagina = 8; 
    var paginaInicial = 1; 
    var tabla = document.getElementById("tabla").getElementsByTagName("tbody")[0];
    var paginacionDiv = document.getElementById("paginacion");

    //Función para mostrar la tabla con los datos de la página especificada
    function mostrarTabla(pagina) {
        //Limpiamos el contenido actual de la tabla
        tabla.innerHTML = ""; 
        //Índice de inicio para los datos de la página
        var inicio = (pagina - 1) * filasPorPagina; 
        //Índice final para los datos de la página
        var final = inicio + filasPorPagina;
        //Obtenemos los artículos para la página actual
        var itemsPaginados = articulos.slice(inicio, final);

        //Agregamos filas a la tabla con los datos paginados
        itemsPaginados.forEach(item => {
            //Insertamos una nueva fila en la tabla
            var fila = tabla.insertRow();
            Object.values(item).forEach(texto => {
                //Insertamos una nueva celda en la fila
                var celda = fila.insertCell();
                celda.textContent = texto;
            });
        });
    }

    //Función para configurar la paginación
    function paginar() {
        //Limpiamos el contenido actual de la paginación
        paginacionDiv.innerHTML = ""; 
        //Calculamos el número total de páginas
        var contadorPags = Math.ceil(articulos.length / filasPorPagina); 

        //Creamos un botón para cada página
        for (var i = 1; i <= contadorPags; i++) {
            //Establecemos el texto de cada botón con el número de la página
            var boton = document.createElement("button");
            boton.textContent = i;
            //Agregamos la clase "paginacion-boton" al botón
            boton.className = "paginacion-boton"; 
            //Agregamos un evento al botón para cambiar a la página correspondiente cuando se haga clic
            boton.addEventListener("click", function() {
                //Actualizamos la página actual con el número del botón
                paginaInicial = parseInt(this.textContent);
                //Mostramos los datos de la página seleccionada
                mostrarTabla(paginaInicial);
            });
            //Agregarmos el botón al div de paginación
            paginacionDiv.appendChild(boton); 
        }
    }

    //Mostramos la tabla con la primera página de datos
    mostrarTabla(paginaInicial); 
    //Configurmos la paginación
    paginar();
});
