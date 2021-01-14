var tablaU;
var tablaDP;
var tablaIN;


//Función que se ejecuta al inicio
function init()
{
	listarU();
	
}

//Listar los productos en la tabla tblistado
function listarU()
{
	tablaU=$('#tbllistadoUsuarios').dataTable(
	{
		responsive: true,
		"aProcessing": true, //Activamos el procesamiento del datatables
		"aServerSide": true, //Paginación y filtrado realizados por el servidor
		dom: 'Bfrtip', //Definimos los elementos del control de la tabla
		buttons: [
		
		],
		"ajax":
		{
			url: '../ajax/usuarios.php?op=listar',
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

//Función para guardar y editar
function guardaryeditarU()
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarUsuarios").prop("disabled",true);
	var  formData = new FormData($("#formEditUsuario")[0]);
	
	$.ajax({
		url: "../ajax/usuarios.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			bootbox.alert(datos);
			mostrarformUsuarios(false);
			$("#btnGuardarUsuarios").prop("disabled",false);
			tablaU.ajax.reload();
			tablaDP.ajax.reload();
			tablaIN.ajax.reload();
		}	
		
	});
	limpiar();
}

//Función para llenar los campos del formulario del modal Editar Usuario
function mostrarU(idusuario)
{
	$.post("../ajax/usuarios.php?op=mostrar", {idusuario : idusuario}, function(data, status)
	{
		data = JSON.parse(data);
		$("#btnagregarUsuario").trigger("click");
		
		$("#n_usuario").val(data.n_usuario);
		$("#c_usuario").val(data.c_usuario);
		$("#idusuario").val(data.idusuario);
	});	
}

//Función para desactivar un usuario
function desactivarU(idusuario)
{
	bootbox.confirm("¿Estas seguro de desactivar a este usuario?", function(result){
		if(result)
		{
			$.post("../ajax/usuarios.php?op=desactivar", {idusuario : idusuario}, function(e){
				bootbox.alert(e);
				tablaU.ajax.reload();
				tablaDP.ajax.reload();
				tablaIN.ajax.reload();
			});
		}
	})
}

//Función para activar un usuario
function activarU(idusuario)
{
	bootbox.confirm("¿Estas seguro de activar a este usuario?", function(result) {
		if (result) {
			$.post("../ajax/usuarios.php?op=activar", {idusuario : idusuario}, function(e) {
				bootbox.alert(e);
				tablaU.ajax.reload();
				tablaDP.ajax.reload();
				tablaIN.ajax.reload();
			});
		}
	})
}

//Función para eliminar un usuario
function eliminarU(idusuario)
{
	bootbox.confirm("¿Estas seguro de eliminar este usuario?", function(result) {
		if (result) {
			$.post("../ajax/usuarios.php?op=eliminar", {idusuario : idusuario}, function(e) {
				bootbox.alert(e);
				tablaU.ajax.reload();
				tablaDP.ajax.reload();
				tablaIN.ajax.reload();
			});
		}
	})
}

//Funcion limpiar
function limpiarU()
{
	$("#idusuario").val("");
	$("#n_usuario").val("");
	$("#c_usuario").val("");
}

init();