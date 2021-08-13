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
?>