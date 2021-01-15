<?php
require 'header.php';
?>


<div class="container col-lg-10 col-md-12">
	<section id="inputs" class="text-center">

		<!--Section heading-->
		<h3 class="section-heading mb-5  h1 mt-0">Datos personales</h3>

		
		<div class="row">
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control" type="text" id="nombres" name="nombres" maxlength="20" required>
					<input type="hidden" name="idpersonal" id="idpersonal">
					<input type="hidden" name="idusuario" id="idusuario">
					<label for="nombres" class="">Nombre (s):</label>
				</div>
			</div>
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control form-control-sm" type="text" id="a_paterno" name="a_paterno" maxlength="20" required>
					<label  for="a_paterno" class="">Apellido Paterno:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control form-control-sm" type="text" id="a_materno" name="a_materno" maxlength="20" required>
					<label for="a_materno" class="">Apellido Materno:</label>
				</div>
			</div>
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control form-control-sm" type="text" id="rfc_usuario" name="rfc_usuario" maxlength="13">
					<label for="rfc_usuario" class="">RFC:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control form-control-sm" type="text" id="n_telefono" name="n_telefono" maxlength="10">
					<label for="n_telefono">Número Teléfonico:</label>
				</div>
			</div>			
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control form-control-sm" type="text" id="correo_usu" name="correo_usu" maxlength="60" required>
					<label for="correo_usu">Correo Electrónico:</label>
				</div>
			</div>
		</div>
		<div class="row">	
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control form-control-sm" type="text" id="n_usuario" name="n_usuario" maxlength="15" required>
					<label for="n_usuario">Nombre de Usuario:</label>
				</div>
			</div>
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control form-control-sm" type="text" id="c_usuario" name="c_usuario" maxlength="15" required>
					<label for="c_usuario">Contraseña:</label>
				</div>
			</div>
		</div>
		

	</section>
</div>

<?php
require 'footer.php';
?>