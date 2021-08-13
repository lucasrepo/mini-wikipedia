<?php
function select($name) : string {
	$s = "SELECT * FROM general WHERE nombre='". $name ."';";
	return $s;
}

function update($text, $name) : string {
	$u = "UPDATE general SET texto='" . $text ."' WHERE nombre='". $name ."';";
	return $u;
}

function insert($name, $text) : string {
	$i = "INSERT INTO general(nombre, texto) VALUES ('". $name . "', '" . $text . "')";
	return $i;
}

function exist($name) // IF EXIST $name RETURN TRUE
{
	return array_key_exists($name, $_POST);
}

function isEmpty($name){
	if(empty($name)) homeError(1, "The field name is required");
}

function homeError($number, $message){
	header("Location: /index?error=FATAL-ERROR-" . $number . ": $message."); exit;
}

function validate($name, mysqli $conn) {
	$validate = mysqli_query($conn, "SELECT nombre FROM general WHERE nombre='".$name."';");
	$num_rows = mysqli_num_rows($validate);
	return $num_rows;
}