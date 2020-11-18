<?php

	/*
	ARCHIVO PARA LA ELIMINACION DE UN INVITADO
	*/

	session_start();

	include 'BaseDeDatos.php';

	if ( !array_key_exists('userID', $_SESSION) || !array_key_exists('eventID', $_SESSION))
		header('Location: error.html');
	
	$isGuestID = array_key_exists('guestID', $_GET);

	if($isGuestID){
		if (checkNumber($_GET['guestID'])) {
			deleteGuest($_GET['guestID']);
			echo "successfull";
		}
		else
			echo "error";
	}
	else
		echo "error";
?>
