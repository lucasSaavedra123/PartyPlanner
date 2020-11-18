var actualDivNumber = 0;

/*var event = {
	id: 0
};*/

var guest = {
	id: 0
};

var table = {
	id: '',
	name: ''
}


function isItemInList(item,list){

	for (var i = list.length - 1; i >= 0; i--) {
		if (list[i] == item)
			return true;
	}

	return false;

}

function onlyShowDiv(id){

	var divElement = document.getElementById(id);
	var listOfDivs = document.getElementsByClassName('window');

	for (var i = 0;i<listOfDivs.length; i++){
		if (isItemInList('show',listOfDivs[i].classList)){
			listOfDivs[i].classList.remove('show');
			listOfDivs[i].classList.add('hidden');
		}
	}

	divElement.classList.add('show');

}

function asignUniqueActiveItem(id){

	var item = document.getElementById(id);
	var listOfItems = document.getElementsByClassName('item');

	for (var i = 0;i<listOfItems.length; i++)
		listOfItems[i].classList.remove('active');

	item.classList.add('active');

}



function moveForward(){

	var listOfDivs = document.getElementsByClassName('window');

	if( listOfDivs.length > actualDivNumber + 1 ){
		actualDivNumber++;
		onlyShowDiv(listOfDivs[actualDivNumber].id);
	}
}

function moveBackward(){

	var listOfDivs = document.getElementsByClassName('window');

	if( 0 <= actualDivNumber - 1 ){
		actualDivNumber--;
		onlyShowDiv(listOfDivs[actualDivNumber].id);
	}

}

function showChangerData(id, texto){
	newDataVariable.value = id;

	var changerData = document.getElementById('changerData');
	var changerDataText = document.getElementById('editBoxTitle');
	var changerDataInput=document.getElementById("changerDataInput");
	var changeDataButton = document.getElementById('changeButton');

	changerData.classList.remove('hidden');
	changerData.classList.add('show');

	changerDataText.innerHTML = texto;

	if (id == 'eventName'){
		changerDataInput.type='text';
		changerDataInput.placeholder='Ingrese el nuevo nombre de tu evento...';
	}
	if (id == 'eventAddress'){
		changerDataInput.type='text';
		changerDataInput.placeholder='Ingrese la nueva direccion del evento...';
	}
	if (id == 'eventSaloon'){
		changerDataInput.type='text';
		changerDataInput.placeholder='Ingrese el nombre del salon...';
	}
	else if (id == 'eventDate'){
		changerDataInput.type='date';
	}
	else if (id == 'eventTime'){
		changerDataInput.type='time';
	}

}

function hideChangerData(){
	var changerData = document.getElementById('changerData');
	var changerDataInput = document.getElementById('changerDataInput')
	changerData.classList.remove('show');
	changerData.classList.add('hidden');

	changerDataInput.value = '';
	hideErrorNotification('editBoxNotification');
}

function showTableAdder(id='',name=''){
	var tableAdder = document.getElementById('tableAdder');
	var tableAdderInput = document.getElementById('tableNameInput');
	tableAdder.classList.remove('hidden');
	tableAdder.classList.add('show');

	table.id = id;
	table.name = name;

	tableAdderInput.value = name;
}

function hideTableAdder(){
	var tableAdder = document.getElementById('tableAdder');
	var tableAdderInput = document.getElementById('tableNameInput');

	tableAdder.classList.remove('show');
	tableAdder.classList.add('hidden');

	table.id = '';
	table.name = '';

	tableAdderInput.value = '';
}

function showGuestAdder(guestName='',guestSurname='',guestMail='',guestID='',tableID=''){
	var guestAdder = document.getElementById('guestAdder');

	guestAdder.classList.remove('hidden');
	guestAdder.classList.add('show');

	if (guestName != '') {
		document.getElementById('nameInput').value = guestName;
		document.getElementById('surnameInput').value = guestSurname;
		document.getElementById('mailInput').value = guestMail;
		document.getElementById('table'+tableID).checked = true;

		guest.id = guestID;
	}
}

function hideGuestAdder(){
	var guestAdder = document.getElementById('guestAdder');

	guestAdder.classList.remove('show');
	guestAdder.classList.add('hidden');

	document.getElementById('nameInput').value = '';
	document.getElementById('surnameInput').value = '';
	document.getElementById('mailInput').value = '';

	guest.id = '';
}