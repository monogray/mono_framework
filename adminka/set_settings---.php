<?php
	// Autorization process 
	include_once 'connect.php';
	$dbConnect = new DBConnect();
	$dbConnect->connectToDB();
	
	include_once 'login.php';

	if($_GET["var"] == "login")
		loginIn($dbConnect);
	else if($_GET["var"] == "forgot_pass")
		sendPasToMail($dbConnect);
	else
		header ("location: index.php");
	
	function loginIn($_dbConnect){
		// Login
		if( isset($_POST["login"]) && isset($_POST["pass"]) ){
			$userData = new UserData;
			$userData->loginIn($_POST["login"], $_POST["pass"]);
		}
		header ("location: ".$_dbConnect->site_adminka_url);
	}
	
	function sendPasToMail($_dbConnect){
		// Send to mail
		if( isset($_POST["mail"]) ){
			$userData = new UserData;
			$userData->sendPasToMail($_POST["mail"]);
		}
		header ("location: ".$_dbConnect->site_adminka_url);
	}
?>
