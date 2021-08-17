
<p align="center"><a href="https://lavenir.co" target="_blank"><img src="https://www.lavenir.com.co/wp-content/uploads/2020/10/logo-lavenir-color-1.png" width="400"></a></p>

## Prueba Técnica - L'avenir

Este repositorio es de uso exclusivo para la prueba técnica del Ing. Ernesto Flames para optar por la vacante de backend developer en la empresa L'avenir.

<b>Fecha de solicitud de la prueba:</b> Viernes 13 de Agosto 2021.
<hr>

**Tecnologías usadas**

<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>
<a href="https://vuejs.org/" target="_blank"><img src="https://ifytic.com/wp-content/uploads/2021/02/vuejs.png" width="400"></a>


**Preview**

<img src="https://i.postimg.cc/SRXBHjNH/Web-capture-17-8-2021-114049-prueba-tecnica-test.jpg" width="900px">


## Instrucciones de instalación

**Requisitos previos:**

- Node && NPM
- Composer
- MySQL ó MariaDB
- Servidor Apache o Nginx (opcional)

**Instalación paso a paso**

1. Descargar el repositorio a su equipo local

2. Abrir una terminal y una vez situado en la carpeta raíz del repositorio ejecutar la instalacion de Laravel y sus paquetes con el siguiente comando:

``` bash
composer install 
```

3. Crear una nueva base de datos en su instancia de MySQL o MariaDB (reservar el nombre porque lo usaremos después)

4. Crear una copia del archivo de entorno .env.example (incluido en el repo) dentro de la carpeta raíz del repositorio clonado y nombrarlo .env (sin el .example). 

5. Crear la llave de seguridad de la aplicacion generada por Laravel con el siguiente comando:

``` bash
php artisan key:generate
```

6. Editar el archivo .env creado en el paso #4 agregando los datos de nuestra base de datos creda en el paso #3. Ejemplo:

``` bash
DB_DATABASE=nombre_base_de_datos
DB_USERNAME=usuario
DB_PASSWORD=password
```
**Nota:** Para que los cambios en el archivo de entorno sean tomados en cuenta es necesario limpiar el caché con el siguiente comando:

``` bash
php artisan optimize
```

7. Ejecutar las migraciones y seeders para crear tablas en la base de datos con datos de demostración con el siguiente comando nuevamente en la misma terminal:

``` bash
php artisan migrate --seed 
```

8. Finalmente y nuevamente en la terminal iniciamos el servidor para ejecutar la aplicación con el siguiente comando:

``` bash
php artisan serve 
```

9. Puede crear un usuario nuevo y entrar o puede entrar con los siguientes datos:

**Usuario:** eflames
**Pass:** 123123123

## Requerimientos de la empresa para esta prueba
Este es el escrito recibido de la empresa con las instrucciones para esta prueba.

**Backend**
- Crear una base de datos con una tabla llamada usuarios con los campos nombre, apellido, nombre de usuario, contraseña, edad, ocupación, número de identificación
- Crear una api rest con los servicios que considere necesarios, lea los requerimientos en el front

**Frontend**
- Se debe crear una vista de login para el acceso de usuarios registrados
- Se debe crear una vista para registrar nuevos usuarios
- Se debe crear una vista con la lista de usuarios (solo se puede acceder a esta vista si el usuario se ha registrado previamente), en esta vista debo poder editar y borrar cualquier usuario de la lista
- Solo se podrá editar el nombre, apellido, identificación, edad y ocupación del usuario
- En la vista que lista usuarios se debe poder ordenar los usuarios por edad y apellido
- En la vista que lista usuarios se debe poder filtrar los usuarios por ocupación
- En la vista que lista usuarios se debe poder buscar a un usuario por su identificación (barra de búsqueda)

**Tecnologías**
- Para el backend usar laravel
- El motor de base de datos debe ser mysql
- Para el frontend se debe usar Angular o Vue Js


<hr>


<p align="center"><a href="https://www.ernestoflames.com"><img src="https://i1.wp.com/ernestoflames.com/wp-content/uploads/2020/05/cropped-logo.png?resize=225%2C49&ssl=1"></a></p>
<p align="center">https://www.ernestoflames.com</p>
