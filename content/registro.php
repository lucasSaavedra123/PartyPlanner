<?php

//Obtenemos los datos ingresados por el usuario
$name=$_GET['name'];
$username=$_GET['mail'];
$passwordNoHash=$_GET['password'];

include 'BaseDeDatos.php';

if (checkEmail($username)&&checkPassword($passwordNoHash)&&checkName($name)){

					$password=hash('md5',$passwordNoHash);

				//Verificamos que no exista un usuario con el mismo username. Si no, ALERT "e-mail repetido"
					if(usernameExists($username)==TRUE){
						echo false;
							}
					else{

							if (registerUser($name,$username,$password) == TRUE) {
				    		echo true;
							}
								}
		}else{
			echo "error";}
?>