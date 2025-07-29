$(function()
{
	$("#login").submit(function(event)
	{
		if (document.getElementById("email").value=='')
		{
			event.preventDefault();
			alert("El email no puede estar vacío");
		}
	
		if (document.getElementById("password").value=='')
		{
			event.preventDefault();
			alert("La contraseña no puede estar vacía");
		}	 

	});

});