<?php

	/*
		ARCHIVO DONDE SE ENCUENTRA LA PAGINA PARA LA CREACION DE UN EVENTO
	*/

	session_start();
?>

<!DOCTYPE html>

<html>

	<head>

		<title>Creacion de Evento | PartyPlanner</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<link rel="shortcut icon" href="../img/icons/favicon.ico" type="image/ico" />
		<link rel="icon" href="../img/icons/favicon.ico" type="image/ico" />
		<script src="../js/event.js"></script>
		<script src="../js/validaciones.js"></script>  

	</head>

	<body class="center inlineblock animatedBackground" onload="resetForm('createEventForm');">



			<div id="eventCreator" class="transparentBlackBackground">

				<div id="notificationBox" class="hidden width75 height15">
						<img class="" src="../img/icons/error64.png" id="errorIcon" />

						<span class="bold whiteFont center" id="notificationText">
						</span>
				</div>

				<div id="w0" class="whiteFont fontSize2 show window block">
					<span class="heading">Bienvenido al creador de eventos<br />de <span class="bold">PartyPlanner</span><br />
					¡Hace click en Siguiente y empieza ya!</span>

					<img id="logo" src="../img/logotextocreator.png">
				</div>

				<form id="createEventForm" method="POST" action="addEventNotification.php">

					<!--Ventana 1: Nombre de la fiesta-->
					<div id="w1" class="whiteFont hidden block window"> 

						<span class="heading fontSize2">Ponle nombre a tu <span class="bold">fiesta</span></span>

						<input type="text" class="transparentBlackBackground2 whiteFont fontSize2" id="eventNameInput" name="eventName" placeholder="Ingrese el nombre aca..." />		
					</div>

					<!--Ventana 2: Fecha y Hora de la fiesta-->
					<div id="w2" class="heading whiteFont hidden block window"> 

						<span class="fontSize2">Pon <span class="bold">hora</span> y <span class="bold">fecha</span></span>

						<input type="date" class="transparentBlackBackground2 whiteFont fontSize2" id="eventDateInput" name="eventDate" />
						<input type="time" class="transparentBlackBackground2 whiteFont fontSize2" id="eventHourInput" name="eventHour" />
					</div>

					<!--Ventana 3: Direccion de la fiesta-->
					<div id="w3" class="whiteFont hidden block window"> 

						<span class="fontSize2 infront heading">Pon <span class="bold">Lugar</span></span>

						<input type="text" class="transparentBlackBackground2 whiteFont fontSize2" id="eventAddressInput" name="eventAddress" placeholder="Ingrese direccion de la fiesta aca..." />
					</div>

					<!--Ventana 4: Confirmacion-->
					<div id="w4" class="whiteFont hidden block window"> 
						<span class="fontSize2 heading">

							Corrobora que toda la informacion ingresada este bien<br>
							y <span class="bold">que arranque la fiesta</span><br>

						</span>

						<span class="fontSize1"><br>Esta informacion va a poder se modificada mas adelante</span>

						<table class="fontSize2 center">
							<tr>
								<td class="bold">Nombre: </td>
								<td id="nameData"></td>
							</tr>

							<tr>
								<td class="bold">Fecha: </td>
								<td id="dateData"></td>
							</tr>

							<tr>
								<td class="bold">Horario: </td>
								<td id="hourData"></td>
							</tr>

							<tr>
								<td class="bold">Direccion: </td>
								<td id="addressData"></td>
							</tr>
						</table>

						<button id="addEventButton" class="whiteBackground blackFont button" type="submit" disabled><span class="buttonText">Crear Evento</span></button>
					</div>

				</form>

				<button id="backProfileButton" class="redBackground whiteFont button lowestPartPosition" onclick="window.location.href='profile.php'">
					<span class="buttonText">Volver</span>
				</button>

				<button id="backButton" class="whiteBackground blackFont button lowestPartPosition" onclick="event.preventDefault();hideErrorNotification('notificationBox');moveBackward();">
					<span class="buttonText">Atras</span>
				</button>
				
				<button id="nextButton" class="whiteBackground blackFont button lowestPartPosition" onclick="event.preventDefault();validateEventCreator();">
					<span class="buttonText">Siguiente</span>
				</button>
			
			</div>

	</body>



</html>