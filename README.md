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
En _index.php_ se incluye _includes/header.php_ e _includes/footer.php_; quizá se divida header en _style.html_ y _script.html_ por su densidad. En el mismo directorio se encuentra _functions.php_ qué, como su nombre lo indica, son funciones auxiliares.

### /scripts:
_save.php_ se encarga de recibir la petición del usuario y en caso de error, ejecuta [homeError($id, $mensaje)] que devuelve a _index.php_ con un mensaje de alerta. En _querys.php_ se aloja funciones auxiliares.

### Moderador
En _includes/_ se encuentra _admin.html_ y _admin.php_, el primero es un formulario y el segundo procesa dichos datos. Hay varias cosas que tener en cuenta, no es un inicio de sesión común, primero hay que agregar a la variable **_$ipadmin_** la dirección IPv4 del administrador y en **_$specialkey_** una "llave" que existirá en la base de datos, estas dos variables son temporales, una vez creada la sesión del administrador se deberán eliminar o cambiar por otras. Cuando se desee agregar un nuevo administrador los pasos se deben repetir.

#### ¿Cuáles son sus dependencias?
* Una base de datos como MariaDB/MySQL.
* PHP>7.0v
Con eso es suficiente.

## Por realizar:
* Permitir añadir imágenes.
* Opción para moderadores: fijar publicaciones.
* La opción "Pull requests" para publicaciones privadas.
* Mejorar el diseño del textarea.
* Documentar algunas funciones.
