<?php

	/*
	ARCHIVO PARA LA ACTUALIZACION DE LOS DATOS DEL EVENTO
	*/

	include 'BaseDeDatos.php';

	session_start();

	if (!array_key_exists('userID', $_SESSION) || !array_key_exists('eventID', $_SESSION))
		header('Location: error.html');

	if (!array_key_exists('eventID', $_GET))
		echo "error";
	else
		$eventID = $_GET['eventID'];

	$event = getEvent($eventID);

	if (array_key_exists('eventName', $_GET)){
			if(checkName($_GET['eventName'])){
				updateEventName($eventID,$_GET['eventName']);
				echo "successfull";
			}
			else
				echo "error";
		}

	if (array_key_exists('eventAddress', $_GET)){
		if(checkAddress($_GET['eventAddress'])){
			updateEventAddress($eventID,$_GET['eventAddress']);
			echo "successfull";
		}
		else
			echo "error";
		}

	if (array_key_exists('eventDate', $_GET)){

		if(checkDate2($_GET['eventDate'],substr($event["horary"],0,5))){
			updateEventDate($eventID,$_GET['eventDate']);
			echo "successfull";
		}
		else
			echo "error";

	}

	if (array_key_exists('eventTime', $_GET)){

		if(checkDate2($event["date"],$_GET['eventTime'])){
			updateEventHorary($eventID,$_GET['eventTime']);
			echo "successfull";
		}
		else
			echo "error";

	}
?>