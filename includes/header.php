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
	<link rel="icon" href="http://www.landho.epizy.com/img/favicon.ico?v=2" />
    <link rel="preload" href="img/starsbg.gif" as="image">
    <link rel="preload" href="img/favicon.ico" as="image">
    <link rel="preload" href="img/eye.png" as="image">
    <link rel="preload" href="img/eyeslash.png" as="image">
	<?php title($_SESSION['name']) ?>
