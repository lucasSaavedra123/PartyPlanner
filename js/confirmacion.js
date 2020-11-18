function validar(){
	var confirmed= document.getElementById("confirmed");
	var notConfirmed= document.getElementById("notConfirmed");
	var mayBe= document.getElementById("maybe");

	if (confirmed.checked=="true" || notConfirmed.checked=="true" || mayBe.checked=="true"){
		document.getElementById("myBtn").disabled = false;
	}else{
		document.getElementById("myBtn").disabled = true;

		alert("FUNCIONA")


	}
}

function enableButton(){
	var button= document.getElementById("send");

	button.classList = "blueBackground whiteFont button";

	button.disabled = false;
}

function redirect(){
	location.href ="../content/redirectConfirm.html"
}