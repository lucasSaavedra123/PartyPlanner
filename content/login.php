<?php
/*
ARCHIVO PARA EL INICIO DE SESIÓN
*/

//Obtenemos las credenciales ingresadas por el usuario.
session_start();
$username=$_GET['username'];
$passwordNoHash=$_GET['passwordLogin'];

include 'BaseDeDatos.php';

//chequeamos que se este ingresando un e-mail
	if (checkEmail($username) && checkPassword($passwordNoHash)){	

			$password=hash('md5',$passwordNoHash);
			//Verificamos que exista un usuario que cumpla con esas credenciales. Si no, ALERT "error"
				if(userExists($username,$password)==TRUE){
						$user = getUserInfo($username,$password);
						$_SESSION['userID'] = $user['id'];
						$name=$user['name'];
						$_SESSION['sendName'] = $name;
						echo true;
					}else{
						echo false;
					}
	}else{
		echo "error";}


?>