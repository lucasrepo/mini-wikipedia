<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'admin';
$DATABASE_PASS = '';
$DATABASE_NAME = 'usuarios';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if(mysqli_connect_errno())
{
	$error = mysqli_connect_error(); 
	header('Location: /index?error=No existe conexión con MySQL: $error'); exit;
}
else
{
	header('Location: /index');
}

function otherPost(){

	global $conn;
	$mydb_query = "SELECT nombre, texto, fecha FROM general ORDER BY id DESC LIMIT 7;";

	if($result = mysqli_query($conn, $mydb_query))
	{
		while($row = mysqli_fetch_array($result))
		{
			echo "\t\t<div>\n\t\t\t<div>\n\t\t\t\t<h3><a href='/index?name=".$row['nombre']."&information=".$row['texto']."'>".$row['nombre']."</a></h3><h4 style='font-size: x-small;'>Last update: ".substr($row['fecha'], 11)."</h4>\n\t\t\t</div>\n\t\t\t<textarea>".$row['texto']."\n\t\t\t</textarea>\t\t</div>\n\n";
		}
	}
}
