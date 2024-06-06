//El script se ejecuta cuando todo el contenido del DOM se ha cargado
document.addEventListener("DOMContentLoaded", function(){
    //Guardamos en una variable el input de búsqueda
    var barraBusqueda = document.getElementById('barraBusqueda');
    //Guardamos en una variable los datos en formato JSON
    var datos = JSON.parse(document.getElementById('datos').getAttribute('data'));
    //Guardamos en una variable el contenido del elemento cuyo id es tabla
    var tabla = document.getElementById("tabla");
    //Guardamos en una variable el cuerpo de la tabla
    var bodyTabla = tabla.getElementsByTagName('tbody')[0];
    //Guardamos en una variable el div para la paginación
    var paginacionDiv = document.getElementById("paginacion");
    //Guardamos en una variable el número de filas que se van a mostrar por página
    var filasPorPagina = 8;
    //Guardamos en una variable la página inicial
    var paginaInicial = 1;
    
    //Guardamos en una variable el tipo de datos, que será el nombre de cada tabla en la base de datos
    var type = tabla.getAttribute("data-type");
    //Guardamos en una variable el campo id, que será la clave primaria de cada tabla en la base de datos
    var clavePrimaria = tabla.getAttribute("data-idField");
    //Determinamos si se deben mostrar las operaciones de editar y eliminar según 'type', según la tabla de la base de datos que sea
    var mostrarOperaciones = ["ARTICULOS", "CLIENTES", "EMPLEADOS", "PROVEEDORES", "PEDIDOS"].includes(type);

    //Función para poder filtrar los datos y para actualizar tanto la tabla como la paginación
    function filtrarDatos(){
        //Guardamos en una variable lo que se escribe en el input de búsqueda
        var textoBusqueda = barraBusqueda.value.toLowerCase();
        //Filtramos los datos según el texto de búsqueda
        var datosFiltrados = datos.filter(function(dato){
            return Object.values(dato).some(function(valor){
                return valor.toString().toLowerCase().includes(textoBusqueda);
            });
        });
        //Mostramos la tabla y paginamos los datos filtrados
        mostrarTabla(1, datosFiltrados);
        paginar(datosFiltrados);
    }

    //Agregamos el evento input a la barra de búsqueda para filtrar datos en tiempo real, para que sea dinámico
    if(barraBusqueda){
        barraBusqueda.addEventListener('input', filtrarDatos);
    }

    //Función para mostrar la tabla con los datos de la página especificada
    function mostrarTabla(pagina, datosParaMostrar = datos){
        //Limpiamos la tabla antes de mostrar los datos
        bodyTabla.innerHTML = "";
        //Calculamos los índices de inicio y fin para la página actual
        var inicio = (pagina - 1) * filasPorPagina;
        var final = inicio + filasPorPagina;
        //Obtenemos los datos paginados para mostrarlos en la tabla
        var datosPaginados = datosParaMostrar.slice(inicio, final);

        //Iteramos sobre los datos paginados y agregamos las filas a la tabla con dichos datos
        datosPaginados.forEach(dato => {
            //Insertamos la fila en la tabla
            var fila = bodyTabla.insertRow();
            //Iteramos sobre los valores del datos y agregamos celdas a la fila
            Object.values(dato).forEach((texto, index) => {
                //Insertamos celda en la fila
                var celda = fila.insertCell();
                //Asignamos texto a la celda
                celda.textContent = texto;
                //Asignamos el atributo 'data-key' con el nombre del campo
                celda.setAttribute('data-key', Object.keys(dato)[index]);
            });

            //Agregamos la celda de operaciones a la fila, si se deben mostrar operaciones (editar/eliminar)
            if (mostrarOperaciones){
                //Insertamos la celda de operaciones en la fila
                var celdaOperaciones = fila.insertCell();

                //Creamos icono de editar
                var imgEditar = document.createElement('img');
                imgEditar.src = '../img/pencil.svg';
                imgEditar.alt = 'Editar';
                imgEditar.style.cursor = 'pointer';
                imgEditar.style.width = '10%';
                imgEditar.style.marginRight = '10px';
                //Llamamos a la función editarFila al hacer clic en el icono de editar
                imgEditar.addEventListener('click', function(){
                    editarFila(fila, dato);
                });

                //Creamos icono de eliminar
                var imgEliminar = document.createElement('img');
                imgEliminar.src = '../img/bin.svg';
                imgEliminar.alt = 'Eliminar';
                imgEliminar.style.cursor = 'pointer';
                imgEliminar.style.width = '10%';
                imgEliminar.addEventListener('click', function(){
                    //Obtenemos el id del elemento a eliminar, que es su clave primaria
                    var id = dato[clavePrimaria];
                    //Mostramos un mensaje para confirmar si estamos seguros de eliminar datos
                    if(confirm("¿Estás seguro de que deseas eliminar este elemento?")){
                        //Confirmamos la eliminación y enviar solicitud al servidor para eliminar el elemento
                        fetch(`../pages/operaciones/eliminar.php?type=${type}&clavePrimaria=${clavePrimaria}&id=${id}`)
                        .then(response => {
                            if (response.ok){
                                //Hacemos que se recargue la página después de eliminar el elemento
                                window.location.reload();
                            }
                        })
                    }
                });
                //Agregamos los iconos de editar y eliminar a la celda de operaciones
                celdaOperaciones.appendChild(imgEditar);
                celdaOperaciones.appendChild(imgEliminar);
            }
        });
    }

    //Función para habilitar la edición de una fila
    function editarFila(fila, dato){
        var celdas = fila.cells;
        //Iteramos sobre las celdas de la fila (menos la última, ya que contiene las operaciones)
        for (var i = 0; i < celdas.length - 1; i++){ 
            var celda = celdas[i];
            //Obtenemos el nombre del campo
            var nombreCampo = celda.getAttribute('data-key');
            //Creamos un elemento input
            var input = document.createElement('input');
            //Establecemos el tipo de input como texto
            input.type = 'text';
            //Establecemos el valor del input como el texto actual de la celda
            input.value = celda.textContent;
            //Establecemos el atributo 'data-key' con el nombre del campo
            input.setAttribute('data-key', nombreCampo);
            //Limpiamos el contenido de la celda
            celda.innerHTML = '';
            //Agregamos el input a la celda
            celda.appendChild(input);
        }

        //Obtenemos la celda de operaciones, es decir, la última celda de la fila
        var celdaOperaciones = celdas[celdas.length - 1];
        //Limpiamos el contenido de la celda de operaciones
        celdaOperaciones.innerHTML = '';

        //Creamos el botón de guardar cambios
        var botonGuardar = document.createElement('button');
        botonGuardar.textContent = 'Guardar';
        botonGuardar.className = "paginacion-boton";
        //Llamamos a la función guardarFila al hacer clic en el botón de guardar
        botonGuardar.addEventListener('click', function(){
            guardarFila(fila, dato);
        });

        //Creamos el botón de cancelar edición
        var botonCancelar = document.createElement('button');
        botonCancelar.textContent = 'Cancelar';
        botonCancelar.className = "paginacion-boton";
        //Mostramos la tabla original al hacer clic en el botón de cancelar
        botonCancelar.addEventListener('click', function(){
            mostrarTabla(paginaInicial);
        });

        //Agregamos el botón de guardar y el botón de cancelar a la celda de operaciones
        celdaOperaciones.appendChild(botonGuardar);
        celdaOperaciones.appendChild(botonCancelar);
    }

    //Función para guardar los cambios realizados en una fila
    function guardarFila(fila, dato){
        //Obtenemos todas las celdas de la fila
        var celdas = fila.cells;
        //Creamos un objeto para almacenar los nuevos valores de los campos
        var datosActualizados = {};
    
        //Guardamos los nuevos valores de los inputs
        for (var i = 0; i < celdas.length - 1; i++){
            var celda = celdas[i];
            //Obtenemos el input dentro de la celda
            var input = celda.firstChild;
            //Obtenemos el nombre del campo
            var nombreCampo = input.getAttribute('data-key');
            //Obtenemos el nuevo valor del input
            var nuevoValor = input.value;
            //Agregamos el nuevo valor al objeto de datos actualizados
            datosActualizados[nombreCampo] = nuevoValor;
            //Actualizamos el valor del campo en el dato original
            dato[nombreCampo] = nuevoValor;
            //Actualizamos el texto de la celda con el nuevo valor
            celda.textContent = nuevoValor;
        }
    
        //Obtenemos el ID del elemento, que es la clave primaria
        var id = dato[clavePrimaria];
        //Enviamos una solicitud al servidor para actualizar los datos en la base de datos
        fetch(`../pages/operaciones/actualizar.php?type=${type}&clavePrimaria=${clavePrimaria}&id=${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            //Enviamos los nuevos datos en formato JSON
            body: JSON.stringify(datosActualizados)
        })
        .then(data => {
            //Restauramos los iconos de editar y eliminar
            //Obtenemos la celda de operaciones
            var celdaOperaciones = fila.cells[fila.cells.length - 1];
            //Limpiamos el contenido de la celda de operaciones
            celdaOperaciones.innerHTML = '';
    
            //Creamos el icono de editar
            var imgEditar = document.createElement('img');
            imgEditar.src = '../img/pencil.svg';
            imgEditar.alt = 'Editar';
            imgEditar.style.cursor = 'pointer';
            imgEditar.style.width = '10%';
            imgEditar.style.marginRight = '10px';
            //Habilitamos la edición al hacer clic en el icono de editar
            imgEditar.addEventListener('click', function(){
                editarFila(fila, dato);
            });
    
            //Creamos el icono de eliminar
            var imgEliminar = document.createElement('img');
            imgEliminar.src = '../img/bin.svg';
            imgEliminar.alt = 'Eliminar';
            imgEliminar.style.cursor = 'pointer';
            imgEliminar.style.width = '10%';
            //Obtenemos el ID del elemento a eliminar, su clave primaria
            imgEliminar.addEventListener('click', function(){
                var id = dato[clavePrimaria];
    
                //Mostramos un mensaje para confirmar si estamos seguros de eliminar datos
                if(confirm("¿Estás seguro de que deseas eliminar este elemento?")){
                    //Confirmamos la eliminación y enviamos una solicitud al servidor para eliminar el elemento
                    fetch(`../pages/operaciones/eliminar.php?type=${type}&clavePrimaria=${clavePrimaria}&id=${id}`)
                    .then(response => {
                        if(response.ok){
                            //Hacemos que se recargue la página después de eliminar el elemento
                            window.location.reload();
                        }
                    })
                }
            });
    
            //Agregamos los iconos de editar y de eliminar a la celda de operaciones
            celdaOperaciones.appendChild(imgEditar);
            celdaOperaciones.appendChild(imgEliminar);
        })
    }
    
    //Función para configurar la paginación
    function paginar(datosParaPaginar = datos){
        //Limpiamos el contenido del div de paginación
        paginacionDiv.innerHTML = "";
        //Calculamos el número total de páginas
        var totalPags = Math.ceil(datosParaPaginar.length / filasPorPagina);

        //Creamos los botones de paginación para cada página
        for(var i = 1; i <= totalPags; i++){
            //Creamos un elemento de botón
            var boton = document.createElement("button");
            //Establecemos el texto del botón como el número de página
            boton.textContent = i;
            //Asignamos una clase al botón
            boton.className = "paginacion-boton";
            //Marcamos el primer botón como activo por defecto
            if(i === 1){
                boton.classList.add("active");
            }
            //Agregamos el evento click para cambiar de página
            boton.addEventListener("click", function() {
                //Obtenemos el número de página actual
                var paginaActual = parseInt(this.textContent);
                //Mostramos la tabla con los datos de la página seleccionada
                mostrarTabla(paginaActual, datosParaPaginar);
                //Obtenemos todos los botones de paginación
                var botones = paginacionDiv.getElementsByTagName("button");
                //Borramos la clase 'active' de todos los botones y la agregamos al botón seleccionado
                Array.from(botones).forEach(boton => boton.classList.remove("active"));
                this.classList.add("active");
            });
            //Agregamos el botón de paginación al div de paginación
            paginacionDiv.appendChild(boton);
        }
    }

    //Mostramos la tabla inicial y configuramos la paginación
    mostrarTabla(paginaInicial, datos);
    paginar(datos);
});