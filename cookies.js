$(function()
{	
	var identificador_cookie="identificador_cookie_11";	

	if (Cookies.get(identificador_cookie)!="verdad")
	{
		$("body").prepend(`<p id="parrafo_fijo"> Solicitamos su permiso para obtener datos estadisticos de su navegación en esta web, en cumplimiento del Real Decreto-ley 13/2012.<br> Si continua navegando consideraremos que acepta el uso de cookies <botton id="boton_aceptar"> Aceptar</botton">
		<a id="enlace_cookies" href="#"> Más información</a></p>`);

		$('#boton_aceptar').click(function()
		{ 		
			Cookies.set(identificador_cookie, "verdad", {expires: 1000});
			$('#parrafo_fijo').hide();
		});
	}
}

);