<?php 

/*
ARCHIVO PARA VERIFICAR EL CODIGO DEL INVITADO	
*/

session_start();
//Obtenemos el codigo ingresado por el usuario
$guestCode=$_GET['code'];


//Utilizamos esta funcion para luego cargar la rta ingresada en la BD
$_SESSION['sendCode'] = $guestCode; 

include 'BaseDeDatos.php';

if(checkGuestCode($guestCode)){



			//Si no hay nada en la BD que cumpla con ese codigo de invotado ALERT "ingrese otro codigo". Si no lo enviamos a la siguiente pantalla.
			if(guestExists($guestCode)==FALSE){
					echo false;
						}
				else{

					echo true;

			}
	}else{
		echo "error";
	}

?>