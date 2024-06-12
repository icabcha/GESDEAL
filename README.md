# GESDEAL

## Descripción del proyecto

GESDEAL es un software de gestión de almacenes, también denominado SGA. Está enfocado a ofrecer servicios que puedan solucionar problemas que se encuentran entre las empresas, los cuales suelen ser recurrentes, en cuanto al inventario se refiere. Problemas como pueden ser: pérdida de control de las mercancías que se poseen, ignorancia de los movimientos registrados dentro del almacén, ya sean de entrada o de salida, falta de stock de artículos, exceso de existencias... 
GESDEAL, por tanto, es un gestor de almacén o también denominado SGA (software para gestión de almacenes) enfocado a solventar los problemas citados anteriormente. Se pretende crear un entorno gráfico eficaz, útil y sencillo para que la empresa que decida hacer uso de él pueda hacerlo de forma adecuada.

## Requisitos para el desarrollo del proyecto

- **Programas:** Visual Studio Code y XAMPP.
- **Lenguajes de programación:** PHP, MySQL, JavaScript y CSS.
- **Programa para la simulación del despliegue de la aplicación:** VirtualBox.
- **Servidores necesarios:** Servidor web, servidor DNS y servidor SQL.

## Prerequisitos para el uso del sistema

Asegúrese de tener instalado los siguientes programas:

- [XAMPP](https://www.apachefriends.org) (Para poder desplegar la aplicación en un entorno local)
- [GitHubDesktop](https://desktop.github.com/) (Para clonar el repositorio de GitHub en un entorno local)

## Clonar repositorio en el entorno local

Una vez instalado GitHubDesktop, entramos en la aplicación y pulsamos la siguiente combinación de teclas: '**CTRL + Shift + O**'. 
En la pestaña '**URL**', pondremos en '**Repository URL or GitHub username and repository**': [https://github.com/icabcha/GESDEAL.git](https://github.com/icabcha/GESDEAL.git).
En '**Local path**', se puede elegir la ruta que se desee dentro del directorio donde se alojan las páginas web del servidor Apache que se instala con XAMPP (**htdocs**).
Una vez pulsemos en '**Clone**', tendremos el proyecto en nuestro entorno local.

## Uso del sistema desarrollado

- Para acceder al software de forma local debemos ingresar la siguiente URL en nuestro navegador: [http://localhost/GESDEAL/login.php](http://localhost/GESDEAL/login.php).
- En el caso de haber desplegado el software en un servidor, debemos escribir la siguiente URL en nuestro navegador: [http://gesdeal.com](http://gesdeal.com). Este es el dominio que hemos configurado en las máquinas virtuales simulando el despliegue de la aplicación.

Al acceder a la URL proporcionada, ya sea en el entorno local o en el entorno de producción, nos encontraremos con una página de inicio de sesión donde podremos rellenar un formulario con nuestras credenciales, que en este caso serán el DNI y la contraseña del empleado que va a utilizar el sistema. 
Para utilizar el sistema gestor de almacén podemos iniciar sesión con cualquier usuario que se encuentre en la base de datos como empleado. 

La base de datos se crea, si no está ya creada, al acceder por primera vez a la página de inicio de sesión del sistema.



