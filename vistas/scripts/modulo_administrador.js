var tablaU;
var tablaDP;
var tablaIN;
var tablaG;

//Función que se ejecuta al inicio
function init()
{
	mostrarformUsuarios(false);
	mostrarformGiro(false);
	mostrarSeccion1(false);
	mostrarSeccion2(false);
	mostrarSeccion3(false);
	mostrarSeccion4(false);
	listarDP();
	listarIN();
	
	
	//Mostrar Carousel dinamico 
	$.post("../ajax/info_negocio.php?op=carousel", function(r) {
		$("#divCarousel").html(r);
	})
}

//Función para convertir en mayusculas el RFC
function mayusculas(e) {
	e.value = e.value.toUpperCase();
}



//Sección de Usuarios
function mostrarSeccion1(flag)
{
	if(flag){
		$("#seccion1").show();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#divCarousel").hide();
		$("#ventanaEditUsuario").hide();
	} else {
		$("#seccion1").hide();
	}
	
}

//Sección de Datos Personales
function mostrarSeccion2(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").show();
		$("#seccion3").hide();
		$("#seccion4").hide();
		$("#divCarousel").hide();
		$("#ventanaEditUsuario").hide();
	} else {
		$("#seccion2").hide();
	}
	
}

//Sección de Datos del Negocio
function mostrarSeccion3(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").show();
		$("#seccion4").hide();
		$("#divCarousel").hide();
		$("#ventanaEditUsuario").hide();
	} else {
		$("#seccion3").hide();
	}
	
}

//Sección de Giros
function mostrarSeccion4(flag)
{
	if(flag){
		$("#seccion1").hide();
		$("#seccion2").hide();
		$("#seccion3").hide();
		$("#seccion4").show();
		$("#divCarousel").hide();
		$("#ventanaEditUsuario").hide();
	} else {
		$("#seccion4").hide();
	}
	
}

//Formulario para editar o agregar un usuario
function mostrarformUsuarios(flag)
{
	limpiarU();
	if (flag) {
		$("#ventanaEditUsuario").show();
		$("#btnGuardarUusarios").prop("disabled", false);
		$("btnagregarUsuario").hide();
	} else {
		$("#ventanaEditUsuario").modal('hide');
		$("body").removeClass('modal-open');
	}
	
}

//Formulario para editar Datos Personales
function mostrarformDP(flag)
{
	limpiarG();
	if (flag) {
		$("#ventanaEditDP").show();
		$("body").addClass('modal-open');
		$("#btnGuardarDP").prop("disabled", false);
	} else {
		$("#ventanaEditDP").modal('hide');
		$("body").removeClass('modal-open');
	}
	
}

//Formulario para editar o agregar un giro
function mostrarformGiro(flag)
{
	limpiarG();
	if (flag) {
		$("#ventanaEditGiro").show();
		$("#btnGuardarGiro").prop("disabled", false);
		$("btnagregarGiro").hide();
	} else {
		$("#ventanaEditGiro").modal('hide');
		$("body").removeClass('modal-open');
	}
	
}

//Funcion limpiar
function limpiarU()
{
	$("#idusuario").val("");
	$("#n_usuario").val("");
	$("#c_usuario").val("");
}
//Funcion limpiar

function limpiarG()
{
	$("#idgiro").val("");
	$("#n_giro").val("");
	$("#d_giro").val("");
}

//Listar los datos personales en la tabla tbllistadoDatosPersonales
function listarDP()
{
	tablaDP=$('#tbllistadoDatosPersonales').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/datos_personales.php?op=listar',
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 9, //Paginación
		"order": [[ 0, "desc" ]] //Ordenar (columa, orden)	
	}).DataTable();
}


//Listar la información del negocio en la tabla tbllistadoDatosPersonales
function listarIN()
{
	tablaIN=$('#tbllistadoInformacionNegocio').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/info_negocio.php?op=listar',
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 9, //Paginación
		"order": [[ 0, "desc" ]] //Ordenar (columa, orden)	
	}).DataTable();
}

//Mostrar en modal datos personales del usuario elegido
function mostrarDP(idpersonal)
{
	$.post("../ajax/datos_personales.php?op=mostrar", {idpersonal : idpersonal}, function(data, status)
	{
		data = JSON.parse(data);

		$("#nombres").val(data.nombres);
		$("#a_paterno").val(data.a_paterno);
		$("#a_materno").val(data.a_materno);
		$("#rfc_usuario").val(data.rfc_usuario);
		$("#n_telefono").val(data.n_telefono);
		$("#correo_usu").val(data.correo_usu);
		$("#n_usuario").val(data.n_usuario);
		$("#c_usuario").val(data.c_usuario);
		$("#idusuario").val(data.idu);
		$("#idpersonal").val(data.idp);
	});	
}

//Función para guardar y editar Datos Personales
function guardaryeditarDP()
{
	$("#btnGuardarDP").prop("disabled",true);
	var  formData = new FormData($("#formDatosPer")[0]);
	
	$.ajax({
		url: "../ajax/datos_personales.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			bootbox.alert(datos);
			mostrarformDP(false);
			$("#btnGuardarDP").prop("disabled",false);
			tablaDP.ajax.reload();
		}	
		
	});
}

init();