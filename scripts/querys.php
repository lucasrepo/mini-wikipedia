<?php
function select($name) : string {
	$s = "SELECT * FROM general WHERE nombre='". $name ."';";
	return $s;
}

function getRealIP() : string {

    if(isset($_SERVER["HTTP_CLIENT_IP"]))		 return $_SERVER["HTTP_CLIENT_IP"];
	else if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) return $_SERVER["HTTP_X_FORWARDED_FOR"];
	else if(isset($_SERVER["HTTP_X_FORWARDED"])) 	 return $_SERVER["HTTP_X_FORWARDED"];
	else if(isset($_SERVER["HTTP_FORWARDED_FOR"])) 	 return $_SERVER["HTTP_FORWARDED_FOR"];
	else if(isset($_SERVER["HTTP_FORWARDED"])) 	 return $_SERVER["HTTP_FORWARDED"];
	else						 return $_SERVER["REMOTE_ADDR"];
}

function update($text, $name, $ipv4) : string {
	$u = "UPDATE general SET texto='" . $text ."', IPV4='". $ipv4 ."' WHERE nombre='". $name ."';";
	return $u;
}

function insert($name, $text, $ipv4, $password='') : string {
	$i = "INSERT INTO general(nombre, texto, contrasenia, IPV4) VALUES ('". $name . "', '" . $text . "', '". $password . "', '". $ipv4 ."');";
	return $i;
}

function validate($name, mysqli $conn) : int {
	$validate = mysqli_query($conn, "SELECT nombre FROM general WHERE nombre='".$name."';");
	$num_rows = mysqli_num_rows($validate);
	return $num_rows;
}

function exist($name) // Si el input de tipo button $name existe : true.
{
	return array_key_exists($name, $_POST);
}

function isEmpty($name)
{
	if(empty($name)) homeError(1, "The field name is required");
}

function homeError($number, $message)
{
	header("Location: /index?error=FATAL-ERROR-" . $number . ": $message."); exit;
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
