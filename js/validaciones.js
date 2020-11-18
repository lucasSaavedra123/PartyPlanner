var newDataVariable = {
	value: ''
}; //Lo usaremos para recordar de que variable estamos hablando en el momento que tengas que validar el dato

/*Funciones Booleanas*/
function isThereInvalidCharacters(text){
	var regExpValidText = /^[a-zA-Z0-9 ]*$/g;
	return !regExpValidText.test(text);
}

function isThereOnlyLetters(text){
	var regExpOnlyLetters = /^[a-zA-Z]*$/g;
	return regExpOnlyLetters.test(text) && !text == '';
}

function isMail(text){
	var regExpMail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/g;
	return regExpMail.test(text);
}

function isStreetAddress(text){
	var regExAddress = /^[a-zA-Z .]+[0-9]{1,10}$/g;
	return regExAddress.test(text);
}

function isThereAnyTableSelected(listOfTables){

	for (var arrayIndex = 0; arrayIndex < listOfTables.length ; arrayIndex++){
		if (listOfTables[arrayIndex].checked == true)
			return true;
	}

	return false;

}

function isValidDate(date,time){
	var regExDate = /^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/g;
	var regExHour = /^(([0-1]{1}[0-9]{1})|([2]{1}[0-3]{1})):(([0-5]{1}[0-9]{1}))$/g;

	if (regExDate.test(date) && regExHour.test(time)) {
		var dateToday = new Date();
		var dateInput = new Date();

		dateInput.setDate(parseInt(date.substr(8, 9)));
		dateInput.setMonth(parseInt(date.substr(5, 6))-1);
		dateInput.setFullYear(parseInt(date.substr(0, 4)));

		dateInput.setHours(parseInt(time.substr(0, 2)));
		dateInput.setMinutes(parseInt(time.substr(3, 5)));
		dateInput.setSeconds(0);
		dateInput.getMilliseconds(0);

		if (dateInput < dateToday)
			return false;
		else
			return true;

	}

	return false;
}

/*Funciones de interaccion con el DOM*/

function showErrorNotification(texto){
	var notificationBox = document.getElementById('editBoxNotification');
	var notification = document.getElementById('notificationText');

	notificationBox.classList.remove('hidden');
	notificationBox.classList.add('show');

	notification.innerHTML=texto;

}

function showErrorNotificationOfGuest(id,texto){
	var notification = document.getElementById(id);
	notification.innerHTML=texto;
}

function showErrorNotificationOfCreator(texto){
	var notificationBox = document.getElementById('notificationBox');
	var notification = document.getElementById('notificationText');

	notificationBox.classList.remove('hidden');
	notificationBox.classList.add('show');

	notification.innerHTML=texto;

}

function hideErrorNotification(id){
	var notificationBox = document.getElementById(id);

	notificationBox.classList.remove('show');
	notificationBox.classList.add('hidden');
}

function hideErrorNotificationOfGuest(id){
	var notification = document.getElementById(id);
	notification.innerHTML='';
}

function updateHTMLData(id, text){
	document.getElementById(id).innerHTML=text;
}

function paintRedBox(id){
	var box = document.getElementById(id);
	box.style.borderColor = "red";
}

function paintBlueBox(id){
	var box = document.getElementById(id);
	box.style.borderColor = "black";
}


/*Validaciones*/

/*Validaciones a la hora de modificar un dato de la fiesta o a la hora de crearla*/
function validEventName(value){
	
	if (value == '')
			showErrorNotification('Ingrese un nombre, por favor');
	else if(value.length < 10)
			showErrorNotification('Minimo 10 caracteres');
	else if(isThereInvalidCharacters(value))
			showErrorNotification("Solo numeros,letras, y espacios");
	else
			updateEventData(value);

}

function validEventAddress(value){

	if (value == '')
			showErrorNotification('Ingrese una dirección');
	else if(isThereInvalidCharacters(value))
			showErrorNotification("Solo numeros, letras, y espacios");
	else{
			updateEventData(value);
	}
}

function validEventTime(value){

	if (!isValidDate(document.getElementById('eventDate').children[0].innerHTML,value))
		showErrorNotification('Ingrese un horario valido');
	else{
		updateEventData(value);
	}

}

function validEventDate(value){
	if (!isValidDate(value, document.getElementById('eventTime').children[0].innerHTML,value))
		showErrorNotification('Ingrese una nueva fecha');
	else{
		updateEventData(value);
	}
}

