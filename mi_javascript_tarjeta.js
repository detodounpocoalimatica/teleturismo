$(function()
{
	$("#tarjeta").submit(function(event)
	{
		var numero_de_tarjeta=document.getElementById("numero_de_tarjeta").value;
		var anyo_de_caducidad=document.getElementById("anyo_de_caducidad").value;
		var mes_de_caducidad=document.getElementById("mes_de_caducidad").value;

		if (numero_de_tarjeta=='')
		{
			event.preventDefault();
			alert("El número de tarjeta no puede estar vacío");
		}

		if (validar_numero_de_tarjeta(numero_de_tarjeta)==2)
		{
			event.preventDefault();
			alert("El número de tarjeta debería tener exactamente 20 digitos");
		}

		if (validar_numero_de_tarjeta(numero_de_tarjeta)==3 || validar_numero_de_tarjeta(numero_de_tarjeta)==4)
		{
			event.preventDefault();
			alert("El número de tarjeta debería tener exactamente 20 digitos «Elimine las letras»");
		}

		if (anyo_de_caducidad=='')
		{
			event.preventDefault();
			alert("El año de caducidad no puede estar vacío");
		}

		if (validar_mes_o_anyo(anyo_de_caducidad)==2)
		{
			event.preventDefault();
			alert("El año de caducidad debe tener exactamente 2 digitos");
		}
		else if (validar_mes_o_anyo(anyo_de_caducidad)==3 || validar_mes_o_anyo(anyo_de_caducidad)==4)
		{
			event.preventDefault();
			alert("El año de caducidad debe tener exactamente 2 digitos y además debe eliminar las letras");
		}

		if (mes_de_caducidad=='')
		{
			event.preventDefault();
			alert("El mes de caducidad no pueden estar vacíos");
		}

		if (mes_de_caducidad<1 || mes_de_caducidad>12)
		{
			event.preventDefault();
			alert("El mes de caducidad debe ser un valor comprendido entre 1 y 12");
		}

		if (validar_mes_o_anyo(mes_de_caducidad)==2)
		{
			event.preventDefault();
			alert("El mes de caducidad debe tener exactamente 2 digitos");
		}
		else if (validar_mes_o_anyo(mes_de_caducidad)==3 || validar_mes_o_anyo(mes_de_caducidad)==4)
		{
			event.preventDefault();
			alert("El mes de caducidad debe tener exactamente 2 digitos y además debe eliminar las letras");
		}

		if(document.getElementById("numero_secreto").value=='')
		{
			event.preventDefault();
			alert("El número secreto no pueden estar vacío");
		}

		if(document.getElementById("numero_secreto").value.length!=3)
		{
			event.preventDefault();
			alert("El número secreto debe estar formado exactamente por 3 caracteres numéricos");
		}

		if(document.getElementById("titular_de_la_tarjeta").value=='')
		{
			event.preventDefault();
			alert("El titular de la tarjeta no pueden estar vacío");
		}

		
	});

	function validar_numero_de_tarjeta(numero_de_tarjeta)
	{
		if (numero_de_tarjeta.length==20 && !isNaN(numero_de_tarjeta)) return 1;
		else if (numero_de_tarjeta.length!=20 && !isNaN(numero_de_tarjeta)) return 2;
		else if (numero_de_tarjeta.length==20 && isNaN(numero_de_tarjeta)) return 3;
		else if (numero_de_tarjeta.length!=20 && isNaN(numero_de_tarjeta)) return 4;
	}

	function validar_mes_o_anyo(mes_o_anyo)
	{
		if (mes_o_anyo.length==2 && !isNaN(mes_o_anyo)) return 1;
		else if (mes_o_anyo.length!=2 && !isNaN(mes_o_anyo)) return 2;
		else if (mes_o_anyo.length==2 && isNaN(mes_o_anyo)) return 3;
		else if (mes_o_anyo.length!=2 && isNaN(mes_o_anyo)) return 4;
	}

});