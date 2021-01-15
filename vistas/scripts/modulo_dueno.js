var tablaIns;
var tablaNeg;
var id;

//Función que se ejecuta al inicio
function init()
{
	
	listarIns();
	id=$('input[name=id]').val();
	listarNeg(id);
	mostrarSeccion1(true);
	mostrarSeccion2(false);
	mostrarSeccion3(false);
	mostrarSeccion4(false);
	mostrarSeccion5(false);
	mostrarSeccion6(false);
	mostrarSeccion7(false);
	mostrarSeccion8(false);
	mostrarSeccion9(false);
	mostrarformNeg(false);
	$("#menuDatosNegocio").hide();
	

	$("nav .nav-link").on("click", function(){
		$("nav").find(".active").removeClass("active");
		$(this).addClass("active");
	});

}

//Formulario de Datos Personales
function mostrarSeccion1(flag)
{
	if(flag){
		$("#seccion1").show();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#seccion9").hide();
		$("#menuDatosNegocio").hide();
	} else {
		$("#seccion1").hide();
	}	
}

//Formulario de Información del Negocio
function mostrarSeccion2(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").show();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#seccion9").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion2").hide();
	}	
}

//Formulario de Dirección del Negocio
function mostrarSeccion3(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").show();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#seccion9").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion3").hide();
	}	
}

//Formulario de Horarios del Negocio
function mostrarSeccion4(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").show();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#seccion9").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion4").hide();
	}	
}

//Formulario de Productos del Negocio
function mostrarSeccion5(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").show();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#seccion9").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion5").hide();
	}	
}

//Formulario de Productos del Negocio
function mostrarSeccion6(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").show();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#seccion9").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion6").hide();
	}	
}

//Formulario de Redes Sociales del Negocio
function mostrarSeccion7(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").show();
		$("#seccion8").hide();
		$("#seccion9").hide();
		$("#menuDatosNegocio").show();
	} else {
		$("#seccion7").hide();
	}	
}

//Formulario de Búsqueda de insumos
function mostrarSeccion8(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").show();
		$("#seccion9").hide();
		$("#menuDatosNegocio").hide();
	} else {
		$("#seccion8").hide();
	}	
}

//Formulario de Negocios
function mostrarSeccion9(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#seccion5").hide();
		$("#seccion6").hide();
		$("#seccion7").hide();
		$("#seccion8").hide();
		$("#seccion9").show();
		$("#menuDatosNegocio").hide();
	} else {
		$("#seccion9").hide();
	}	
}

//Formulario para agregar negocios
function mostrarformNeg(flag)
{
	$("#n_negocio2").val("");
	if (flag) {
		$("#ventanaAgregarNegocio").show();
		$("#btnGuardarNegocio").prop("disabled", false);
		$("btnagregarNegocio").hide();
	} else {
		$("#ventanaAgregarNegocio").modal('hide');
		$("body").removeClass('modal-open');
	}
	
}


//Listar los productos en la tabla tblistadoInsumos
function listarIns()
{
	tablaIns=$('#tbllistadoInsumos').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/productos.php?op=busquedaInsumos',
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 9, //Paginación
		"order": [[ 0, "asc" ]] //Ordenar (columa, orden)	
	}).DataTable();
}

//Listar los productos en la tabla tblistadoNegocios
function listarNeg(id)
{
	tablaNeg=$('#tblistadoNegocios').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/info_negocio.php?op=listarNegocios&idpersonal='+id,
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 9, //Paginación
		"order": [[ 0, "asc" ]] //Ordenar (columa, orden)	
	}).DataTable();
}

//Función para guardar negocios
function guardarNegocio()
{
	
	$("#btnGuardarNegocio").prop("disabled",true);
	var  formData = new FormData($("#formAgreNego")[0]);
	
	$.ajax({
		url: "../ajax/info_negocio.php?op=insertar&idpersonal=" + id,
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			bootbox.alert(datos);
			mostrarformNeg(false);
			$("#btnGuardarNegocio").prop("disabled",false);
			tablaNeg.ajax.reload();
		}	
		
	});
	$("#n_negocio2").val("");
}

//Función para copiar horarios del lunes a mar, mie, jue y vie
function copiarHorarios(){
	var value = $("#he_lun").val();
	$("#he_mar").val(value);
	$("#he_mie").val(value);
	$("#he_jue").val(value);
	$("#he_vie").val(value);
	var value1 = $("#hc_lun").val();
	$("#hc_mar").val(value1);
	$("#hc_mie").val(value1);
	$("#hc_jue").val(value1);
	$("#hc_vie").val(value1);
	var value2 = $("#hs_lun").val();
	$("#hs_mar").val(value2);
	$("#hs_mie").val(value2);
	$("#hs_jue").val(value2);
	$("#hs_vie").val(value2);
}

//Función para convertir en mayusculas el RFC
function mayusculas(e) {
	e.value = e.value.toUpperCase();
}

//Función para validad el tipo de archivo cargado al servidor
function validarImagen1()
{
/*
		var ancho = $("#url_imagen1").width();
		var altura = $("#url_imagen1").height();
		bootbox.alert("ancho " + ancho + " altura "+ altura);

		if(altura > ancho)
		{
			bootbox.alert("Se recomienda cargar una imagen rectangular (3917 x 1254)");
		}*/

	var fileName = $("#url_imagen1").val();
	var idxDot = fileName.lastIndexOf(".") + 1;
	var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
	if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){

	}else{
		bootbox.alert("Sólo se permiten imagenes en formato jpg, jpeg y png");
		$("#url_imagen1").val("");
	}

}

//Función para validad el tipo de archivo cargado al servidor
function validarImagen2()
{
	var fileName = $("#url_imagen2").val();
	var idxDot = fileName.lastIndexOf(".") + 1;
	var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
	if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){

	}else{
		bootbox.alert("Sólo se permiten imagenes en formato jpg, jpeg y png");
		$("#url_imagen2").val("");
	}   
}

init();
