<?php

	/*
	ARCHIVO PARA OBTENER LA LISTA CON LOS INVITADOS POR ORDEN ALFABETICO
	*/

	session_start();

	include 'BaseDeDatos.php';

	if (!array_key_exists('userID', $_SESSION) || !array_key_exists('eventID', $_SESSION))
		header('Location: error.html');

	if (array_key_exists('eventID', $_GET)){

		$eventID = $_GET['eventID'];

		$tablesInformationArray  = getTables($eventID);
		$guestsInformationArray = getGuests($eventID);
		$guestsByAlphabeticalOrder = orderByAlphabeticalOrder($guestsInformationArray);
		$guestsByTableOrder = orderGuestsByTable($guestsInformationArray,$tablesInformationArray);

		$arrayIndex = 0;
		$arrayIndex2 = 0;

		$imgHTMLCode = '';

		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		for ($arrayIndex=0; $arrayIndex < strlen($alphabet) ; $arrayIndex++) {

			$letter = $alphabet[$arrayIndex];

			if (sizeOf($guestsByAlphabeticalOrder[$letter]) > 0) {
				
			echo "
					<tr class='darkBlueBackground whiteFont separator'>
					<td colspan='7' class='bold'>".$letter."</td>
					</tr>
				";

			for ($arrayIndex2=0; $arrayIndex2 < sizeOf($guestsByAlphabeticalOrder[$letter]) ; $arrayIndex2++) { 
				$guest = $guestsByAlphabeticalOrder[$letter][$arrayIndex2];

				if ($guest['confirmation'] === '1')
					$imgHTMLCode = '<img src="../img/icons/check.png" />';
				else if ($guest['confirmation'] === '0')
					$imgHTMLCode = '<img src="../img/icons/cancel.png" />';
				else
					$imgHTMLCode = "-";

				echo 	"<tr>
							<td class='bold'>".$guest['guestSurname']."</td>
							<td>".$guest['guestName']."</td>
							<td class='center'>".$guest['mail']."</td>
							<td class='center bold'>".$guest['tableName']."</td>
							<td class='center'>".$imgHTMLCode."</td>

							<td class='center inlineblock'>
								<img src='../img/icons/send.png' class='optionIcon pointer' title='Enviar' onclick=\"sendRequest('mailFunctions.php?guestID=".$guest['id']."', showSendMailAlert);\" />

								<img src='../img/icons/edit.png' class='optionIcon pointer' title='Editar' onclick=\"showGuestAdder('".$guest['guestName']."','".$guest['guestSurname']."','".$guest['mail']."','".$guest['id']."','".$guest['tableID']."');\"/>

								<img src='../img/icons/delete.png' class='optionIcon pointer' title='Eliminar' onclick=\"deleteGuest('".$guest['id']."')\" />
							</td>
						</tr>";

			}
		}
	} 
	}

	else
		echo "error";

?>