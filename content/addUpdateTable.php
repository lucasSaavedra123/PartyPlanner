<?php

	/*
	ARCHIVO PARA AGREGAR/EDITAR UNA MESA
	*/

	session_start();

	include 'BaseDeDatos.php';

	if (!array_key_exists('userID', $_SESSION)){
		header('Location: error.html');
	}

	$isEventID = array_key_exists('eventID', $_GET);//Se comprueba que esten todos los datos necesarios para agregar/editar una mesa
	$isNewTableName = array_key_exists('newTableName', $_GET);
	$isTableID = array_key_exists('tableID', $_GET);

	if ($isNewTableName && $isEventID && $isTableID ){

		$tableName = $_GET['newTableName'];
		$eventID = $_GET['eventID'];
		$tableID = $_GET['tableID'];

		if ($tableID == '') {
			//Si no se pasa el ID de mesa, entonces es para agregar.
			if(checkName($tableName)){
				if (checkTableName($eventID,$tableName)) {
					addTable($eventID,$tableName);
					echo 'successfull';//Agregado realizado con éxito
				}
				else
					echo 'error1';//Ya existe mesa con ese nombre
			}
			else
				echo 'error2';//Error del servidor
		}	

		else if ($tableID != '') {
			if(checkName($tableName)){

				if(checkTableName($eventID,$tableName)){
					updateTable($tableID,$tableName);
					echo 'successfull'; //Edicion realizada con éxito
				}
				else
					echo 'error1';
			}
			else
				echo 'error2';
		}

		else
			echo 'error2';
	}

	else
		echo "error2";
?>