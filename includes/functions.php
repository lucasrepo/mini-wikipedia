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
        echo "<div style='background-color: blue'>\n\t\t\t\t\t<span style='text-align: center'>Protect your notes with any password!</span>\n\t\t\t\t</div>\n";
}
function title($name){
    if(!empty($name)):
	    echo "<script> document.title = 'Project: $name' </script>";
    else:
        echo "<script> document.title = 'MyWiki' </script>";
    endif;
}

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

?>