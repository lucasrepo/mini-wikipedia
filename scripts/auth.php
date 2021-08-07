<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'admin';
$DATABASE_PASS = '';
$DATABASE_NAME = 'usuarios';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if(mysqli_connect_errno())
{
	$_SESSION['error'] = 'No hay conexión con MySQL: ' . mysqli_connect_error(); 
	header('Location: /'); exit;
}
else
{
	header('Location: /');
}