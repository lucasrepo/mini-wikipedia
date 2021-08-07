<?php
// VALUE: <INPUT> NOMBRE DEL ARCHIVO
function value($message){
	return "value='". $message ."'";
}
// MENSAJE DE ALERTA SI EXISTE UN ERROR
function alert($message){
	if(!empty($message)){
		echo '<script type="text/javascript"> alert("';
		echo $message;
		echo '") </script>';
	}
}
// DEFAULT VALUE: TEXT-AREA (POCO UTIL)
function textArea($name){
	if(!isset($_SESSION[$name]))
		$_SESSION[$name] = '...';
}
// CAMBIA EL NOMBRE DEL TÍTULO CONFORME AL PROYECTO
function title($name){
	echo "<script> document.title = 'Project: $name' </script>";
}
// NO PERMITE RETROCEDER
function dontBack(){
	if(!empty($_GET))
	{
		for($i = 0; $i < count($_SESSION['GET']); $i++)
		{
		    if($_SESSION['GET'][$i] == $_GET)
		    {
		    	if($_GET['error'])
		    		alert($_GET['error']);
		    	header("Refresh:0; url=/");
		    	exit;
		    }
		}
		$_SESSION['GET'][] = $_GET;
	}
}