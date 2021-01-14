<?php
require 'header.php';
?>


<div class="container col-lg-10 col-md-12">
	<section id="inputs" class="text-center">


		
		<div class="row">
			<div class="col-12"><!---mb espaciado-->
				<div class="md-form">
					<input class="form-control" type="text" id="n_negocio" name="n_negocio" maxlength="45" required>
					<input type="hidden" name="idinfo_negocio" id="idinfo_negocio">
					<input type="hidden" name="idpersonal2" id="idpersonal2">
					<label for="n_negocio" class="">Nombre del Negocio:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="md-form">
					<input class="form-control" type="text" id="ref_negocio" name="ref_negocio" maxlength="45" required>
					<label  for="ref_negocio" class="">Referencia del negocio:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="md-form">
					<input class="form-control" type="text" id="rfc_negocio" name="rfc_negocio" maxlength="13" onkeyup="mayusculas(this);">
					<label  for="rfc_negocio" class="">RFC:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container">
				<label>Imagen Carousel</label>
			</div>
			<div class="col-md-4">
				<div class="md-form">					
					<div class="file-field medium">
						<div class="btn btn-rounded blue-gradient btn-sm btn-block">
							<i class="fas fa-image fa-3x"></i>
							<input type="file" name="url_imagen1" id="url_imagen1" onchange="validarImagen1()">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="md-form">
					<span>Seleccione una imagen .png, .jpg, .jpeg de 1200px X 600px</span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="md-form">
					<input type="hidden" name="imagenactual1" id="imagenactual1"/>
					<img src=""	width="150px" height="120px" id="imagenmuestra1"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container">
				<label>Imagen Tarjeta</label>
			</div>
			<div class="col-md-4">
				<div class="md-form">					
					<div class="file-field medium">
						<div class="btn btn-rounded blue-gradient btn-sm btn-block">
							<i class="fas fa-image fa-3x"></i>
							<input type="file" name="url_imagen2" id="url_imagen2" onchange="validarImagen2()">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="md-form">
					<span>Seleccione una imagen .png, .jpg, .jpeg de 200px X 300px</span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="md-form">
					<input type="hidden" name="imagenactual2" id="imagenactual2"/>
					<img src=""	width="150px" height="120px" id="imagenmuestra2"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="md-form">
					<select class="mdb-select md-form colorful-select dropdown-info" name="tipo_negocio" id="tipo_negocio" required>
						<option value="PRODUCTOS">Productos</option>
						<option value="SERVICIOS">Servicios</option>
					</select>			
					<label class="mdb-main-label">Tipo de negocio:</label>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="md-form">
					<select class="mdb-select md-form colorful-select dropdown-info" name="id_giro" id="id_giro" required>
					</select>
					<label class="mdb-main-label">Giro del negocio:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="md-form">
					<select class="mdb-select md-form colorful-select dropdown-info" name="tipo_servicio" id="tipo_servicio" required>
						<option value="Sólo en local">Sólo en local</option>
						<option value="Sólo a domicilio">Sólo a domicilio</option>
						<option value="En local y a domicilio">Ambos</option>
					</select>			
					<label class="mdb-main-label">Servicio de entrega:</label>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="md-form" id="t_pagos">
					
				</div>
			</div>
		</div>
	</section>
</div>

<?php
require 'footer.php';
?>