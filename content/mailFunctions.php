<?php

	/*
	ARCHIVO PARA MANDAR MAIL
	*/

	session_start();

	include 'BaseDeDatos.php';

	if (!array_key_exists('userID', $_SESSION))
		header('Location: error.html');


	$guest = getGuest($_GET['guestID']);

	/*Preparamos para mandar mail al invitado*/
	/*Cargamos la forma del mail a enviar*/

	$content = "
		<img src='http://i65.tinypic.com/n46vr9.jpg' alt='logotexto2' border='0' /><br>
		<span>Fuiste Invitado a una fiesta</span><br>
		<span>Tu codigo es: ".$guest['code']." </span><br>
		<span>Ingresa el codigo en la pagina</span><br>
		<a href='http://tornati.com'>Ir a PartyPlanner</a>
	";
    
	$subject = 'PartyPlanner | Invitacion';

	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';
        
	// Additional headers
	$headers[] = 'To: '.$userName.'<'.$userMail.'>';
	$headers[] = 'From: PartyPlanner STAFF <tornati1@cloud1.shservers.com>';
        
	mail($guest['mail'] , $subject , $content, implode("\r\n", $headers));
?>