<?php session_start();
// INCLUDES
	include_once("auth.php");
	include("querys.php");

// DECLARATIONS
	$name = htmlspecialchars($_POST['name']);
	$text = htmlspecialchars($_POST['t-area']);

// CHECK VARIABLES
isEmpty($name);

// CHECK BUTTONS
if (exist('load')):
	
	if(validate($name, $conn) == 0)
		homeError(5, "El archivo no existe, crea uno nuevo o intenta con otra busqueda");

	$mydb_query = select($name);
	$state = "Load";

elseif (exist('update')):

    if(empty($text))
    	homeError(2, "The field text is required for update");

    $mydb_query = update($text, $name);
    $state = "Saved";

elseif (exist('new')):

	if(empty($text))
		homeError(5, "The field text is required for save");

	if(validate($name, $conn) != 0)
		homeError(5, "El nombre ya existe, elige otro");

	$mydb_query = insert($name, $text);
	$state = "New";

else: 
	homeError(2, "Error sin identificar");
endif;

//UNSET SESSION FOR WHAT?
if(isset($_SESSION['information']))
	unset($_SESSION['information']);

//QUERY TO DB
if($result = mysqli_query($conn, $mydb_query))
{
	$_SESSION['name'] = $name;

	if(!empty($row = mysqli_fetch_assoc($result)))
	{
		$_SESSION['information'] = $row['texto'];
		header("Location: /index?state=$state"); exit;
	}
	else //NEW CONTENT TO SAVE
	{
		$_SESSION['information'] = $text;
		header("Location: /index?state=$state"); exit;
	}
}
homeError(3, "No se pudo realizar la conexión con base de datos");