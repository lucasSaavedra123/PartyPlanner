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

		$tablesInformationArray  = getTables($eventID);
		$guestsInformationArray = getGuests($eventID);
		$guestsByAlphabeticalOrder = orderByAlphabeticalOrder($guestsInformationArray);
		$guestsByTableOrder = orderGuestsByTable($guestsInformationArray,$tablesInformationArray);
		$tablesNamesList = array_keys($guestsByTableOrder);

		$arrayIndex = 0;
		$arrayIndex2 = 0;

		$imgHTMLCode = '';

		$alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		for ($arrayIndex=0; $arrayIndex < sizeOf($tablesInformationArray); $arrayIndex++) {
			$table = $tablesInformationArray[$arrayIndex];
			$tableName = $table['name'];

			echo 	"<tr class='darkBlueBackground whiteFont separator'>
					 	<td colspan='4' class='bold'>".$tableName."

							<img src='../img/icons/deleteWhite.png' class='optionIcon pointer floatRight' title='Eliminar' onclick=\"deleteTable('".$table['id']."')\"/>

							<img src='../img/icons/editWhite.png' class='optionIcon pointer floatRight' title='Editar' onclick=\"showTableAdder('".$table['id']."','".$tableName."');\"/>

						</td>
					</tr>";


			if (sizeOf($guestsByTableOrder[$tableName]) == 0) {
				echo 	"<tr class='whiteBackground blackFont separator center'>
							<td colspan='4' class='bold'>No hay invitados en esta mesa</td>
						</tr>";
			}
			else{
				for ($arrayIndex2=0; $arrayIndex2 < sizeOf($guestsByTableOrder[$tableName]) ; $arrayIndex2++) {
					$guest = $guestsByTableOrder[$tableName][$arrayIndex2];

					if ($guest['confirmation'] === '1')
						$imgHTMLCode = '<img src="../img/icons/check.png" />';
					else if ($guest['confirmation'] === '0')
						$imgHTMLCode = '<img src="../img/icons/cancel.png" />';
					else
						$imgHTMLCode = "-";

					echo 	"<tr>
								<td class='bold'>".$guest['guestSurname']."</td>
								<td>".$guest['guestName']."</td>
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