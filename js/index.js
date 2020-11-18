
//SALTO DE PAGINA//
function jumpTo(href){
	location.href="#"+href;
}

function asignUniqueActiveDot(id){

	var dot = document.getElementById(id);
	var listOfDots = document.getElementsByClassName("dot");

	for (var i = 0;i<listOfDots.length; i++)
		listOfDots[i].classList.remove('active');

	dot.classList.add('active');

}
//ACA TERMINA//





//BACKGROUND ALETORIO//
function backgroundChanger(){
	var img = ["slider0","slider1","slider2","slider3"];
	var body = document.getElementById("principalBody");

	var clase = img[Math.floor(Math.random() * (img.length))];

	body.classList = clase;

}
//ACA TERMINA//





//OCULTA LOS TRES BOTONES DE "EMPEZAR", "INICIAR SESION" Y
//"CODIGO DE INVITADO" PARA HACER APARECER EL FORMULARIO
//DE LOGIN JUNTO CON LA BOTONERA ALTERNATIVA Y EL BOTON DE 
//INICIAR SESION
function login (){
	var startButton = document.getElementById("startButton");
	startButton.classList = "hidden";

	var loginForm = document.getElementById("loginForm");
	loginForm.classList = "show";

	var loginFormButton = document.getElementById("loginFormButton");
	loginFormButton.classList = "hidden"

	var guestButton = document.getElementById("guestButton");
	guestButton.classList="hidden";

	var alternativeButtonRegister = document.getElementById("alternativeButtonRegister");
	alternativeButtonRegister.classList = "show";

	var loginButton = document.getElementById("loginButton");
	loginButton.classList = "disabled";

}
//ACA TERMINA//


//OCULTA LOS TRES BOTONES DE "EMPEZAR", "INICIAR SESION" Y
//"CODIGO DE INVITADO" PARA HACER APARECER EL FORMULARIO
//DE REGISTRO JUNTO CON LA BOTONERA ALTERNATIVA Y EL BOTON DE 
//REGISTRARSE
function register (){
	var loginFormButton = document.getElementById("loginFormButton");
	loginFormButton.classList = "hidden";

	var registerForm = document.getElementById("registerForm");
	registerForm.classList = "show";

	var startButton = document.getElementById("startButton");
	startButton.classList = "hidden";

	var alternativeButtonLogin = document.getElementById("alternativeButtonLogin");
	alternativeButtonLogin.classList = "show";

	var guestButton = document.getElementById("guestButton");
	guestButton.classList="hidden";

	var registerButton = document.getElementById("register");
	registerButton.classList="disabled";

}
//ACA TERMINA


//OCULTA LOS TRES BOTONES DE "EMPEZAR", "INICIAR SESION" Y
//"CODIGO DE INVITADO" PARA HACER APARECER EL FORMULARIO
//DE CODIGO DE INVITADO JUNTO CON LA BOTONERA ALTERNATIVA Y EL BOTON DE 
//ENVIAR
function guest (){
	var loginFormButton = document.getElementById("loginFormButton");
	loginFormButton.classList = "hidden";

	var startButton = document.getElementById("startButton");
	startButton.classList = "hidden";

	var alternativeButtonLogin = document.getElementById("alternativeButtonLogin");
	alternativeButtonLogin.classList = "showInLine";

	var alternativeButtonRegister = document.getElementById("alternativeButtonRegister");
	alternativeButtonRegister.classList = "showInLine";

	var loginFormButton = document.getElementById("loginFormButton");
	loginFormButton.classList = "hidden";

	var startButton = document.getElementById("startButton");
	startButton.classList = "hidden";

	var guestForm = document.getElementById("guestForm");
	guestForm.classList = "show";

	var guestButton = document.getElementById("guestButton");
	guestButton.classList = "hidden";

	var GuestCodeButton = document.getElementById("guestCodeButton");
	guestCodeButton.classList = "disabled"
	guestCodeButton.disabled= true

}
//ACA TERMINA

//ESTAS DOS FUNCIONES HABILITAN Y DESHABILITAN BOTONES
function buttonEnabler(id){
	var button = document.getElementById(id)
	button.classList = "blueBackground whiteFont button";
	button.disabled = false;
}

function buttonDisabler(id){
	var button = document.getElementById(id)
	button.classList = "disabled";
	button.disabled = true;
}
//ACA TERMINA

//CHEQUEOS DE LOGIN
function checkUsername(){
	var username = document.getElementById("username");
	var password = document.getElementById("passwordLogin");

	var validador = /\S+@\S+\.\S+/;

	if (validador.test(username.value)==false) {
		password.classList="";
	}
	else{
		username.classList="";
		return true;
	}
}

function checkPasswordLogin(){

	var password = document.getElementById("passwordLogin");

	if(password.value.length<1){
	password.classList="";}
	else{
		password.classList="";
		return true;
	};

}

function enableLogin(id){


	if (checkPasswordLogin() && checkUsername() ){
		buttonEnabler(id)
	}else{
		buttonDisabler(id);
	}
}






//CHEQUEOS DE REGISTRO
function checkEmail(){
	var email = document.getElementById("email");

	var validador = /\S+@\S+\.\S+/;

	if (validador.test(email.value)==false) {
	}
	else{
		email.classList="";
		return true;
	}
}


function checkName(){
	var name = document.getElementById("name");

	if (name.value == ""){
	}
	else{
		name.classList="";
		return true;
	}
}

function checkPassword(){

	var password = document.getElementById("myPsw");

	var validador = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

	if (validador.test(password.value)==false) {
	}
	else{
		password.classList="";
		return true;
	}

}


function enableRegisterButton(id){
	if (checkPassword() && checkName() && checkEmail()){
		buttonEnabler(id)
	}else{
		buttonDisabler(id);
	}
}

//ACA TERMINA

//CHEQUEO DE CODIGO DE INVITADO
function guestCodeCheck(id){
	var guestCode = document.getElementById("guestCode");

	if(guestCode.value.length>1){
		buttonEnabler(id)
	}else{
		buttonDisabler(id)
	}
}
//ACA TERMINA

function enableLoginButton(id){

	var loginButton = document.getElementById("login");

	if (checkPassword() && checkEmail()){
		buttonEnabler(id)
	}else{
		buttonDisabler(id);
	}
}



