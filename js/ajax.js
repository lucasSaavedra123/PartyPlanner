var xmlhttp;

var event = {
	id: 0
};

//Funcion para crear al objeto XMLHTttRequest capaz de poder realizar técnicas AJAX
function createXMLHttpRequest() {

	try {
	   // Opera 8.0+, Firefox, Safari 
	   xmlhttp = new XMLHttpRequest();
	} catch (e) {
	   // Internet Explorer Browsers
	   try {
	      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	   } catch (e) {
	      
	      try {
	         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	      } catch (e) {
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	}
}

//Función 'callback' para hacer una función a partir de una petición
function sendRequest(url,functionToDo){
	createXMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            functionToDo(this.responseText);
        }
    	};

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

//Funciones para el registro
function processLogin (){
    var username=document.getElementById("username").value;
    var password=document.getElementById("passwordLogin").value;

    sendRequest("content/login.php?username="+username+"&passwordLogin="+password,verifyLogin);

}

function verifyLogin(value){
if (value==true){
    location.href="content/welcome.php";}
if (value==false){
    alert("Usuario y/o contraseña incorrecto.");}

if (value=="error"){
    alert("No se pudo procesar la informacion. Intentelo mas tarde.");}
}

function processRegister(){
    var name=document.getElementById("name").value;
    var mail=document.getElementById("email").value;
    var password=document.getElementById("myPsw").value;

    sendRequest("content/registro.php?name="+name+"&mail="+mail+"&password="+password,verifyRegister);

}

function verifyRegister(value){
if (value==true){
    location.href="content/redirectRegister.php";

}
if (value==false){
    alert("El e-mail ingresado ya se encuentra registrado.");}

if (value=="error"){
    alert("No se pudo procesar la informacion. Intentelo mas tarde.");}
}

function processGuestCode(){
    var code=document.getElementById("guestCode").value;

    sendRequest("content/confirmacion.php?code="+code,verifyGuestCode);

}

function verifyGuestCode(value){
if (value==true){
    location.href="content/redirectConfirmacion.php";
}

if (value==false){
    alert("Ingrese un codigo de invitado valido.");}

if (value=="error"){
    alert("No se pudo procesar la informacion. Intentelo mas tarde.");}
}

//Funciones de la interfaz de evento
function deleteEvent(eventID){
	event.id = eventID;

	if (confirm("¿Seguro que quiere borrar el evento?"))
		sendRequest("deleteEvent.php?eventID="+event.id,showDeletedEventAlert);
}

function deleteTable(tableID){
	if (confirm("¿Seguro que queres borrar la mesa? (Se borraran todos sus invitados)"))
		sendRequest("deleteTable.php?tableID="+tableID,showDeletedTableAlert);
}

function deleteGuest(guestID){
	if (confirm("¿Seguro que queres borrar a este invitado?"))
		sendRequest('deleteGuest.php?guestID='+guestID,showDeletedGuestAlert);
}

function updateEventData(value){
	sendRequest("updateEventData.php?"+newDataVariable.value+"="+value+"&eventID="+event.id, overwriteEventData)
}

function updateAddGuest(name,surname,mail,tableID){
	sendRequest('addUpdateGuest.php?guestName='+name+'&guestSurname='+surname+'&guestMail='+mail+'&table='+tableID+'&guestID='+guest.id,overwriteGuestData);
}

function updateTables(eventID){
	event.id = eventID;
	getEventTable(event.id);
	getGuestTable(event.id);
	getTableTable(event.id);
	getTableOptions(event.id);
}

function updateAddTable(tableID,name){
	sendRequest('addUpdateTable.php?newTableName='+name+'&tableID='+tableID+'&eventID='+event.id,workTableName);
}

function workTableName(text){
	if (text == 'successfull'){
       	hideTableAdder();
       	updateTables(event.id);
	}
	else if(text == 'error1'){
		alert('Ya existe una mesa con ese nombre');
	}
	else if(text == 'error2'){
		alert('Hubo un error con el servidor. Intentelo de nuevo.')
	}
}

function getEventTable() {
	sendRequest('getEventTable.php?eventID='+event.id,overwriteEventTable);
}

function getTableOptions() {
	sendRequest('getTablesOptions.php?eventID='+event.id,overwriteTablesOptions);
}

function getGuestTable(){
	sendRequest('getGuestsTable.php?eventID='+event.id,overwriteGuestTable);
}

function getTableTable() {
	sendRequest('getTablesTable.php?eventID='+event.id,overwriteTableTable);
}

function overwriteEventTable(text){
	if(text != "error")
		document.getElementById('information').children[0].innerHTML=text;
    else
    	alert('Hubo un error en el servidor');
}

function overwriteEventData(text){
    if(text == "successfull"){
		document.getElementById(newDataVariable.value).childNodes[0].innerHTML=document.getElementById('changerDataInput').value;
		hideChangerData();
    }
    else if (text == "error")
    	alert('Hubo un error en el servidor. Intentelo de nuevo.');
}

function overwriteGuestData(text){
	if(text){
       	hideGuestAdder();
       	updateTables(event.id);
    }
    else
        alert('No fue posible agregar al invitado. Intentelo de nuevo.');

}

function overwriteGuestTable(text){
	if (text == 'error')
        alert('No fue posible conseguir la tabla de invitados. Intentelo de nuevo.');
    else
        document.getElementById('guests').children[0].children[2].innerHTML = text;
}

function overwriteTableTable(text){
	if (text == 'error')
        alert('No fue posible conseguir la tabla con las mesas. Intentelo de nuevo.');
    else
        document.getElementById('tables').children[0].children[1].innerHTML = text;
}

function overwriteTablesOptions(text){
	if (text == 'error')
        alert('No fue posible conseguir la tabla con las mesas. Intentelo de nuevo.');
    else
        document.getElementById('tablesList').children[0].innerHTML = text;
}


function showSendMailAlert(){
    alert('Mail Enviado!');
}

function showDeletedEventAlert(){
	var eventBox = document.getElementById("delete"+event.id);

	alert('¡Evento Borrado!');
	eventBox.parentNode.removeChild(eventBox);
}

function showDeletedTableAlert(){
	alert('¡Mesa Borrada!');
	updateTables(event.id);
}

function showDeletedGuestAlert(){
	alert('¡Invitado Borrado!');
	updateTables(event.id);
}