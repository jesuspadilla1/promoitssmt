var id;
var cantidad;

//Función que se ejecuta al inicio
function initD()
{

	id=$('input[name=negocio2]').val();
	mostrarD(id);

	$("#codigo_p").keyup(function () {
		cantidad = $("#codigo_p").val().length;
		contador();
	});

	//Se cargan lla colonia al select
	$.post("../ajax/info_negocio.php?op=selectColonia&negocio="+id, function(r) {
		$("#colonia").html(r);
	})

}

function contador()
{
	if(cantidad == 5)
	{
		var api = "https://api-sepomex.hckdrk.mx/query/info_cp/";
		var codigo = $("#codigo_p").val();
		var url_codigo = api + codigo;
		$("#colonia").empty();
			var data;
			$.ajax({
				url: url_codigo,
				type: 'GET',
				data: { changed: JSON.stringify(data)},
				success: function(data) {
					for(var i=0; i<data.length;i++){
						$('#colonia').append('<option value="'+data[i].response.asentamiento+'">'+data[i].response.asentamiento+'</option>');
					}
					$("#estado").val(data[0].response.estado);
					$("#municipio").val(data[0].response.municipio);
					$("#lb16").addClass('active');
					$("#lb17").addClass('active');
					//console.log(data);
				},
				error: function(data) {
					bootbox.alert(data.responseJSON.error_message);
					$("#colonia").val("");
					$("#estado").val("");
					$("#municipio").val("");
					$("#lb16").removeClass('active');
					$("#lb17").removeClass('active');
					$("#colonia").empty();
				}
			});
		}
	}







//Función para guardar y editar
function guardaryeditarD()
{
	//e.prevenDefault(); //No se  activará la acción predeterminada del evento
	$("#btnGuardarD").prop("disabled",true);
	$("#estado").removeAttr("disabled");
	$("#municipio").removeAttr("disabled");
	var  formData = new FormData($("#formDatosNDireccion")[0]);
	
	$.ajax({
		url: "../ajax/direccion.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		
		success: function(datos)
		{
			bootbox.alert(datos);
			mostrarD(id);
			$("#btnGuardarD").prop("disabled",false);
			$("#municipio").attr("disabled", "disabled");
			$("#municipio").attr("disabled", "disabled");
		}	
		
	});
}

//Función para llenar los campos del formulario del modal Editar Usuario
function mostrarD(idinfo_negocio)
{
	$.post("../ajax/direccion.php?op=mostrar", {idinfo_negocio : idinfo_negocio}, function(data, status)
	{
		data = JSON.parse(data);

		
		$("#idinfo_negocio").val(data.idneg);
		$("#idlocalidad").val(data.idloc);
		$("#calle").val(data.cal);
		$("#numero").val(data.num);
		$("#codigo_p").val(data.cod);
		$("#colonia").val(data.col);
		$("#estado").val(data.est);
		$("#municipio").val(data.mun);
		$("#iddireccion").val(data.iddir);
		if(data.cal!=''){
			$("#lb12").addClass('active');
		}
		if(data.num!=''){
			$("#lb13").addClass('active');
		}
		if(data.cod!=''){
			$("#lb14").addClass('active');
		}
		if(data.col!=''){
			$("#lb15").addClass('active');
		}
		if(data.mun!=''){
			$("#lb16").addClass('active');
		}
		if(data.est!=''){
			$("#lb17").addClass('active');
		}
	});	
}

initD();