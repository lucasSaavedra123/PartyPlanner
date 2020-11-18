<?php

	/*
	ARCHIVO PARA LA ELIMINACION DEL EVENTO
	*/
	
	session_start();

	include 'BaseDeDatos.php';
	
	if (!array_key_exists('userID', $_SESSION))
		header('Location: error.html');

	$isEventID = array_key_exists('eventID', $_GET);

	if($isEventID){

		if (checkNumber($_GET['eventID'])) {
			deleteEvent($_GET['eventID']);
			echo "successfull";
		}
		else
			echo "error";
	}
	else
		echo "error";

?>