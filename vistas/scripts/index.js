//Función que se ejecuta al inicio
function init()
{
	mostrarProductos(false);
	mostrarServicios(false);
	mostrarBusqueda(false);
	mostrarForm(false);
	$("#loading").hide();

	//Listar los giros en productos
	$.post("../ajax/info_negocio.php?op=selectGiroP", function(r) {
		$("#idgiro").html(r);
		$("#idgiro").select2();
	})

	//Listar los giros en servicios
	$.post("../ajax/info_negocio.php?op=selectGiroS", function(r) {
		$("#idgiro2").html(r);
		$("#idgiro2").select2();
	})

	//Mostrar Carousel dinamico 
	$.post("../ajax/info_negocio.php?op=carousel", function(r) {
		$("#divCarousel").html(r);
	})
	
	//recargarConsultaP();

	$("#idgiro").change(function(){
		recargarConsultaP();
	})

	//recargarConsultaS();

	$("#idgiro2").change(function(){
		recargarConsultaS();
	})

}

function recargarConsultaP()
{
	$("#divConsultasP").show();
	$("#divConsultasP").html('<br /> <div class="text-center"><img src="../public/img/cargar.gif" alt="loading" /><br/>Un momento, por favor...</div> <br /> ');
	$.ajax({
		url: "../ajax/info_negocio.php?op=consultaProductos&nombre="+$("#idgiro").find('option:selected').text(),
		type: "POST",
		data: "giro="+ $("#idgiro").val(),	
		success: function(r)
		{
			$("#divConsultasP").html(r);
		}
	});

}

function recargarConsultaS()
{
	$("#divConsultasS").show();
	$("#divConsultasS").html('<br /> <div class="text-center"><img src="../public/img/cargar.gif" alt="loading" /><br/>Un momento, por favor...</div> <br /> ');
	$.ajax({
		url: "../ajax/info_negocio.php?op=consultaServicios&nombre="+$("#idgiro2").find('option:selected').text(),
		type: "POST",
		data: "giro="+ $("#idgiro2").val(),	
		success: function(h)
		{
			$("#divConsultasS").html(h);
		}	
		
	});

}

function busquedaNegocio()
{
	if($("#busqueda").val()!=''){
		$("#divBusqueda").show();
		$("#divBusqueda").html('<br /> <div class="text-center"><img src="../public/img/cargar.gif" alt="loading" /><br/>Un momento, por favor...</div> <br /> ');
		$.ajax({
			url: "../ajax/info_negocio.php?op=busquedaNombre",
			type: "POST",
			data: "nombre="+$("#busqueda").val(),	
			success: function(h)
			{
				$('#divBusqueda').html(h);
			//$("#divBusqueda").html(h);
		}	
	});
		return false;
	} else {
		bootbox.alert("Complete los campos antes de realizar la búsqueda");
	}
}

//Función mostrar formulario
function mostrarProductos(flag)
{
	if (flag) {
		$("#divCarousel").hide();
		$("#selectProductos").show();
		$("#selectServicios").hide();
		$("#busquedaNegocio").hide();
		$("#divConsultasP").hide();
		$("#formulario").hide();
		$("#idgiro").val("0");
		$("#idgiro2").val("0");
		$("#busqueda").val("");
		$("#divConsultasS").hide();
		$("#divBusqueda").hide();
		//$("#menuBotones").hide();
	} else {
		$("#selectProductos").hide();
		$("#divConsultasP").hide();
		//$("#menuBotones").show();
	}
}

function mostrarServicios(flag)
{
	if (flag) {
		$("#divCarousel").hide();
		$("#selectProductos").hide();
		$("#selectServicios").show();
		$("#busquedaNegocio").hide();
		$("#divConsultasS").hide();
		$("#formulario").hide();
		$("#idgiro").val("0");
		$("#idgiro2").val("0");
		$("#busqueda").val("");
		$("#divConsultasP").hide();
		$("#divBusqueda").hide();
		//$("#menuBotones").hide();
	} else {
		$("#selectServicios").hide();
		$("#divConsultasS").hide();
		//$("#menuBotones").show();
	}
}

function mostrarBusqueda(flag)
{
	if (flag) {
		$("#divCarousel").hide();
		$("#selectProductos").hide();
		$("#selectServicios").hide();
		$("#busquedaNegocio").show();
		$("#divConsultasS").hide();
		$("#formulario").hide();
		$("#idgiro").val("0");
		$("#idgiro2").val("0");
		$("#busqueda").val("");
		$("#divConsultasP").hide();
		$("#divBusqueda").hide();
		//$("#menuBotones").hide();
	} else {
		$("#busquedaNegocio").hide();
		$("#divBusqueda").hide();
		//$("#menuBotones").show();
	}
}

function limpiarBusqueda(){
	$("#busqueda").val("");
	$("#divBusqueda").hide();
}

function mostrarForm(flag)
{
	if(flag){
		$("#formulario").show();
	} else {
		$("#formulario").hide();
	}
}

function cancelarform(){
	$("#formulario").hide();
}

init();