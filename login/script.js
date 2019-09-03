function myfunction(){
	var usr = document.getElementById('usr').value;
	var pass = document.getElementById('pass').value;
	validar(usr, pass);
}

function validar(usr, pass){
	if (usr == "2013090243" && pass == "edgar") 
	{
		alert("Bienvenido");
		document.getElementById('usr').value='';
		document.getElementById('pass').value='';
	}
	else
	{
		alert("Datos incorrectos")
	}
}
document.getElementById("boton").addEventListener("click", myfunction);
