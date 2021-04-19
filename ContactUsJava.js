function verify() {
	form = document.getElementById("myForm")
	email = form.elements[1].value	
	comments = form.elements[3].value

	if (!email.includes("@")) {
		alert("Invalid E-mail.")
		return email.includes("@")
	}
	
	if (comments.length > 250) {
		alert("Exceeded max of 250 characters");
		return comments.length <= 250
	}
	
	else {
		return comments.length <= 250
	}
	document.getElementById("status").innerText = "Success! Thank you you will hear back soon!";
	
}

function counter() {
	form = document.getElementById("myForm")	
	comments = form.elements[3].value

	document.getElementById("count").textContent = comments.length + "/250"
}

function submitSelected() {
	form = document.getElementById("myForm")
	form.elements[4].style.backgroundColor = "lightgrey"; 
	form.elements[4].style.fontStyle = "italic";
}

function submitUnselected() {
	form = document.getElementById("myForm")
	form.elements[4].style.backgroundColor = ""; 
	form.elements[4].style.fontStyle = "";
}

function clearSelected() {
	form = document.getElementById("myForm")
	form.elements[5].style.backgroundColor = "lightgrey"; 
	form.elements[5].style.fontStyle = "italic";
}

function clearUnselected() {
	form = document.getElementById("myForm")
	form.elements[5].style.backgroundColor = "";
	form.elements[5].style.fontStyle = ""; 
}

