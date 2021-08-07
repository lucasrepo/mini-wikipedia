<?php
// FUNCIONES AUXILIARES
	include("functions.php");
dontBack();
textArea($_SESSION['information']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<base href="/" />
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preload" href="css/style.css" as="style">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
	<link rel="icon" type="img/icon" href="/img/favicon.ico">
	<?php title($_SESSION['name']) ?>

</head>
<body>