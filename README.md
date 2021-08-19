# MyWiki: 
**_Crea, Actualiza y Carga_** contenido público o privado en segundos y de forma anónima.

## Manual
### Base de datos:
En _scripts/auth.php_ se realiza la configuración con los siguientes campos
* **id**: Primary key; Default: auto-incremental; BIGINT(20).
* **fecha**: Default: current-timestamp comprobado para MariaDB y MySQL; not null.
* **nombre**: VARCHAR(30); not null. Es el título de las publicaciones, seguramente el 'nombre' pasará a ser un identificador del usuario.
* **contrasenia**: VARCHAR(255), tiene que tener un tamaño mayor o igual a 255 por el valor hash;  _null_.
* **IPV4**: Necesario para administrar, se recoge automaticamente cuando se crea o actualiza una publicación; VARCHAR(); not null.
* **banned**: Usuarios bloqueados; _null_.

### Index:
En _index.php_ se incluye _includes/header.php_ e _includes/footer.php_; quizá se agregen nuevos ficheros como _style.html_ y _script.html_. En el mismo directorio se encuentra _functions.php_ con funciones auxiliares.

#### Por realizar
* Permitir añadir imágenes.
* Moderadores, pueden eliminar contenido o fijarlos.
* Pull requests.
* Mejorar el diseño.
