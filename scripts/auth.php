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

	global $conn; $i=0;
	$mydb_query = "SELECT nombre, texto FROM general ORDER BY id DESC LIMIT 7;";

	if($result = mysqli_query($conn, $mydb_query))
	{
		while($row = mysqli_fetch_array($result))
		{
			echo "\t\t<div>\n\t\t\t<div>\n\t\t\t\t<h3>".$row['nombre']." #".$i."</h3>\n\t\t\t</div>\n\t\t\t<p>".$row['texto']."\n\t\t\t</p>\t\t</div>\n\n"; $i++;
		}
	}
}
