<?php
require 'header.php';
?>


<div class="container col-lg-12 col-md-12">
	<section id="inputs" class="text-left">

		<div id="secDias" class="card-deck">
			<!-- Card Lunes-->
			<div class="card mb-4">
				<!--Card content-->
				<div class="card-body">
					<!--Title-->
					<h4 class="card-title" for="lunes">Lunes</h4>
					<!--Text-->
					<div id="horLunes">
						<div class="form-group">
							<label>Apertura:</label>
							<input class="form-control" type="time" id="he_lun" name="he_lun" />
						</div><!--Apertura -->
						<div class="form-group">
							<label>Comida:</label>
							<input class="form-control" type="time" id="hc_lun" name="hc_lun" />
						</div>
						<div class="form-group">
							<label>Cierre:</label>
							<input class="form-control" type="time" id="hs_lun" name="hs_lun" />
						</div>
					</div>
					<div class="form-check form-check-inline col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button type="button" class="btn btn-outline-default btn-rounded z-depth-0 my-4 waves-effect">Mismo horario Lunes a Viernes
						</button>
					</div>
				</div>
			</div>
			<!-- Card -->

			<!-- Card Martes -->
			<div class="card mb-4">
				<!--Card content-->
				<div class="card-body">
					<!--Title-->
					<h4 class="card-title" for="martes">Martes</h4>
					<!--Text-->
					<div id="horMartes">
						<div class="form-group">
							<label>Apertura:</label>
							<input class="form-control" type="time" id="he_mar" name="he_mar" />
						</div>
						<div class="form-group">
							<label>Comida:</label>
							<input class="form-control" type="time" id="hc_mar" name="hc_mar" />
						</div>
						<div class="form-group">
							<label>Cierre:</label>
							<input class="form-control" type="time" id="hs_mar" name="hs_mar" /><br />
						</div>
					</div>
				</div>
			</div>
			<!-- Card -->

			<!-- Card Miercoles-->
			<div class="card mb-4">
				<!--Card content-->
				<div class="card-body">
					<!--Title-->
					<h4 class="card-title" for="miercoles">Miércoles</h4>
					<!--Text-->
					<div id="horMiercoles">
						<div class="form-group">
							<label>Apertura:</label>
							<input class="form-control" type="time" id="he_mie" name="he_mie" />
						</div>
						<div class="form-group">
							<label>Comida:</label>
							<input class="form-control" type="time" id="hc_mie" name="hc_mie" />
						</div>
						<div class="form-group">
							<label>Cierre:</label>
							<input class="form-control" type="time" id="hs_mie" name="hs_mie" /><br />
						</div>
					</div>
				</div>
			</div>
			<!-- Card -->

			<!-- Card Jueves-->
			<div class="card mb-4">
				<!--Card content-->
				<div class="card-body">
					<!--Title-->
					<h4 class="card-title" for="jueves">Jueves</h4>
					<!--Text-->
					<div id="horJueves">
						<div class="form-group">
							<label>Apertura:</label>
							<input class="form-control" type="time" id="he_jue" name="he_jue" />
						</div>
						<div class="form-group">
							<label>Comida:</label>
							<input class="form-control" type="time" id="hc_jue" name="hc_jue" />
						</div>
						<div class="form-group">
							<label>Cierre:</label>
							<input class="form-control" type="time" id="hs_jue" name="hs_jue" /><br />
						</div>
					</div>
				</div>
			</div>
			<!-- Card -->

			<!-- Card Viernes-->
			<div class="card mb-4">
				<!--Card content-->
				<div class="card-body">
					<!--Title-->
					<h4 class="card-title" for="viernes">Viernes</h4>
					<!--Text-->
					<div id="horViernes">
						<div class="form-group">
							<label>Apertura:</label>
							<input class="form-control" type="time" id="he_vie" name="he_vie" />
						</div>
						<div class="form-group">
							<label>Comida:</label>
							<input class="form-control" type="time" id="hc_vie" name="hc_vie" />
						</div>
						<div class="form-group">
							<label>Cierre:</label>
							<input class="form-control" type="time" id="hs_vie" name="hs_vie" />
						</div>
					</div>
				</div>
			</div>
			<!-- Card -->

			<div class="card mb-4">
				<!--Card content-->
				<div class="card-body">
					<!--Title-->
					<h4 class="card-title" for="sabado">Sábado</h4>
					<!--Text-->
					<div id="horSabado">
						<div class="form-group">
							<label>Apertura:</label>
							<input class="form-control" type="time" id="he_sab" name="he_sab" />
						</div>
						<div class="form-group">
							<label>Comida:</label>
							<input class="form-control" type="time" id="hc_sab" name="hc_sab" />
						</div>
						<div class="form-group">						<label >Cierre:</label>
							<input class="form-control" type="time" id="hs_sab" name="hs_sab" /><br />
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-4">
				<!--Card content-->
				<div class="card-body">
					<!--Title-->
					<h4 class="card-title" for="domingo">Domingo</h4>
					<!--Text-->
					<div id="horDomingo">
						<div class="form-group">
							<label>Apertura:</label>
							<input class="form-control" type="time" id="he_dom" name="he_dom" />
						</div>
						<div class="form-group">
							<label>Comida:</label>
							<input class="form-control" type="time" id="hc_dom" name="hc_dom" />
						</div>
						<div class="form-group">
							<label>Cierre:</label>
							<input class="form-control" type="time" id="hs_dom" name="hs_dom" /><br />
						</div>
					</div>
				</div>
			</div>
			<!-- Card -->
		</div>
		<div class="form-check form-check-inline col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<button type="button" class="btn btn-outline-default btn-rounded z-depth-0 my-4 waves-effect"> Guardar Información
			</button>
		</div>
		
		
	</section>
</div>

<?php
require 'footer.php';
?>