function validateNewData(eventID){

	event.id = eventID;
	var inputOfChangerData = document.getElementById('changerDataInput');

	if (newDataVariable.value == 'eventName')
		validEventName(inputOfChangerData.value);
	if (newDataVariable.value == 'eventAddress')
		validEventAddress(inputOfChangerData.value);
	if (newDataVariable.value == 'eventTime')
		validEventTime(inputOfChangerData.value);
	if (newDataVariable.value == 'eventDate')
		validEventDate(inputOfChangerData.value);
}

function validateTableName(){

	var inputTableName = document.getElementById('tableNameInput');
	var newTableName = inputTableName.value;

	if (isThereInvalidCharacters(newTableName) || newTableName == '')
		inputTableName.style.borderColor = 'red';
	else
		updateAddTable(table.id, newTableName);
}

function getSelectedTableValue(listOfTables){
	for (var arrayIndex = 0; arrayIndex < listOfTables.length ; arrayIndex++){
		if (listOfTables[arrayIndex].checked == true)
			return listOfTables[arrayIndex].value;
	}
}	

function validGuestData(){
	var name = document.getElementById('nameInput').value;
	var surname = document.getElementById('surnameInput').value;
	var mail = document.getElementById('mailInput').value;
	var tablesList = document.getElementsByName('table');

	if ( (!isThereOnlyLetters(name)) )
		showErrorNotificationOfGuest('notification1','Ingrese un nombre, por favor');

	if ( !isThereOnlyLetters(surname) )
		showErrorNotificationOfGuest('notification2','Ingrese un apellido, por favor');

	if ( !isMail(mail) )
		showErrorNotificationOfGuest('notification3','Ingrese un mail, por favor');

	if (!isThereAnyTableSelected(tablesList)) {
		paintRedBox('tablesList');
	}

	if (isThereOnlyLetters(name))
		hideErrorNotificationOfGuest('notification1');

	if (isThereOnlyLetters(surname))
		hideErrorNotificationOfGuest('notification2');

	if (isMail(mail))
		hideErrorNotificationOfGuest('notification3');

	if (isThereAnyTableSelected(tablesList)) {
		paintBlueBox('tablesList');
	}

	if (isThereOnlyLetters(name) && isThereOnlyLetters(surname) && isMail(mail) && isThereAnyTableSelected(tablesList) )
		updateAddGuest(name,surname,mail,getSelectedTableValue(tablesList));
}

function validateEventCreator(){
	var eventNameInput = document.getElementById('eventNameInput');
	var eventDateInput = document.getElementById('eventDateInput');
	var eventHourInput = document.getElementById('eventHourInput');
	var eventAddressInput= document.getElementById('eventAddressInput');

	if (actualDivNumber == 1){
		if (eventNameInput.value=="")
			showErrorNotificationOfCreator('Ingrese un nombre por favor');
		else if ( isThereInvalidCharacters(eventNameInput.value) )
			showErrorNotificationOfCreator('Solo letras o numeros');
		else if( eventNameInput.value.length < 10 )
			showErrorNotificationOfCreator('Minimo 10 caracteres');
		else{
			updateHTMLData('nameData',eventNameInput.value);
			moveForward();
			hideErrorNotification('notificationBox');
		}
	}
	else if (actualDivNumber == 2){
		
		if ( !isValidDate(eventDateInput.value,eventHourInput.value) )
			showErrorNotificationOfCreator('Ingrese una fecha valida');
		else{
			updateHTMLData('hourData',eventHourInput.value);
			updateHTMLData('dateData',eventDateInput.value);
			moveForward();
			hideErrorNotification('notificationBox');
		}
	}
	else if (actualDivNumber == 3){
		
		if ( eventAddressInput.value == "" )
			showErrorNotificationOfCreator('Ingrese una direccion');
		else if( !isStreetAddress(eventAddressInput.value) )
			showErrorNotificationOfCreator('Ingrese una direccion válida');
		else{
			updateHTMLData('addressData',eventAddressInput.value);
			moveForward();
			hideErrorNotification('notificationBox');
		}
	}
	else if (actualDivNumber == 0 || actualDivNumber == 4)
		moveForward();

	if (actualDivNumber == 4)
		document.getElementById('addEventButton').disabled = false;
	else
		document.getElementById('addEventButton').disabled = true;
}

/*Validaciones para cuando se crea o modifica la informacion de un invitado*/