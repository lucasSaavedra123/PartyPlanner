<!DOCTYPE html>
<?php

	/*PAGINA PRINCIPAL DEL EVENTO*/

	session_start();

	include 'BaseDeDatos.php';


	if (array_key_exists('eventID', $_GET)){
		$_SESSION['eventID']=$_GET['eventID'];

		if ($_SESSION['eventID']=='')
			header('Location: error.html');
	}

	$eventID = $_SESSION['eventID'];

	if (!array_key_exists('userID', $_SESSION))
		header('Location: error.html');

?>

<html>

	<head>
		<title>Evento | PartyPlanner</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
		<link rel="shortcut icon" href="../img/icons/favicon.ico" type="image/ico" />
		<link rel="icon" href="../img/icons/favicon.ico" type="image/ico" />
		<script src="../js/validaciones.js"></script> 
		<script src="../js/event.js"></script>
		<script src="../js/ajax.js"></script>
	</head>

	<body onload='updateTables("<?php echo $eventID; ?>");'>

		<!--Ventana de ediciones-->
		<div class="transparentBlackBackground width100 height100 overlay absolute hidden center" id="changerData">
			<div class="width50 height25 whiteBackground editBox shadowBox1 center">

				<div class="width100 center" id="editBoxTitleDiv">
					<span class="bold" id="editBoxTitle"></span>
				</div>

				<input class="transparent height25 width75" id="changerDataInput" type="" name="" placeholder="" />

				<button type="button" id="cancelButton" onclick="hideChangerData();" class="redBackground whiteFont button">
					<span class="buttonText">Cancelar</span>
				</button>

				<button type="button" id="changeButton" class="blueBackground whiteFont button" onclick="event.preventDefault();validateNewData('<?php echo $eventID; ?>');">
					<span class="buttonText">Cambiar</span>
				</button>
			</div>

			<div id="editBoxNotification" class="width50 height25 hidden">
				<img class="" src="../img/icons/error64.png" id="errorIcon" />
				<span class="bold whiteFont width75 center" id="notificationText"></span>
			</div>
		</div>

		<!--Ventana de agregado de mesas-->
		<div class="transparentBlackBackground width100 height100 overlay absolute hidden" id="tableAdder">
				
			<div class="width50 height25 whiteBackground editBox shadowBox1 center">

				<div class="width100 center" id="editBoxTitleDiv">
					<span class="bold" id="editBoxTitle">Agregar Mesa</span>
				</div>

				<input class="transparent height25 width75" id="tableNameInput" type="text" name="" placeholder="Ingrese nombre de la nueva mesa..." />

				<button id="cancelButton" onclick="event.preventDefault();hideTableAdder();" class="redBackground whiteFont button">
					<span class="buttonText">Cancelar</span>
				</button>

				<button id="changeButton" class="blueBackground whiteFont button" onclick="event.preventDefault();validateTableName();">
					<span class="buttonText">Agregar</span>
				</button>

			</div>
		</div>

		<!--Ventana de agregado de invitados-->
		<div class="transparentBlackBackground width100 height100 overlay absolute hidden" id="guestAdder">

			<div class="width50 height75 whiteBackground addBox shadowBox1 center">

				 <span class="bold" id="addBoxTitle">Agregar/Editar invitado</span>

				<form method="" action="">

					<div class="inputsBox width100 height75">

						<div class="inputDiv width100 height10">
							<label class="height100 width50 floatLeft"><span class="labelText bold floatLeft">Nombre</span><span class="labelTextNotification floatRight redFont" id="notification1"></span></label>
							<input class="height100 width35" type="text" name="" id="nameInput" />
						</div>

						<div class="inputDiv width100 height10">
							<label class="height100 width50 floatLeft"><span class="labelText bold floatLeft">Apellido</span><span class="labelTextNotification floatRight redFont" id="notification2"></span></label>
							<input class="height100 width35" type="text" name="" id="surnameInput"/>
						</div>
						
						<div class="inputDiv width100 height10">
							<label class="height100 width50 floatLeft"><span class="labelText bold floatLeft">Mail</span><span class="labelTextNotification floatRight redFont" id="notification3"></span></label>
							<input class="height100 width35" type="text" name="" id="mailInput"/>
						</div>
						
						<div class="inputDiv width100 height75">
							<label class="width50"><span class="bold">Mesa</span></label>

							<div class="enableScrollOnY tableList width75 height50 bold" id="tablesList">

								<ul class="inlineblock height100 width100">

								</ul>

							</div>

						</div>

					</div>

					<button id="cancelAddButton" onclick="event.preventDefault();hideGuestAdder();" class="redBackground whiteFont button width50
					height10">
					<span class="buttonText">Cancelar</span>
					</button>

					<button id="addButton" class="greenBackground whiteFont button width50
					height10" onclick="event.preventDefault();validGuestData();">
						<span class="buttonText">Agregar</span>
					</button>
				</form>

			</div>
		</div>

		<!--Menu vertical-->
		<div id="verticalMenu" class="darkestBlueBackground">

			<div id="logo"><img class="" src="../img/whiteLogoMenu.png" /></div>

			<div class="item active" id="informationButton" onclick="onlyShowDiv('information');asignUniqueActiveItem(this.id);">
				<div>
					<img class="icon" src="../img/icons/information.png" />
				</div>
			</div>
			
			<div class="item" id="guestsButton" onclick="onlyShowDiv('guests');asignUniqueActiveItem(this.id);">
				<div>
					<img class="icon" src="../img/icons/guests.png" />
				</div>
			</div>


			<div class="item" id="tablesButton" onclick="onlyShowDiv('tables');asignUniqueActiveItem(this.id);">
				<div>
					<img class="icon" src="../img/icons/table.png" />
				</div>
			</div>

			<div id="" class="item" onclick=";window.location.href = 'profile.php'">
				<div>
					<img class="icon" src="../img/icons/return.png" />
				</div>
			</div>
		</div>

		<!--Ventanas-->
		<div id ="eventWindow" class="enableScroll">

			<div class="whiteBackground center blackFont show window width100 height100" id="information">

				<table class="table2 autoMargin">
				</table>
				
			</div>

			<div class="hidden window" id="guests">

				<table class="fontSize1 table1">

					<thead>
						<th>Apellido</th>
						<th>Nombre</th>
						<th>Mail</th>
						<th>Mesa</th>
						<th>Asistencia</th>
						<th>Opciones</th>
					</thead>

					<tbody>
					</tbody>

					<tr colspan='7'></tr>

					<tfoot>					
					</tfoot>

				</table>

				<div id="horizontalMenu" class="whiteBackground center inlineblock lowestPartPosition">
					<div class="item bold pointer" onclick="showGuestAdder();">
						<span class="">Agregar invitado</span>
						<img class="" src="../img/icons/add.png" />
					</div>
				</div>
			</div>


			<div class="hidden window" id="tables">
				<table class="fontSize1 table1">

					<thead>
						<th>Apellido</th>
						<th>Nombre</th>
						<th>Asistencia</th>
						<th>Opciones</th>
					</thead>

					<tbody>
					</tbody>

					<tfoot>					
					</tfoot>
					
					<tr colspan='7'></tr>
					
				</table>

				<div id="horizontalMenu" class="whiteBackground center inlineblock lowestPartPosition">
					<div class="item bold pointer" onclick="showTableAdder();">
						<span class="">Agregar Mesa</span>
						<img class="" src="../img/icons/add.png" />
					</div>
				</div>

			</div>
		</div>

	</body>

</html>