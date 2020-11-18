<?php

	/*
	ARCHIVO PARA OBTENER LA LISTA CON LAS MESAS PARA PODER SELECCIONARLOS EN LAS PAGINA
	*/

	session_start();

	include 'BaseDeDatos.php';

	if (!array_key_exists('userID', $_SESSION) || !array_key_exists('eventID', $_SESSION))
		header('Location: error.html');

	if (array_key_exists('eventID', $_GET)){

		$eventID = $_GET['eventID'];
		$tablesInformationArray  = getTables($eventID);

		$arrayIndex = 0;

		for ($arrayIndex=0 ; $arrayIndex < sizeOf($tablesInformationArray) ; $arrayIndex++) { 
		
			$table = $tablesInformationArray[$arrayIndex];
			echo "
				<li class='height25 width100'>
					<input class='hidden' type='radio' name='table' id='table".$table['id']."' value=".$table['id'].">
					<label for='table".$table['id']."' class='width100 height100'><span>".$table['name']."</span></label>
				</li>";

		}
	}

	else
		echo "error";


?>