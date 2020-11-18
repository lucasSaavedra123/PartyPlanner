<?php

	/*
	ARCHIVO PARA EL AGREGADO/EDICION DE INVITADOS
	*/

	session_start();

	include 'BaseDeDatos.php';

	if (!array_key_exists('userID', $_SESSION))
		header('Location: error.html');

	$isGuestName = array_key_exists ('guestName', $_GET);//Se comprueba que esten todos los datos necesarios para agregar/editar un invitado
	$isGuestSurname = array_key_exists ('guestSurname', $_GET);
	$isGuestMail = array_key_exists ('guestMail', $_GET);
	$isGuestTable = array_key_exists ('table', $_GET);
	$isGuestID = array_key_exists ('guestID', $_GET);

	$areThereAllRequiredValues = $isGuestID && $isGuestTable && $isGuestMail && $isGuestSurname && $isGuestName;

	if ($areThereAllRequiredValues){
		$newGuestName=$_GET['guestName'];
		$newGuestSurname=$_GET['guestSurname'];
		$newGuestMail=$_GET['guestMail'];
		$newGuestTable=$_GET['table'];
		$guestID=$_GET['guestID'];

		if(checkName($newGuestName) && checkName($newGuestSurname) && checkEmail($newGuestMail) && ( checkNumber($guestID) || $guestID == '' ) && checkNumber($newGuestTable) ){
			if ($guestID == '')
				addGuest($newGuestName,$newGuestSurname,$newGuestMail,$newGuestTable);
			else
				updateGuest($guestID,$newGuestName,$newGuestSurname,$newGuestMail,$newGuestTable);

			echo true;
		}
		else
			echo false;
	}

	else
		echo false;

?>