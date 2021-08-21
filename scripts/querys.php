<?php
/*
* Selecciona
* @param string $name titulo exacto de la publicacion  
* 
*/
function select($name) : string {
	$s = "SELECT * FROM general WHERE nombre='". $name ."';";
	return $s;
}
/*
* Actualiza si los datos son exactos
* @param string $text contenido de la publicacion
* @param string $name título
* @param string $ipv4 direccion ip
*/
function update($text, $name, $ipv4) : string {
	$u = "UPDATE general SET texto='" . $text ."', IPV4='". $ipv4 ."' WHERE nombre='". $name ."';";
	return $u;
}
/*
* Insertar nueva publicacion con o sin contraseña
*/
function insert($name, $text, $ipv4, $password='') : string {
	$i = "INSERT INTO general(nombre, texto, contrasenia, IPV4) VALUES ('". $name . "', '" . $text . "', '". $password . "', '". $ipv4 ."');";
	return $i;
}

/*
* @return direccion ip
*/
function getRealIP() : string {

    if(isset($_SERVER["HTTP_CLIENT_IP"]))		 return $_SERVER["HTTP_CLIENT_IP"];
	else if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) return $_SERVER["HTTP_X_FORWARDED_FOR"];
	else if(isset($_SERVER["HTTP_X_FORWARDED"])) 	 return $_SERVER["HTTP_X_FORWARDED"];
	else if(isset($_SERVER["HTTP_FORWARDED_FOR"])) 	 return $_SERVER["HTTP_FORWARDED_FOR"];
	else if(isset($_SERVER["HTTP_FORWARDED"])) 	 return $_SERVER["HTTP_FORWARDED"];
	else						 return $_SERVER["REMOTE_ADDR"];
}
/*
* Para crear una publicacion se necesita un titulo sin usar
* @param titulo de la publicacion
* @return numero de filas
*/
function validate($name, mysqli $conn) : int {
	$validate = mysqli_query($conn, "SELECT nombre FROM general WHERE nombre='".$name."' LIMIT 1;");
	$num_rows = mysqli_num_rows($validate);
	return $num_rows;
}
/*
* @param nombre de la superglobal
* @return verdadero en caso de existir
*/
function exist($name) : bool {
	return array_key_exists($name, $_POST);
}

function isEmpty($name)
{
	if(empty($name)) homeError(1, "El título es obligatorio");
}

function homeError($number, $message)
{
	header("Location: /index?error=error " . $number . ": $message."); exit;
}

function unsetSuperglobalGet($name)
{
	if(isset($_GET[$name]))
    	unset($_GET[$name]);
}
function unsetSuperglobalSession($name)
{
	if(isset($_SESSION[$name]))
    	unset($_SESSION[$name]);
}
/*
* Consulta si fue bloqueado por su direccion ip. 
* Si existe registro se elimina su contenido excepto el titulo y la dirección baneada
*/
function isBanned()
{
	global $conn;
	$user_ip = getRealIP();
	$query = "SELECT banned FROM general WHERE banned='".$user_ip."' LIMIT 1;";
	
	if($result = mysqli_query($conn, $query))
	{
		if(!empty($row = mysqli_fetch_assoc($result)))
		{
			$_SESSION['ban'] = "Incumpliste las pocas reglas de este sitio. Ya no hay vuelta atras."; 
			$query = "DELETE id, nombre, contrasenia, IPV4 FROM general WHERE IPV4='".$user_ip."';";
			homeError(intval(mysqli_query($conn, $query)), $_SESSION['ban']);
		}
	}
}
/*
* @param string $url página a redireccionar
*/
function location($url="https://en.wikipedia.org/wiki/Remember_the_sabbath_day,_to_keep_it_holy")
{
	header("Location: $url"); exit;
}
