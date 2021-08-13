<?php session_start();
// AUXILIAR FUNCTIONS
	include("functions.php");
dontBack();
if(!empty($_GET['error'])) alert($_GET['error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<base href="/index" />
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="img/icon" href="img/favicon.ico">
    <link rel="preload" href="img/starsbg.gif" as="image">
	<?php title($_SESSION['name']) ?>
