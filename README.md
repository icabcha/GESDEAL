# GESDEAL

1.	Introducción

El presente documento proporciona un informe detallado sobre una idea de proyecto que consiste en la creación de un sistema de gestión de almacenes, más comúnmente conocido como SGA (software para gestión de almacenes). El uso de este tipo de software en las empresas es de gran importancia para mejorar la eficiencia de las mismas y así evitar problemas tanto de ejecución como de rendimiento general. Por ello, al ser una pieza clave para muchas empresas, he considerado realizar un proyecto que desarrolle este tipo de software que podría ser de beneficio para muchas personas.

2.	Descripción del proyecto

El proyecto GESDEAL nace como respuesta a la necesidad de un gran número de empresas de administrar y de llevar una buena y adecuada gestión del almacén que puedan poseer. GESDEAL está enfocado a ofrecer servicios que puedan solucionar problemas que se encuentran entre las empresas, los cuales suelen ser recurrentes, en cuanto al inventario se refiere. Problemas como pueden ser: pérdida de control de las mercancías que se poseen, ignorancia de los movimientos registrados dentro del almacén, ya sean de entrada o de salida, falta de stock de artículos, exceso de existencias... 
GESDEAL, por tanto, es un gestor de almacén o también denominado SGA (software para gestión de almacenes) enfocado a solventar los problemas citados anteriormente. Se pretende crear un entorno gráfico eficaz, útil y sencillo para que la empresa que decida hacer uso de él pueda hacerlo de forma adecuada.
En este caso, GESDEAL se utilizará para la gestión del stock de una librería. Con este software se podrá llevar un registro y un seguimiento adecuado de las ventas que produzca la librería. Todo ello, incluirá información de los empleados que realicen el proceso, de los artículos incluidos en los pedidos de los clientes, de los proveedores de la librería, así como de sus clientes…

3.	Requisitos necesarios

Para que este proyecto pueda salir adelante hay que tener en cuenta una serie de requisitos que son necesarios para ello. 
En primer lugar, será imprescindible poseer un equipo, es decir, un ordenador, con las características mínimas necesarias para poder instalar programas, tales como Visual Studio Code y XAMPP. 
Visual Studio Code es un editor de código fuente mediante el cual podremos utilizar PHP, HTML, CSS, JavaScript, etc., todo ello para poder desarrollar y diseñar nuestro gestor de almacén.
XAMPP es un paquete de software libre gracias al cual podremos gestionar la base de datos con MySQL y usar el servidor web Apache para realizar pruebas del proyecto en local. 

Imagen 1. Logos de Visual Studio Code y XAMPP.
Por otro lado, si quisiéramos que el SGA se encontrara en un servidor externo bajo un dominio, deberíamos tener un servidor del que poder hacer uso. Este servidor puede ser propio o externo. Además, sería necesario contar con conexión a Internet.
Asimismo, para poder contar con la realización de copias de seguridad, necesitaríamos un segundo servidor, para que en caso de que ocurriera algún contratiempo, pudiéramos recuperar información. Ya que, si tanto el SGA como las copias de respaldo se encuentran en el mismo lugar, seguiríamos teniendo el mismo problema si ocurriera algún incidente.
Además de los requisitos materiales citados anteriormente, será necesaria al menos una persona cualificada que pueda encargarse de la programación y el diseño del software gestor de almacén, así como de su continuo mantenimiento.

4.	Diseño de la base de datos
4.1.	Modelo entidad/relación

Según la definición propuesta por ESIC, “el modelo entidad relación es una herramienta que permite representar de manera simplificada los componentes que participan en un proceso de negocio y el modo en el que estos se relacionan entre sí.”
Para informatizar la empresa de este proyecto, es decir, la librería, se poseen los siguientes datos: 
Los clientes realizan sus compras por medio de pedidos. Estos pedidos se hacen de forma individual, es decir, dos clientes no pueden participar en un mismo pedido. Los empleados se dedican a vender artículos de la librería que están incluidos en pedidos.  Cada artículo es suministrado por uno o varios proveedores, pudiendo variar el precio de compra de un proveedor a otro. Un mismo proveedor puede suministrar el mismo artículo varias veces, en cuyo caso el precio del artículo también puede variar. El precio de venta del artículo se calculará incrementando en un 30% el precio de compra en cada momento. Interesa guardar los siguientes datos: 

	De cada empleado: código, DNI, nombre, teléfono y sueldo. Además, a cada empleado se le asigna una contraseña para que, junto con su DNI, pueda acceder al software que gestiona el almacén.
	De cada artículo: código, nombre, cantidad almacenada, precio de venta, proveedores que lo han suministrado al menos una vez, precio al que lo han suministrado en cada ocasión y fecha de cada suministro. 
	De cada proveedor: código, NIF, nombre, dirección, teléfono, artículos que ha suministrado al menos una vez, precio al que ha suministrado cada artículo en cada ocasión y fecha de cada suministro. 
	De cada pedido: código, fecha, cliente que lo solicita, artículos incluidos en él y cantidad de cada artículo.
	De cada cliente: código, DNI, nombre, teléfono, código postal y pedidos que haya realizado. 

 
Imagen 2. Modelo E/R.

4.2.	Modelo relacional

La definición propuesta por Arenada, P. (2021). Base de datos: el camino de los datos a la información, dice que “el modelo relacional, para el modelado y la gestión de bases de datos, es un modelo de datos basado en la lógica de predicados y en la teoría de conjuntos.”
Gracias al modelo relacional, se podrá realizar el modelo de la base de datos de una forma más sencilla y ordenada, ya que podemos ver las diferentes tablas que deben ser creadas, así como los datos que contienen cada una de ellas.

 
Imagen 3. Modelo relacional.
