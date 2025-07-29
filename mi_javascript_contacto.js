$(function()
{
	$("#contacto").submit(function(event)
	{
		var telefono=document.getElementById("telefono").value;

		if (document.getElementById("nombre").value=='')
		{
			event.preventDefault();
			alert("El nombre no puede estar vacío");
		}

		if (document.getElementById("apellidos").value=='')
		{
			event.preventDefault();
			alert("Los apellidos no pueden estar vacíos");
		}

		if (document.getElementById("direccion").value=='')
		{
			event.preventDefault();
			alert("La dirección no puede estar vacía");
		}

		if (document.getElementById("email").value=='')
		{
			event.preventDefault();
			alert("El email no puede estar vacío");
		}

		if (document.getElementById("area_de_texto").value=='')
		{
			event.preventDefault();
			alert('Rellene el campo "Escribe aquí lo que deseas contarnos:"');
		}		

		if (telefono=='')
		{
			event.preventDefault();
			alert("El teléfono no puede estar vacío");
		}

		if (validar_telefono(telefono)==2)
		{
			event.preventDefault();
			alert("El teléfonfo debería tener exactamente 9 digitos");
		}

		if (validar_telefono(telefono)==3 || validar_telefono(telefono)==4)
		{
			event.preventDefault();
			alert("El teléfonfo debería tener exactamente 9 digitos «Elimine las letras»");
		}

		if (document.getElementById("checkbox_registro").checked)
		{
			if (document.getElementById("contrasenya").value!=document.getElementById("contrasenya2").value)
			{
				event.preventDefault();
				alert("Los dos campos contraseña deben ser iguales entre sí");
			}
			else if (document.getElementById("contrasenya").value=="")
			{
				event.preventDefault();
				alert("La contraseña no debe estar vacía");
			}
		}

		if (!document.getElementById("checkbox_he_leido").checked)
		{
			event.preventDefault();
			alert('Debes pulsar donde dice "He leido: Sus datos no serán leídos . . . "');
		}		 

	});

	function validar_telefono(telefono)
	{
		if (telefono.length==9 && !isNaN(telefono)) return 1;
		else if (telefono.length!=9 && !isNaN(telefono)) return 2;
		else if (telefono.length==9 && isNaN(telefono)) return 3;
		else if (telefono.length!=9 && isNaN(telefono)) return 4;
	}

});