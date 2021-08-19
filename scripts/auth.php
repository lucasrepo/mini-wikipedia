<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'admin';
$DATABASE_PASS = '';
$DATABASE_NAME = 'usuarios';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if($error = mysqli_connect_errno()){
	header("Location: /index?error=No existe conexión con la base de datos:".$error); exit;
}

function otherPost()
{
	global $conn;
	$mydb_query = "SELECT nombre, texto, fecha FROM general ORDER BY id DESC LIMIT 7;";

	if($result = mysqli_query($conn, $mydb_query))
	{
		while($row = mysqli_fetch_array($result))
		{
			echo "\t\t<div>\n\t\t\t<div>\n\t\t\t\t<h3><a href='/index?name=".$row['nombre']."&information=".$row['texto']."'>".$row['nombre']."</a></h3><h4 style='font-size: x-small;'>Last update: ".substr($row['fecha'], 11)."</h4>\n\t\t\t</div>\n\t\t\t<textarea style='color: white; background-color:#00003F; border-color: #00003F; min-height: 150px;' disabled=''>".$row['texto']."</textarea>\t\t</div>\n\n";
		}
	}
}
