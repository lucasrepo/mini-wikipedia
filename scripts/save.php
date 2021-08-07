<?php
// INCLUDES
	include_once("auth.php");
	include("querys.php");

// DECLARATIONS
	$name = htmlspecialchars($_POST['name']);
	$text = htmlspecialchars($_POST['t-area']);

// CHECK VARIABLES & SESSIONS
isEmpty($name);
if(isset($_SESSION['information']))
	unset($_SESSION['information']);

// CHECK BUTTONS
if (exist('load')):
	$mydb_query = select($name);
elseif (exist('save') && !empty($text)):
	$mydb_query = update($text, $name);
elseif (exist('new') && !empty($text)):
	$mydb_query = insert($name, $text);
else:
	homeError(2, "Debe escoger una opción");
endif;

//QUERY TO DB
if($result = mysqli_query($conn, $mydb_query))
{
	$_SESSION['name'] = $name;

	if(!empty($row = mysqli_fetch_assoc($result)))
	{
		$_SESSION['information'] = $row['texto'];
		header("Location: /?state=saveSuccesful"); exit;
	}
	else //NEW CONTENT TO SAVE
	{
		$_SESSION['information'] = $text;
		header("Location: /?state=newInformation"); exit;
	}
}
homeError(3, "La petición no se realizó con éxito");