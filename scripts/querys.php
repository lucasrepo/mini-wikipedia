<?php
function select($name){
	$s = "SELECT * FROM general WHERE nombre='". $name ."';";
	return $s;
}

function update($text, $name){
	$u = "UPDATE general SET texto='" . $text ."' WHERE nombre='". $name ."';";
	return $u;
}

function insert($name, $text){
	$i = "INSERT INTO general(nombre, texto) VALUES ('". $name . "', '" . $text . "')";
	return $i;
}

function exist($name) // IF EXIST $name RETURN TRUE
{
	return array_key_exists($name, $_POST);
}

function isEmpty($name){
	if(empty($name)) homeError(1, "El nombre no puede estar vacío");
}

function homeError($number, $message){
	header("Location: /?error=FATAL-ERROR-" . $number . ": $message."); exit;
}