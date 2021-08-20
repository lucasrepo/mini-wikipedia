<?php session_start();

/* ESENCIAL */
	include_once("auth.php");
	include("querys.php");

/*Filtro XSS básico*/
$name = htmlspecialchars($_POST['name']);
$text = htmlspecialchars($_POST['t-area']);

isBanned(); /* Si está baneado : wikipedia */
isEmpty($name); /* Si está vacío : homeError() */

if (exist('load')): /**** LOAD ****/
	
    /* Si existe contenido en bd : false */
	if(validate($name, $conn) == 0)
		homeError(0, "El archivo no existe, crea uno nuevo o intenta con otra busqueda");

	$mydb_query = select($name);
	$state = "Load";

elseif (exist('add')): /**** ADD ****/

    if(validate($name, $conn) == 0)
        homeError(0, "El archivo no existe, crea uno nuevo o intenta con otra busqueda");
    
    /*  Número de publicaciones añadidas a favoritos */
    $_SESSION['favs'] = isset($_SESSION['favs']) ? $_SESSION['favs']++ : 0;
    
    /* Conversión de whitespace para almacenar en array de cookie */
    $value_c = "value[" . $name . "]";
    $value = str_replace(" ", "-", $value_c);

    setcookie($value, $text, time()+(60*60*24*30), "/");
    header("Location: /index?state=add"); exit;

elseif (exist('update')): /**** UPDATE ****/

    if(empty($text))
    	homeError(0, "The field text is required!");

    /*QUERY VERIFICACION PSW*/
    $mydb_query = select($name);
    $pre_result = mysqli_query($conn, $mydb_query);

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

    $state = "Update";

elseif (exist('new')): /**** SAVE ****/

    $msg = "¡La contraseña debe tener, por lo menos, ";

	if(empty($text)):
		homeError(5, "The field text is required for save");
	elseif(validate($name, $conn) != 0):
		homeError(5, "El nombre ya existe, elige otro");
    elseif(!empty($_POST['pass'])):

        if(!preg_match("#[0-9]+#", $_POST['pass']))
            homeError(2, $msg."un número por seguridad!");

        if(!preg_match("#[A-Z]+#", $_POST['pass']))
            homeError(2, $msg."una mayúscula por seguridad!");

        $hpass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $mydb_query = insert($name, $text, getRealIP(), $hpass);

    else:
        $mydb_query = insert($name, $text, getRealIP());
    endif;

	$state = "New";
elseif (exist('ban')): /**** BAN ****/
    $mydb_query = select($name);
    if(mysqli_query($conn, $mydb_query)){
        
        $mydb_query = "UPDATE general SET banned='".$row['IPV4']."' WHERE nombre='".$row['nombre']."';";
        
        if(mysqli_query($conn, $mydb_query)){
            header("Location: /index?msg=¡Usuario bloqueado con éxito!");
        }else{
            homeError(777, "Error sin identificar, repita los pasos y reportalo");
        }

    }else{
        homeError(777, "Error sin identificar, repita los pasos y reportalo");
    }
else: /**** ERROR ****/

	homeError(222, "Error sin identificar, repita los pasos y reportalo con un moderador");

endif;

/* $destroy = !isset($_SESSION['admin']) ? session_destroy(); */

unsetSuperglobalGet("name"); unsetSuperglobalGet("information");
unsetSuperglobalSession("name"); unsetSuperglobalSession("information");

/* QUERY */
if($result = mysqli_query($conn, $mydb_query))
{
	$_SESSION['name'] = $name;
    
    $_SESSION['information'] = empty($row = mysqli_fetch_assoc($result)) ? $text : $row['texto'];
    
    $_SESSION['pass'] = isset($row['texto']) ? $_POST['pass'] : '';

    header("Location: /index?state=$state"); exit;
}
homeError(333, "Error sin identificar, repita los pasos y reportalo con un moderador");