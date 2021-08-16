<?php

function value($message){
	return "value='". $message ."'";
}
function alert($message){
	if(!empty($message)){
		echo '<script type="text/javascript"> alert("';
		echo $message;
		echo '") </script>';
	}
}
function notification(){
    if(!isset($_SESSION['pass']))
        echo "<div style='background-color: blue'>\n\t\t\t\t\t<span style='text-align: center'>¡Protege tus notas con una contraseña!</span>\n\t\t\t\t</div>\n";
}
function title($name, $scd_name){
    if(!empty($name)):
	    echo "<script> document.title = 'Proyecto: $name' </script>";
	elseif(!empty($scd_name)):
		echo "<script> document.title = 'Proyecto: $scd_name' </script>";
    else:
        echo "<script> document.title = 'MyWiki' </script>";
    endif;
}
/*
function dontBack(){
	if(!empty($_GET))
	{
		for($i = 0; $i < count($_SESSION['GET']); $i++)
		{
		    if($_SESSION['GET'][$i] == $_GET)
		    {
		    	if($_GET['error'])
		    		alert($_GET['error']);
		    	header("Refresh:0; url=/index");
		    	exit;
		    }
		}
		$_SESSION['GET'][] = $_GET;
	}
}
*/
function setPassword() : string {
    if(isset($_SESSION['pass'])):
        return "value='".$_SESSION['pass']."'";
    else:
        $arr = str_split('ABCDEFGHIJKLMNOPQRSTXYWZabcdefghijklmnopqrstxyz012345679');
        shuffle($arr); // randomize the array
        $arr = array_slice($arr, 0, 8); // get the first 8 (random) characters out
        $str = implode('', $arr); // smush them back into a string
        return "value='".$str."'";
    endif;
}
function showFavs(){
	if (isset($_COOKIE['value'])) {
	    foreach ($_COOKIE['value'] as $name => $value) {
	    	$name = str_replace("-", " ", $name);
	    	echo "\t\t\t\t<div><div><h3><a href='/index?name=".$name."&information=".$value."'>".$name."</a></h3></div>\n\t\t\t\t<textarea>";
	       	echo $value;
	        echo "</textarea></div>\n";
	    }
	}else{
		echo "\t\t\t\t<div><h5 style='font-size: small; text-align: center;'>No hay nada por aquí, guarda tus publicaciones con el botón 'añadir a favoritos'...</h5></div>";
	}
}
function showInfo($name, $msg = '') : string {
	if(isset($_GET[$name])) $msg = $_GET[$name];
	else if(isset($_SESSION[$name])) $msg = $_SESSION[$name];
	return $msg;
}
?>