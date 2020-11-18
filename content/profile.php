<?php 

	/*
	PAGINA DEL PERFIL DEL USUARIO
	*/
	
	session_start();

	if (array_key_exists('userID', $_SESSION))
		$userID = $_SESSION['userID'];
	else
		header('Location: error.html');

	include 'BaseDeDatos.php';
	$events = getEventsByUserID($userID);
	$guestsQuantities = array();
	$guestsConfirmatedQuantities = array();

	/*Obtenemos la cantidad de invitados y los que ya confirmaron*/
	for ($arrayIndex=0; $arrayIndex < sizeOf($events) ; $arrayIndex++){
		$eventID = $events[$arrayIndex]['id'];
		$guests = getGuests($eventID);
		$guestsQuantities[$eventID] = sizeof($guests);
		$guestsConfirmatedQuantities[$eventID] = getGuestsQuantities($guests)[1];
	}

 ?>



<!DOCTYPE html>

<html>

	<head>

		<title>Menu | PartyPlanner</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<link rel="shortcut icon" href="../img/icons/favicon.ico" type="image/ico" />
		<link rel="icon" href="../img/icons/favicon.ico" type="image/ico" />
		<script src="../js/ajax.js"></script> 
	</head>

	<body class="whiteBackground enableScroll">
		<div id="verticalMenu" class="darkestBlueBackground">
			<div id="logo"><img class="" src="../img/whiteLogoMenu.png" /></div>
			<div class="item active"><div><img class="icon" src="../img/icons/information.png" /></div></div>
			<div id="" class="item" onclick="location.href='..'"><div><img class="icon" src="../img/icons/return.png" /></div></div>
		</div>

		<div id ="eventWindow" class="enableScroll">

			<!--Contiene los datos del evento y se puede seleccionar para ir hacia el mismo evento-->


		<?php
		for ($arrayIndex=0; $arrayIndex < sizeOf($events) ; $arrayIndex++) {

			$disableText = '';
			$buttonText = 'Ver evento';
			$buttonClassToWrite = 'blueBackground whiteFont button';

			$guestsQuantity = $guestsQuantities[$events[$arrayIndex]['id']];//Cantidad de invitados del evento

			//Verificamos que el porcentaje salga de una division con solucion
			if ($guestsQuantities[$events[$arrayIndex]['id']] == 0) {
				$confirmatedGuestsPercentage = 0;
			}
			else{
				$confirmatedGuestsPercentage = floor($guestsConfirmatedQuantities[$events[$arrayIndex]['id']]/$guestsQuantities[$events[$arrayIndex]['id']]*100);//Se redonde el numero del porcentaje de los invitados que confirmaron
			}


		?>

		<div id="delete<?php echo $events[$arrayIndex]['id']; ?>" class="eventsBox center white2Background addShadowHover">

			<h2 class='ventTitle center'><?php echo $events[$arrayIndex]['name']?></h2>

			<span class='eventInfo center bold'>Cantidad de Invitados: <?php echo $guestsQuantity;?></span>
			<span class='eventInfo center bold'>Invitados Confirmados:</span>

			<div class='width100 progress'>
				<span class='bold overlay'><?php echo $confirmatedGuestsPercentage; ?>%</span>
				 <div class='progressBar greenBackground' style="width: <?php echo $confirmatedGuestsPercentage ?>%"></div>
			</div>

				<span class='eventInfo center bold'>

				<?php 

				$eventDate = $events[$arrayIndex]['date'];
				$eventHorary =  substr($events[$arrayIndex]['horary'], 0,5);
				$difference = getDifferenceOfDate($eventDate, $eventHorary); 

				if ($difference <= 0){
					echo "Ya paso. Esperemos que haya sido una gran fiesta";
					$disableText = 'disabled';
					$buttonText = 'No Disponible';
					$buttonClassToWrite = 'greyBackground blackFont';
				}
				else if ($difference <= 1)
					echo "Es Hoy. ¡Que sea una gran fiesta!";
				else{

					$differenceInYears = round($difference / 365);

					if ($differenceInYears == 0)
						echo "Dias para la fiesta: ".round($difference);
					else if ($differenceInYears == 1)
						echo "Falta 1 año";
					else
						echo "Faltan ".$differenceInYears." años";

				}

				 ?>


				</span>

				<button class="seeEventButton blueBackground whiteFont <?php echo $buttonClassToWrite; ?> width25 height10" onclick="location.href='event.php?eventID=<?php echo $events[$arrayIndex]['id']; ?> '" <?php echo $disableText; ?>><span class="buttonText"><?php echo $buttonText; ?></span></button>

				<button class="deleteEventButton redBackground whiteFont button width25 height10"  onclick="deleteEvent('<?php echo $events[$arrayIndex]['id']; ?>');" ><span class="buttonText">Eliminar</span></button>
		</div>


		<?php
		}
		?>

			<div class='eventsBox center white2Background animatedBackground addShadowHover'>
						<a class='width100 height100 transparentBlackBackground' href='createEvent.php'><img src='../img/logotextocreator.png' class='width100'></a>
			</div>

			<div>


	</body>



</html>