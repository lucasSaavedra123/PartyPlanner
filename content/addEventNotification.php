
<?php

	/*
	ARCHIVO PARA EL AGREGADO DE EVENTOS
	*/

	session_start();

	include 'BaseDeDatos.php';

	$hasLogIn = array_key_exists('userID',$_SESSION);//Se comprueba que se haya iniciado sesion
	$isEventName = array_key_exists('eventName',$_POST);//Se comprueba que esten todos los datos necesarios para agregar el evento
	$isEventAddress = array_key_exists('eventAddress',$_POST);
	$isEventDate = array_key_exists('eventDate',$_POST);
	$isEventHour = array_key_exists('eventHour',$_POST);

	$text = '';//Se guarda el texto que se mva a mostrar en la pagina

	if (!$hasLogIn)
		header('Location: error.html');

	else if ($isEventName && $isEventAddress && $isEventDate && $isEventHour){
			$userID = $_SESSION['userID'];
			$eventName = $_POST['eventName'];
			$eventAddress = $_POST['eventAddress'];
			$eventDate = $_POST['eventDate'];
			$eventHour = $_POST['eventHour'];


			if(checkName($eventName) && checkDate2($eventDate,$eventHour) && checkAddress($eventAddress)){
				addEvent($userID,$eventName,$eventAddress,$eventDate,$eventHour);
				$text = '¡Creaste un evento!';
			}
			else
				$text = 'Error. Intentelo de nuevo.';
		}

	else
		$text = 'Error. Intentelo de nuevo';

?>

<!DOCTYPE html>

<html>

	<head>
		<title>Creacion de eventos | PartyPlanner</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../img/icons/favicon.ico" type="image/ico" />
		<link rel="icon" href="../img/icons/favicon.ico" type="image/ico" />
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	</head>

	<body class="width100 height100">

		<div id="exitMessage" class="width75 height50 center">
			<span class="fontSize2"><?php echo $text; //Se proyecta el texto?></span><br>
			<img class="width50" src="../img/logotexto2.png">
		</div>

		<div id="uniqueButton" class="center bold">
		  	<a class="" href="profile.php">VOLVER</a>
		</div>

	</body>



</html>