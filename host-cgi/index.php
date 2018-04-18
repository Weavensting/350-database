<?php
session_start();
$username = $_SESSION['username'];
$password = $_SESSION['password'] ;
$site = $_POST["site"];

if($site){
	if($site=="purchase"){
		echo shell_exec("python /var/www/html/host-cgi/purchase.py '".$username."' '".$password."'");
	}
	if($site=="add"){
		$item = $_POST["item"];
		echo shell_exec("python /var/www/html/host-cgi/addPanel.py '".$username."' '".$password."' '".$item."'");
	}
	if($site=="shop"){
		echo shell_exec("python /var/www/html/host-cgi/hello.py '".$username."' '".$password."'");
	}
	if($site=="cart"){
		echo shell_exec("python /var/www/html/host-cgi/cart.py '".$username."' '".$password."'");
	}

}
else{
	
echo shell_exec("python /var/www/html/host-cgi/hello.py '".$username."' '".$password."'");
}

?>