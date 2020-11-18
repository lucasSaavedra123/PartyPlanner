<?php 

/*
ARCHIVO PARA LA CONFIRMACION
*/

session_start();
include 'BaseDeDatos.php';

//Obtenemos el guestCode que el ususario ingreso en el Index
$guestCode=$_SESSION['sendCode'];

$event = getEventInfo($guestCode);

echo "<!DOCTYPE html>

			<html>
			<head>
				<style>
				@import url('https://fonts.googleapis.com/css?family=Open+Sans');
				</style>

				<link rel='stylesheet' type='text/css' href='../css/estilos.css'>
				<link rel='shortcut icon' href='../img/icons/favicon.ico' type='image/ico' />
				<link rel='icon' href='../img/icons/favicon.ico' type='image/ico' />
				<script src='../js/confirmacion.js' type='text/javascript'></script>
			</head>
			<title>Elegir asistencia | PartyPlanner</title>
			<body class='guestConfirmationPage'>
				<div class='main'>

					<div class='partyInfo'>

					<h2>Fuiste invitado a </h2>
					<h3>$event[eventName]</h3>

					
					<span>$event[eventAddress]</span>
					<span>$event[eventTime]</span>
					<span>$event[eventDate]</span>

					</div>

					<div class='confirmacion'>

						<form id='confirmationForm' action='updateAssistance.php' method='post'>
				<div class='confirmationButton'>
					<input type='radio' id='confirmed' name='myRadio' value='confirmed' onclick='enableButton();' />
					<label for='confirmed'>
						<img class='buttonIcon' src='../img/icons/iconfinder_Checkmark_1891021.png' />
					</label>

					<span class='bold center'>Asistiré 😃</span>

					<div class='barraMovil greenBackground'>
					</div>


				</div>

				<div class='confirmationButton'>
					<input type='radio' id='maybe' name='myRadio' value='maybe' onclick='enableButton()'/>
					<label for='maybe'>
						<img class='buttonIcon' src='../img/icons/iconfinder_questionssvg_1579793.png' />
					</label>

					<span class='bold center'>Trata de confirmar lo antes posible 🤔</span>

					<div class='barraMovil orangeBackground'>
					</div>
				</div>

				<div class='confirmationButton'>
					<input type='radio' id='notConfirmed' name='myRadio' value='notConfirmed' onclick='enableButton();' />
					<label for='notConfirmed'>
						<img class='buttonIcon' src='../img/icons/iconfinder_error_1646012.png' />
					</label>

					<span class='bold center'>No asistiré 😞</span>

					<div class='barraMovil red2Background'>
					</div>
				</div>

						</form>


					
					<button id='send' class='disabled'  disabled action='submit' form='confirmationForm'><span class='buttonText'>Enviar</span></button>
					</div>

				</div>

			</body>
			</html>"
?>
