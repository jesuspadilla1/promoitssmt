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
					<input class="form-control" type="text" id="calle" name="calle" maxlength="45" required>
					<input type="hidden" name="iddireccion" id="iddireccion">
					<label>Calle: *</label>
				</div>
			</div>
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control" type="number" id="numero" name="numero" maxlength="10" required>
					<label>Número: *</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control" type="tel" id="codigo_p" name="codigo_p" maxlength="5" required>
					<label>Código Postal: *</label>
				</div>
			</div>
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control" name="colonia" id="colonia" required>
					<label>Colonia: *</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control" type="text" id="municipio" name="municipio" maxlength="45" required>
					<label>Municipio: *</label>
				</div>
			</div>			
			<div class="col-md-6 mb-4">
				<div class="md-form">
					<input class="form-control" type="text" id="estado" name="estado" maxlength="45" required>
					<label>Estado: *</label>
				</div>
			</div>
		</div>
		

	</section>
</div>

<?php
require 'footer.php';
?>