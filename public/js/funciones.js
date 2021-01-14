function init(){

	inicializarSelect();	

}

function inicializarSelect(){
	// Inicialización de Select Tipo de negocio
	$(document).ready(function() {
		$('.mdb-select').materialSelect();
	});
}

init();