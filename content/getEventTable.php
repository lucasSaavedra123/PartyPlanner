<?php

	/*
	ARCHIVO PARA OBTENER LA LISTA DE LOS INVITADOS POR MESA
	*/

	session_start();

	include 'BaseDeDatos.php';

	if (!array_key_exists('userID', $_SESSION) || !array_key_exists('eventID', $_SESSION))
		header('Location: error.html');

	if (array_key_exists('eventID', $_GET)){

		$eventID = $_GET['eventID'];

		$eventInformationArray = getEvent($eventID);

		if ($_SESSION['eventID'] != $eventID) 
			header('Location: error.html');
		else if($eventInformationArray['id_user'] != $_SESSION['userID'])//Verificamos que el usuario del evento coincida con el usuario que inicio sesion
			header('Location: error.html');


		else{

			$eventInformationArray = getEvent($eventID);
			$guestsInformationArray = getGuests($eventID);
			$guestsQuantity = sizeOf($guestsInformationArray);
			$userInformationArray = getUser($_SESSION['userID']);
			$arrayIndex = 0;
			$confirmatedGuestsQuantity=0;
			$deniedGuestsQuantity=0;
			$noConfirmationGuestsQuantity=0;

			//Obtenemos la cantidad de invitados que van a la fiesta y los que no
			for ($arrayIndex=0; $arrayIndex < $guestsQuantity ; $arrayIndex++) { 
				$confirmation = $guestsInformationArray[$arrayIndex]['confirmation'];

				if ($confirmation === '0')
					$deniedGuestsQuantity++;
				elseif ($confirmation === '1')
					$confirmatedGuestsQuantity++;
				else
					$noConfirmationGuestsQuantity++;
			}

			echo "
					<tr>
						<td class='bold'>Nombre: </td>
						<td id='eventName'><span>".$eventInformationArray['name']."</span><img class='marginLeft10 optionIcon floatRight marginRight2' src='../img/icons/edit.png' onclick=\"showChangerData('eventName','Nuevo nombre del evento');\"/>
						</td>
					</tr>
					<tr>
						<td class='bold'>Fecha: </td>
						<td id='eventDate'><span>".$eventInformationArray['date']."</span><img class='floatRight marginRight2 optionIcon' onclick=\"showChangerData('eventDate','Nuevo fecha para el evento');\" src='../img/icons/edit.png' /></td>
					</tr>
					<tr>
						<td class='bold'>Hora: </td>
						<td id='eventTime'><span>".substr($eventInformationArray['horary'], 0,5)."</span><img class='floatRight marginRight2 optionIcon' src='../img/icons/edit.png' onclick=\"showChangerData('eventTime','Nuevo horario para el evento');\"/></td>
					</tr>
					<tr>
						<td class='bold'>Ubicacion: </td>
						<td id='eventAddress'><span>".$eventInformationArray['address']."</span><img class='floatRight marginRight2 optionIcon' src='../img/icons/edit.png' onclick=\"showChangerData('eventAddress','Nueva direccion para el evento');\" /></td>
					</tr>				
					<tr>
						<td class='bold'>Organizador: </td>
						<td>".$userInformationArray['name']."</td>
					</tr>
					<tr>
						<td class='bold'>Invitados</td>
						<td>".$guestsQuantity."</td>
					</tr>
					<tr>
						<td class='bold'>Invitados que van</td>
						<td>".$confirmatedGuestsQuantity."</td>
					</tr>
					<tr>
						<td class='bold'>Invitados que no van</td>
						<td>".$deniedGuestsQuantity."</td>
					</tr>
					<tr>
						<td class='bold'>Invitados que no confirmaron</td>
						<td>".$noConfirmationGuestsQuantity."</td>
					</tr>
					";

	
		}


	}

	else
		header('error');

?>
