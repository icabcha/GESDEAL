//Esperamos a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function() {
    var filasPorPagina = 8; 
    var paginaInicial = 1;
    //Obtenemos el cuerpo de la tabla
    var tabla = document.getElementById("tabla").getElementsByTagName("tbody")[0]; 
    var paginacionDiv = document.getElementById("paginacion");

    //Obtenemos los datos del elemento con el atributo data-*
    var datos = JSON.parse(document.getElementById("datos").getAttribute("data"));

    var datosContainer = document.getElementById("tabla");
    var type = datosContainer.getAttribute("data-type");
    var idField = datosContainer.getAttribute("data-idField");

    //Función para mostrar la tabla con los datos de la página especificada
    function mostrarTabla(pagina) {
        //Limpiamos el contenido actual de la tabla
        tabla.innerHTML = ""; 
        //Índice de inicio para los datos de la página
        var inicio = (pagina - 1) * filasPorPagina; 
        //Índice final para los datos de la página
        var final = inicio + filasPorPagina;
        //Obtenemos los elementos para la página actual
        var itemsPaginados = datos.slice(inicio, final);

        //Agregamos filas a la tabla con los datos paginados
        itemsPaginados.forEach(item => {
            //Insertamos una nueva fila en la tabla
            var fila = tabla.insertRow();
            Object.values(item).forEach(texto => {
                //Insertamos una nueva celda en la fila
                var celda = fila.insertCell();
                celda.textContent = texto;
            });

            //Agregar columna de operaciones con imágenes
            var celdaOperaciones = fila.insertCell();
            var imgEditar = document.createElement('img');
            imgEditar.src = '../img/pencil.svg'; 
            imgEditar.alt = 'Editar';
            imgEditar.style.cursor = 'pointer';
            imgEditar.style.width = '10%';
            imgEditar.style.marginRight = '10px';
            imgEditar.addEventListener('click', function() {
                
            });

            var imgEliminar = document.createElement('img');
            imgEliminar.src = '../img/bin.svg';
            imgEliminar.alt = 'Eliminar';
            imgEliminar.style.cursor = 'pointer';
            imgEliminar.style.width = '10%';
            imgEliminar.addEventListener('click', function() {
                var id = item[idField]; // Utilizamos el nombre del campo clave primaria para obtener su valor

                // Enviar solicitud para eliminar el registro
                if (confirm("¿Estás seguro de que deseas eliminar este elemento?")) {
                    fetch(`../pages/eliminar.php?type=${type}&idField=${idField}&id=${id}`)
                    .then(response => {
                        if (response.ok) {
                            // Obtener el índice de la fila actual
                            var rowIndex = Array.from(tabla.rows).indexOf(fila);
                            window.location.reload();
                            if (rowIndex !== -1) {
                                // Eliminar la fila de la tabla
                                tabla.deleteRow(rowIndex);
                            }
                        } 
                    })
                    .catch(error => console.error('Error al enviar la solicitud:', error));
                }
            });

            celdaOperaciones.appendChild(imgEditar);
            celdaOperaciones.appendChild(imgEliminar);
        });
    }

    //Función para configurar la paginación
    function paginar() {
        //Limpiamos el contenido actual de la paginación
        paginacionDiv.innerHTML = ""; 
        //Calculamos el número total de páginas
        var contadorPags = Math.ceil(datos.length / filasPorPagina); 

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
            //Agregamos el botón al div de paginación
            paginacionDiv.appendChild(boton); 
        }
    }

    //Mostramos la tabla con la primera página de datos
    mostrarTabla(paginaInicial); 
    // Configuramos la paginación
    paginar();
});
