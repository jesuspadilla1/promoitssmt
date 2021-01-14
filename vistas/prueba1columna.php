<?php
require 'header.php';
?>


<div class="container col-lg-10 col-md-12">
	<section id="inputs" class="text-center">

		<!--Section heading-->
		<h3 class="section-heading mb-5  h1 mt-0">Datos personales</h3>

		
		<div class="row">
			<div class="col-12"><!---mb espaciado-->
				<div class="md-form">
					<input class="form-control" type="text" id="correo_n" name="correo_n" maxlength="45" placeholder="Escribe el correo electrónico de tu negocio.">
					<input type="hidden" name="idredes_sociales" id="idredes_sociales">
					<label for="correo_n" class="active">Correo Electrónico:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="md-form">
					<input class="form-control" type="tel" id="num_local" name="num_local" maxlength="10" placeholder="Escribe el número teléfonico de tu negocio.">
					<label  for="num_local" class="active">Número de teléfono local:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="md-form">
					<input class="form-control" type="tel" id="num_whats" name="num_whats" maxlength="10" placeholder="Escribe el número de WhatsApp de tu negocio.">
					<label  for="num_whats" class="active">Número de WhatsApp:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="md-form">
					<input class="form-control" type="text" id="dir_face" name="dir_face" maxlength="100" placeholder="Por ejemplo: https://www.facebook.com/TecNMSanMartinTexmelucan/">
					<label  for="dir_face" class="active">Perfil de Facebook:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="md-form">
					<input class="form-control" type="text" id="dir_twiter" name="dir_twiter" maxlength="100" placeholder="Por ejemplo: https://twitter.com/TecNMSanMartinT">
					<label  for="dir_twiter" class="active">Perfil Twitter:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="md-form">
					<input class="form-control" type="text" id="dir_insta" name="dir_insta" maxlength="100" placeholder="Por ejemplo: https://www.instagram.com/tecnm_sanmartin/">
					<label  for="dir_insta" class="active">Perfil de Instagram:</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="md-form">
					<input class="form-control" type="text" id="otro" name="otro" maxlength="100" placeholder="Coloca en link de tu sitio web o tienda en linea.">
					<label  for="otro" class="active">Otro:</label>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
require 'footer.php';
?>