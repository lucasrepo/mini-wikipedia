<?php session_start();

if($_POST)
{
	if(count($_POST['user']) >= 30 || count($_POST['pass']) >= 60)
	{
		homeError(0, "Superó el límite establecido");
	}
	require("../scripts/auth.php"); require("../scripts/querys.php"); 

	$user = htmlspecialchars($_POST['user']);
	$pass = htmlspecialchars($_POST['pass']);

	if(isset($_POST['submit']) && !empty($user) && !empty($pass))
	{
		/*
		 * La dirección IP del administrador. Advertencia: Una vez realizada la sesión se tendrá que cambiar. Próximamente esta dirección será puesta directamente desde un panel
		 */	
		$ip_admin = "111.111.11.11";
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
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Zone</title>
	<link rel="icon" href="http://www.landho.epizy.com/img/favicon.ico?v=2" />
	<style type="text/css">
		.in {text-align: center; background-color: yellow; height: auto; box-sizing: border-box; vertical-align: center; padding: 20px; box-shadow: 10px 10px; }
		.in input { width: 200px;  padding: 10px; margin: 5px; text-align: center; }
		.in h4 { width: 100%;  padding: 10px; margin: 5px; text-align: center; }
	</style>
</head>
<body style="background-color:black; color: black; font-family: Verdana;">
	<form action="admin.php" method="post">
		<div class="in">
			<h4>¡Esta es la zona de administradores, si no eres uno corres el riesgo de quedar bloqueado!</h4>
			<div>
				<input type="text" name="user" placeholder="Usuario">
				<input type="password" name="pass" placeholder="Contraseña">
			</div>
			<input type="submit" name="submit" value="Iniciar sesión">
    	</div>
    </form>
</body>
</html>