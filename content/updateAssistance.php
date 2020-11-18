<?php
/*
ARCHIVO PARA ACTUALIZAR LA CONFIRMACIÓN
*/

session_start();

include 'BaseDeDatos.php';

//Obtenemos el guestCode que el ususario ingreso en el Index
$guestCode=$_SESSION['sendCode'];

//Obtenemos la rta que el usuario marco en el checkbox
$assitance=$_POST['myRadio'];

//Conectamos con la BD
$conn = conectarBD();

//Si el usuario marco como "confirmado". Se prepara la consulta SQL. Y se carga el mensaje de agradecimiento para luego hcaer un echo
if ($assitance=="confirmed") {

	$sql="UPDATE guests 
	SET confirmation = 1 
	WHERE code = '$guestCode'";

	$estado="Gracias por confirmar tu asistencia ¡Te esperamos!";

}

//Si el usuario marco como "Tal vez". Se prepara la consulta SQL. Y se carga el mensaje de agradecimiento para luego hcaer un echo
if ($assitance=="maybe") {
	$sql="UPDATE guests 
	SET confirmation = NULL
	WHERE code = '$guestCode'";

	$estado="Esperamos que puedas venir ¡Avisanos cuanto antes!";
}

//Si el usuario marco como "No Asistire". Se prepara la consulta SQL. Y se carga el mensaje de agradecimiento para luego hcaer un echo
if($assitance=="notConfirmed"){
	$sql="UPDATE guests 
	SET confirmation = 0 
	WHERE code = '$guestCode'";

	$estado="Lamentamos que no puedas asistir ¡Avisanos si cambias de opinion!";
}

//Se realiza la consulta SQL
	$result=mysqli_query($conn, $sql);


//Si la consulta fue exitosa se envia al usuario a la pagina siguiente. Si no se imprime un mensaje de "error"
if ($conn->query($sql) === TRUE) {
		echo '<!DOCTYPE html>

<html>

	<head>
		<title>¡Gracias! | PartyPlanner</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<link rel="icon" href="../img/icons/favicon.ico">
		

		<style type="text/css">

			#exitMessage{
				left: 12.5%;
				top:15%;
			}

			#exitMessage img{
				margin-top: 10%;
			}

			#uniqueButton{
				position: absolute;
				top:75%;
				left:37.5%;
				width: 25%;
				height: 50px;
				background-color: #36465D;
				box-shadow: 0px 0px 5px 0.8px black;
				border-radius: 10px;
			}

			#uniqueButton:hover{
				background-color: #282828;
				box-shadow: 0px 0px 10px 0.8px black;
				transition: all 1s;
			}

			#uniqueButton a{
				color: white;
				position: absolute;
  				top: 15px;
  				left: 0;
  				width: 100%;
  				height: 100%;
  				z-index: 10;
			}
		</style>
	</head>

	<body class="width100 height100">

		<div id="exitMessage" class="width75 height50 center">
			<span class="fontSize2">'. $estado .'</span>
			<br />
			<br />
			<img class="width50" src="../img/logotexto2.png">
		</div>

		<div id="uniqueButton" class="center bold">
		  	<a href="../index.php"class="height100 width100">VOLVER</a>
		</div>

	</body>';
	}
	else{
		echo "<script> alert('Se produjo un error y la informacion no ha podido ser cargada a nuestra base de datos. Por favor intentalo mas tarde.');window.location.href = '../index.php';</script>";
	}


//Desconectamos BD
desconectarBD($conn);


?>

