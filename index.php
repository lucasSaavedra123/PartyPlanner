<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>

	<head>
		<title>PartyPlanner</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<link rel='shortcut icon' href='img/icons/favicon.ico' type='image/ico' />
		<link rel='icon' href='img/icons/favicon.ico' type='image/ico' />
		<script src="js/index.js"></script>
		<script src="js/ajax.js"></script>

	</head>

	<body id="principalBody" onload="jumpTo('firstSection');backgroundChanger();" class="slider3">

		<div id="dotMenu">
			<a href="#firstSection"><div class="dot active" title="Registrate" onclick="asignUniqueActiveDot(this.id);jumpTo(this.href);" id="firstDot"></div><a>
			<a href="#secondSection"><div class="dot" title="Una fiesta mas" id="secondDot" onclick="asignUniqueActiveDot(this.id);jumpTo(this.href);"></div><a>
		</div>
		<!--El jumpTo de esta parte se uso para asegurarnos de que al hacer click se mueve
			Vimos que no siempre cambia (chan)-->

		<!--First Section-->
		<div class="section show" id="firstSection">

			
<!--Bienvenida-->
			<div class="formContainer inline-block center">
				<img class="logo" src="img/logotexto.png">

				<p class="whiteFont fontSize1 bold" id="headingText">Organizar una fiesta nunca fue tan facil</p>

				

<!--Login-->

				<form id="loginForm" class="hidden">
					<input id="username" type="email" name="username" placeholder="Correo Electronico"onkeydown="checkUsername();enableLogin('loginButton');">

					<input id="passwordLogin" type="password" name="passwordLogin" placeholder="Contraseña"onkeyup="checkPasswordLogin();enableLogin('loginButton');">

				</form>

				<button id="loginButton" class="hidden" onclick="processLogin();" disabled ><span class="buttonText">Iniciar Sesion</span></button>

				



<!--Registro-->
				<form id="registerForm" class="hidden">

					<input id="name" type="text" name="name" placeholder="Nombre" onkeydown="checkName();enableRegisterButton('register');">

					<input id="email" type="email" name="mail" placeholder="Correo Electronico" onkeyup="checkEmail();enableRegisterButton('register');">

					<input id="myPsw" type="password" name="password" placeholder="Contraseña" onkeyup="checkPassword();enableRegisterButton('register');">

					
				
				</form>

				<button id="register" class="hidden" disabled onclick="processRegister();"><span class="buttonText" >Registrarse</span></button>


<!--Invitado-->
				<form id="guestForm" class="hidden">

					<input id="guestCode" type="number" name="code" placeholder="Codigo de invitado" onkeyup="guestCodeCheck('guestCodeButton');">
				
				</form>

				<button id="guestCodeButton" class="hidden" onclick="processGuestCode();" disabled><span class="buttonText">Aceptar</span></button>

<!--Botonera-->
				<button id="startButton" class="blueBackground whiteFont button" onclick="register();"><span class="buttonText">Empezar</span></button>

				<button id="loginFormButton" class="whiteBackground blackFont button" onclick="login()"><span class="buttonText">Iniciar Sesion</span></button>

				<button id="guestButton" class="redBackground whiteFont button" onclick="guest()"><span class="buttonText">Soy Invitado</span></button>
			</div>

			



<!--Botonera alternativa-->
			<div id="alternativeButtons" class="floatRight">



				<button id=alternativeButtonRegister class="hidden" onclick="window.location.reload()"><span>Registrarse</span></button>




				<button id="alternativeButtonLogin" class="hidden" onclick="window.location.reload()"><span>Iniciar Sesion</span></button>
			</div>
				
			



			</div>
		


		</div>





		<!--Second Section-->
		<div class="section" id="secondSectionContainer">
			<p class="bold whiteFont" id="sectionTitle" onclick="asignUniqueActiveDot('secondDot');jumpTo('secondSection');">¿Que es PartyPlanner?</p>

			<div id="secondSection">
				
				<p class="bold whiteFont fontSize2 center headFirstSection" >¡LLEGO UNA NUEVA MANERA DE ORGANIZAR TU FIESTA!</p>
				<p class="whiteFont fontSize1 firstText justify interlineado" ><span class="bold">PartyPlanner</span> es la forma mas facil de organizar tu propia fiesta. En cuestion de minutos podes crearte una cuenta y asi organizar tu propio evento. Tus invitados recibiran un correo electronico con un codigo unico, con el cual podran actualizar el estado de su asistencia. De esta manera, podras visualizar de manera gráfica la asistencia de todos tus invitados de tu evento. Tambien, podras organizar la distribuicion de las mesas de la forma mas facil y ordenada. De esta formar PartyPlanner te ayuda a distribuir mejor la cantidad de invitados de tu fiesta.</p>

				<div class="imagen">
					<img class="mockup"src="img/Mockup.png">
				</div>

			</div>
		</div>


	</body>



</html>