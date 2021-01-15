var id;
var tablaNeg;

//Función que se ejecuta al inicio
function initIN()
{
	//Se obtiene el idpersonal de una variable de sesión de input hidden id
	id=$('input[name=negocio]').val();
	mostrarIN(id);
	tipo(id);
	//tipoSel();

	recargarGiros();
	

	$("#tipo_negocio").change(function(){
		recargarGiros();
	})

	//Se cargan los giros al select
	$.post("../ajax/info_negocio.php?op=selectGiro&negocio="+id, function(r) {
		$("#idgiro").html(r);
		$("#idgiro").select2();
	})

	//Se cargan los pagos seleccionados
	$.post("../ajax/info_negocio.php?op=pagos&id="+ id, function(r) {
		$("#t_pagos").html(r);
	})

	//$negocio=$("#tipo_negocio").val();

}

function recargarGiros()
{
	$.ajax({
		url: "../ajax/info_negocio.php?op=actualizacionG&negocio=" + id,
		type: "POST",
		data: "giro="+ $("#tipo_negocio").val(),	
		success: function(r)
		{
			$("#idgiro").html(r);
			//$("#idgiro").select2();
		}	
		
	});

}

function tipoSel()
{
	$.post("../ajax/info_negocio.php?op=tipoSelect&id="+ id, function(f) {
		$("#tipo_negocio").html(f);
	})

}

//Función para guardar y editar
function guardaryeditarIN()
{
	if($('div.checkbox-group.required :checkbox:checked').length > 0){
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarIN").prop("disabled",true);
	var  formData = new FormData($("#formDatosNInformacion")[0]);
	
	$.ajax({
		url: "../ajax/info_negocio.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			bootbox.alert(datos);
			tablaNeg.ajax.reload();
			mostrarIN(id);
			tipo(id);
			recargarGiros();
			$("#btnGuardarIN").prop("disabled",false);
		}	
		
	});
	} else {
		bootbox.alert('No seleccionó ningún método de pago');
	}
}


function mostrarIN(idinfo_negocio)
{
	$.post("../ajax/info_negocio.php?op=mostrar", {idinfo_negocio : idinfo_negocio}, function(data, status)
	{
		data = JSON.parse(data);

		$("#idpersonal2").val(data.idpersonal);
		$("#idgiro").val(data.idgiro);
		$("#n_negocio").val(data.n_negocio);
		$("#ref_negocio").val(data.ref_negocio);
		$("#rfc_negocio").val(data.rfc_negocio);
		$("#imagenmuestra1").show();
		$("#imagenmuestra1").attr("src", "../files/img_negocios_carousel/"+data.url_imagen1);
		$("#imagenactual1").val(data.url_imagen1);
		$("#imagenmuestra2").show();
		$("#imagenmuestra2").attr("src", "../files/img_negocios_tarjetas/"+data.url_imagen2);
		$("#imagenactual2").val(data.url_imagen2);
		$("#tipo_negocio").val(data.tipo_negocio);
		$("#tipo_servicio").val(data.tipo_servicio);
		$("#idinfo_negocio").val(data.idinfo_negocio);
		if(data.n_negocio!=''){
			$("#lb9").addClass('active');
		}
		if(data.ref_negocio!=''){
			$("#lb10").addClass('active');
		}
		if(data.rfc_negocio!=''){
			$("#lb11").addClass('active');
		}
	});	
}

//Función para eliminar un usuario
function eliminarIN(idinfo_negocio)
{
	bootbox.confirm("¿Estas seguro de eliminar este negocio?", function(result) {
		if (result) {
			$.post("../ajax/info_negocio.php?op=eliminar", {idinfo_negocio : idinfo_negocio}, function(e) {
				bootbox.alert(e);
				tablaNeg.ajax.reload();
			});
		}
	})
}

function tipo(idinfo_negocio)
{
	$.post("../ajax/info_negocio.php?op=obtenerTipo", {idinfo_negocio : idinfo_negocio}, function(data, status)
	{
		data = JSON.parse(data);

		//Mostrar pestaña de productos o servicios
		$.post("../ajax/info_negocio.php?op=elegirTipo&tipo="+ data.tipo_negocio, function(h) {
			$("#tipo_bd").html(h);

		})	
	});

}

function actualizarNeg(idinfo_negocio, n_negocio){
	$("#negocio").attr("value",idinfo_negocio);
	$("#negocio2").attr("value",idinfo_negocio);
	$("#idinfo_negocio2").attr("value",idinfo_negocio);
	$("#idinfo_negocio3").attr("value",idinfo_negocio);
	initIN();
	mostrarIN(idinfo_negocio);
	tipo(idinfo_negocio);
	mostrarHor(idinfo_negocio);
	initD();
	mostrarD(idinfo_negocio);
	initP();
	listarPro(idinfo_negocio);
	initS();
	listarSer(idinfo_negocio);
	mostrarRS(idinfo_negocio);
	setTimeout('bootbox.alert("Seleccionó el negocio: " + $("#n_negocio").val())', 500);


}

initIN();