<?php

	/*
	ARCHIVO PARA LA ELIMINACION DE UNA MESA
	*/

	session_start();

	include 'BaseDeDatos.php';

	if (!array_key_exists('userID', $_SESSION) || !array_key_exists('eventID', $_SESSION))
		header('Location: error.html');

	$isTableID = array_key_exists('tableID', $_GET);

	if($isTableID){
		if (checkNumber($_GET['tableID'])) {
			deleteTable($_GET['tableID']);
			echo "successfull";
		}
		else
			echo "error";
	}
	else
		echo "error";


?>