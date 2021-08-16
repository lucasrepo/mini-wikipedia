<?php session_start();
/* ESENCIAL */
	include_once("auth.php");
	include("querys.php");

/*Filtro XSS básico*/
$name = htmlspecialchars($_POST['name']);
$text = htmlspecialchars($_POST['t-area']);

/*Si está vacío regresa a home*/
isEmpty($name);

if (exist('load')):
	
	if(validate($name, $conn) == 0)
		homeError(0, "El archivo no existe, crea uno nuevo o intenta con otra busqueda");

	$mydb_query = select($name);
	$state = "Load";
elseif (exist('add')): /*ADD ADD ADD*/

    if(validate($name, $conn) == 0)
        homeError(0, "El archivo no existe, crea uno nuevo o intenta con otra busqueda");
    if(!isset($_SESSION['favs']))
        $_SESSION['favs'] = 0;
    else{
        $_SESSION['favs']++;
    }
    $value_c = "value[" . $name . "]";
    $value = str_replace(" ", "-", $value_c);
    /* INFORMATION */
    setcookie($value, $text, time()+(60*60*24*30), "/");
    header("Location: /index?state=add"); exit;

elseif (exist('update')): /* UPDATE UPDATE UPDATE */

    if(empty($text))
    	homeError(0, "The field text is required!");

    /*QUERY VERIFICACION PSW*/
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
                        $mydb_query = update($text, $name, getRealIP());
                    } else { homeError(4, "La contraseña no coincide"); }
                } else { homeError(3, "Este contenido se encuentra protegido, ingresa la contraseña para modificar"); }
            } else { $mydb_query = update($text, $name, getRealIP()); } /*SIN PSW*/
        } else { homeError(2, "El contenido que busca no existe"); }
    } else { homeError(111, "No se pudo realizar la petición"); }
    $state = "Update";
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
        $hpass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $mydb_query = insert($name, $text, getRealIP(), $hpass);
    else:
        $mydb_query = insert($name, $text, getRealIP());
    endif;
	$state = "New";

else: 
	homeError(222, "Error sin identificar, repita los pasos y reportalo con un moderador");
endif;

unsetSuperglobalGet("name"); unsetSuperglobalGet("information");
unsetSuperglobalSession("name"); unsetSuperglobalSession("information");

/* QUERY */
if($result = mysqli_query($conn, $mydb_query))
{
	$_SESSION['name'] = $name;

	if(!empty($row = mysqli_fetch_assoc($result))) /* CARGAR/ACTUALIZAR */
	{
        $_SESSION['information'] = $row['texto'];
        header("Location: /index?state=$state"); exit;
	}
	else /* GUARDAR */
	{
		$_SESSION['information'] = $text;
        $_SESSION['pass'] = $_POST['pass'];
		header("Location: /index?state=$state"); exit;
	}
}
homeError(333, "No se pudo realizar la conexión con base de datos");