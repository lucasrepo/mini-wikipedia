<?php session_start();

require("../scripts/auth.php"); require("../scripts/querys.php"); 

$user = htmlspecialchars($_POST['user']);
$pass = htmlspecialchars($_POST['pass']);

if(isset($_POST['submit']) && !empty($user) && !empty($pass))
{
	/*
	 * La dirección IP del administrador, una vez realizada la sesión se tendrá que cambiar. Próximamente esta dirección será puesta directamente desde un panel
	 */	
	$ip_admin = "111.11.11.11";
	$ip_user = getRealIP();

	if($ip_user == $ip_admin)
	{
		/*
		* Tu llave maestra TEMPORAL, elige una de mayor seguridad  */	
		$special_key = "admin";

		/*
		* Si coinciden se crea una sesión de administrador, se recomienda cambiar la información una vez terminada la sesión, lo mismo con la dirección IP 
		*/
		$db_query = "SELECT nombre, contrasenia FROM general WHERE nombre='".$user."' AND contrasenia='".$pass."' AND texto='".$special_key."' LIMIT 1;";

		if($result = mysqli_query($conn, $db_query))
		{
			if(!empty($row = mysqli_fetch_assoc($result)))
			{
				$_SESSION['admin'] = $user;
			}
		}
		location("http://www.landho.epizy.com/");
	}
	else
	{
		/*
		* Si la dirección IP no coincide se añade a base de datos el "intruso". extiende esta tarea a tu gusto
		*/
		$db_query = insert(substr($ip_user, 4), "Se metió por donde no debía...", $ip_user, "intruso");
		mysqli_query($conn, $db_query); 
	}
}else{
	location();
}
?>
