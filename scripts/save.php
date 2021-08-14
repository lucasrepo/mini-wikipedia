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

elseif (exist('update')): /* UPDATE UPDATE UPDATE */

    if(empty($text))
    	homeError(2, "The field text is required!");

    /*VERIFICATION*/
    $mydb_query = select($name);
    if($pre_result = mysqli_query($conn, $mydb_query))
    {
        if(!empty($row = mysqli_fetch_assoc($pre_result)))
        {
            if(!empty($row['contrasenia']))
            {
                if(!empty($_POST['pass']))
                {
                    if(password_verify($_POST['pass'], $row['contrasenia']))
                    {
                        $_SESSION['pass'] = $_POST['pass'];
                        $state = "Update";
                        $mydb_query = update($text, $name, getRealIP());

                        if(mysqli_query($conn, $mydb_query))
                        {
                            $_SESSION['name'] = $name;
                            $_SESSION['information'] = $text;
                            header("Location: /index?state=$state"); exit;

                        } else { homeError(8, "LAST QUERY"); }
                    } else { homeError(8, "La contraseña no coincide"); }
                } else { homeError(10, "Este contenido se encuentra protegido, ingresa la contraseña para modificar."); }
            } else { $mydb_query = update($text, $name, getRealIP()); } //UPDATE W/NO PASSW
        } else { homeError(8, "El contenido que busca no existe"); }
    } else { homeError(7, "No se pudo realizar la petición"); }
    
elseif (exist('new')):

	if(empty($text)):
		homeError(5, "The field text is required for save");
	elseif(validate($name, $conn) != 0):
		homeError(5, "El nombre ya existe, elige otro");
    elseif(!empty($_POST['pass'])):
        if(!preg_match("#[0-9]+#", $_POST['pass']))
            homeError(2, "Password must include at least one number!");
        if(!preg_match("#[A-Z]+#", $_POST['pass']))
            homeError(2, "Password must include at least one CAPS!");
        // CREATE HASH TO INSERT INTO TABLE
        $hpass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    endif;
	$mydb_query = insert($name, $text, getRealIP(), $hpass);
	$state = "New";

else: 
	homeError(2, "Error sin identificar");
endif;

//QUERY TO DB
if($result = mysqli_query($conn, $mydb_query))
{
	$_SESSION['name'] = $name;

	if(!empty($row = mysqli_fetch_assoc($result))) /* LOAD LOAD QUERY*/
	{
        $_SESSION['information'] = $row['texto'];
        header("Location: /index?state=$state"); exit;
	}
	else //NEW CONTENT TO SAVE
	{
		$_SESSION['information'] = $text;
        $_SESSION['pass'] = $_POST['pass'];
		header("Location: /index?state=$state"); exit;
	}
}
homeError(3, "No se pudo realizar la conexión con base de datos");