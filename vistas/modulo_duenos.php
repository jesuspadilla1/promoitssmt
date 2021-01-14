<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
$per = $_SESSION['idpersonal'];
$nego = $_SESSION['idinfo_negocio'];
$tipo = $_SESSION['tipo_negocio'];

if (!isset($_SESSION["n_usuario"])) {
	header("location: login.php");
}
else
{
	require 'header.php';

	if ($_SESSION['n_usuario']!='admin')
	{
		?>
		<strong class="nav-link text-right"><?php echo $_SESSION['nombre']; ?></strong>


		<!--ENCABEZADO DEL CUERPO DE LA PAGINA-->
		<nav class="card-header navar navbar-expand-lg navbar navbar-dark secondary-color py-4 justify-content-start" id="menuBotones">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon "></span>
			</button>
			<div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo03">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="mostrarSeccion1(true)">DATOS PERSONALES</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="mostrarSeccion2(true)">DATOS DEL NEGOCIO</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="mostrarSeccion8(true)">BÚSQUEDA DE INSUMOS</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="mostrarSeccion9(true)">NEGOCIOS</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../ajax/usuarios.php?op=salir">CERRAR SESIÓN</a>
					</li>
				</ul>
			</div>
		</nav>

		

		<!-- Datos del negocio-->
		<div class="card personales">
			<!--Main content-->
			<div class="content">
				<div class="row">
					<div class="col-md-12"><!--todas las secciones -->
						<div class="box">
							<div id="menuDatosNegocio">
								<nav class="navbar navbar-expand-lg navbar-dark primary-color py-3">
									<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo04" aria-controls="navbarTogglerDemo04" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon "></span>
									</button>
									<a class="navbar-brand white-text" href="#">Datos del negocio</a>
									<div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo04">
										<ul class="navbar-nav mr-auto"><!-- class="nav md-pills nav-justified pills-cyan"  ---class="navbar-nav" ---- class="nav nav-tabs">-->
											<li class="nav-item">
												<a class="nav-link active" href="#" onclick="mostrarSeccion2(true)">INFORMACIÓN</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#" onclick="mostrarSeccion3(true)">DIRECCIÓN</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#" onclick="mostrarSeccion4(true)">HORARIOS</a>
											</li>
											<li class="nav-item" id="tipo_bd">
												<a class="nav-link" href="#" onclick="mostrarSeccion6(true)">SERVICIOS</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#" onclick="mostrarSeccion7(true)">REDES SOCIALES</a>
											</li>
										</ul>
									</div>
								</nav>
							</div><!---se quito a las secciones 1-9 ----class="card personales panel-body"------>
							<!--Formulario Datos personales-->
							<div id="seccion1">
								<h4 class="card-header text-left py-4 info-color white-text">Datos personales</h4>
								<input type="hidden" name="id" id="id" value=<?php echo $per ?>>
								<input type="hidden" name="tip" id="tip">
								<!--Card content-->
								<div class="card-body container col-lg-10 col-md-12"> 
									<!-- Form -->
									<form id="formDatosPer" method="post">
										<div class="row">
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="nombres" name="nombres" maxlength="20" required>
													<input type="hidden" name="idpersonal" id="idpersonal">
													<input type="hidden" name="idusuario" id="idusuario">
													<label for="nombres" class="" id="lb1">Nombre (s):</label>
												</div>
											</div>
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="a_paterno" name="a_paterno" maxlength="20" required>
													<label  for="a_paterno" class="" id="lb2">Apellido Paterno:</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="a_materno" name="a_materno" maxlength="20" required>
													<label for="a_materno" class="" id="lb3">Apellido Materno:</label>
												</div>
											</div>
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="rfc_usuario" name="rfc_usuario" maxlength="13" onkeyup="mayusculas(this);">
													<label for="rfc_usuario" class=""  id="lb4">RFC:</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="n_telefono" name="n_telefono" maxlength="10">
													<label for="n_telefono" id="lb5">Número Teléfonico:</label>
												</div>
											</div>			
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="correo_usu" name="correo_usu" maxlength="60" required>
													<label for="correo_usu" id="lb6">Correo Electrónico:</label>
												</div>
											</div>
										</div>
										<div class="row">	
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="n_usuario" name="n_usuario" maxlength="15" required>
													<label for="n_usuario" id="lb7">Nombre de Usuario:</label>
												</div>
											</div>
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="c_usuario" name="c_usuario" maxlength="15" required>
													<label for="c_usuario" id="lb8">Contraseña:</label>
												</div>
											</div>
										</div>
										<div class="form-group col-lg-11 col-md-11 col-sm-12 col-xs-12 d-flex justify-content-center">
											<button class="btn btn-outline-info btn-rounded" onclick="guardaryeditarDP()" id="btnGuardarDP">Guardar Información</button>
										</div>
									</form> <!-- Form -->
								</div>
							</div>
							<!--Fin Formulario Datos Personales -->

							<!--Formulario Información del negocio-->
							<div id="seccion2" >
								<h4 class="card-header text-left py-4 info-color white-text">Información del negocio</h4>
								<input type="hidden" name="negocio" id="negocio" value=<?php echo $nego ?>>
								<div class="card-body container col-lg-10 col-md-12">
									<form class="" id="formDatosNInformacion" method="post">
										<div class="row">
											<div class="col-12"><!---mb espaciado-->
												<div class="md-form">
													<input class="form-control" type="text" id="n_negocio" name="n_negocio" maxlength="45" required>
													<input type="hidden" name="idinfo_negocio" id="idinfo_negocio">
													<input type="hidden" name="idpersonal2" id="idpersonal2">
													<label for="n_negocio" class="" id="lb9">Nombre del Negocio:</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="md-form">
													<input class="form-control" type="text" id="ref_negocio" name="ref_negocio" maxlength="45" required>
													<label  for="ref_negocio" class="" id="lb10">Referencia del negocio:</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="md-form">
													<input class="form-control" type="text" id="rfc_negocio" name="rfc_negocio" maxlength="13" onkeyup="mayusculas(this);">
													<label  for="rfc_negocio" class="" id="lb11">RFC:</label>
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
												<div class="md-form text-center">
													<span>Seleccione una imagen .png, .jpg, .jpeg de 1200px X 600px</span>
												</div>
											</div>
											<div class="col-md-4">
												<div class="md-form">
													<input type="hidden" name="imagenactual1" id="imagenactual1">
													<div class="d-flex justify-content-center">
														<img src=""	width="150px" height="120px" id="imagenmuestra1">
													</div>
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
												<div class="md-form text-center">
													<span>Seleccione una imagen .png, .jpg, .jpeg de 200px X 300px</span>
												</div>
											</div>
											<div class="col-md-4">
												<div class="md-form">
													<input type="hidden" name="imagenactual2" id="imagenactual2">
													<div class="d-flex justify-content-center">
														<img src=""	width="150px" height="120px" id="imagenmuestra2">
													</div>
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
													<select class="form-control largos" name="idgiro" id="idgiro" required>
													</select>
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
											<div class="checkbox-group required col-lg-6 col-md-6 col-sm-12">
												<div class="md-form" id="t_pagos">
												</div>
											</div>
										</div>
										<div class="form-group row col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center">
											<button class="btn btn-outline-primary btn-rounded" onclick="guardaryeditarIN(); return false;" id="btnGuardarIN">Guardar Información</button>
										</div>
									</form>
								</div>
							</div>		
							<!--Fin Formulario Información del negocio-->

							<!--Formulario Dirección del negocio-->
							<div id="seccion3" >
								<h4 class="card-header text-left py-4 info-color white-text">Dirección del Negocio</h4>
								<input type="hidden" name="negocio2" id="negocio2" value=<?php echo $nego ?>>
								<!--Card content-->
								<div class="card-body container col-lg-10 col-md-12"> 
									<!-- Form -->
									<form id="formDatosNDireccion" method="post">
										<div class="row">
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="calle" name="calle" maxlength="45" required>
													<input type="hidden" name="iddireccion" id="iddireccion">
													<label for="iddireccion" id="lb12">Calle: *</label>
												</div>
											</div>
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="number" id="numero" name="numero" maxlength="10" required>
													<label for="numero" id="lb13">Número: *</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="tel" id="codigo_p" name="codigo_p" maxlength="5" required>
													<label for="codigo_p" id="lb14">Código Postal: *</label>
												</div>
											</div>
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<select class="mdb-select md-form colorful-select dropdown-info" name="colonia" id="colonia" required>
													</select>
													<label for="colonia" id="lb15">Colonia: *</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="municipio" name="municipio" maxlength="45" required disabled>
													<label for="municipio" class="disabled" id="lb16">Municipio: *</label>
												</div>
											</div>			
											<div class="col-md-6 mb-4">
												<div class="md-form">
													<input class="form-control" type="text" id="estado" name="estado" maxlength="45" required disabled>
													<label for="estado" class="disabled" id="lb17">Estado: *</label>
												</div>
											</div>
										</div>	

										<div class="form-group col-lg-11 col-md-11 col-sm-12 col-xs-12 justify-content-center text-center">
											<button class="btn btn-outline-info btn-rounded" onclick="guardaryeditarD()" id="btnGuardarD">Guardar Información
											</button>
										</div>
									</form>
								</div>
								<!-- Form -->
							</div>
							<!--Fin Formulario Direccion del negocio-->

							<!--Formulario Horarios del negocio-->
							<div id="seccion4">
								<h4 class="card-header text-left py-4 info-color white-text">Horario y Días de Atención del Negocio</h4><br />
								<!--<label class="text-center col-12">Días de atención entre semana</label><br />-->
								<div class="card-body container col-lg-12 col-md-12">
									<form id="formDatosNHorario" method="post" class="form-inline">
										<input type="hidden" name="iddias_horario" id="iddias_horario">

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
													<div class="row">
														<button type="button" class="btn  btn-rounded z-depth-0 my-4 waves-effect badge badge-primary text-wrap" onclick="copiarHorarios();">Mismo horario de Lunes a Viernes
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
											<button type="button" class="btn btn-outline-default btn-rounded z-depth-0 my-4 waves-effect" onclick="guardaryeditarHor()" id="btnGuardarHor"> Guardar Información
											</button>
										</div>
									</form>
								</div>
							</div>
							<!--Fin Formulario Horarios del negocio-->

							<!--Formulario Productos del negocio-->
							<div id="seccion5" >
								<h4 class="card-header text-left py-4 info-color white-text">Registro de Productos</h4>
								<div class="card-body container col-lg-10 col-md-12">
									<form id="formDatosNProductos" method="post">
										<div class="row">
											<div class="col-12">
												<div class="md-form">
													<input type="hidden" name="idinfo_negocio2" id="idinfo_negocio2" value=<?php echo $nego ?>>
													<input type="hidden" name="idproductos" id="idproductos">
													<input class="form-control" type="text" id="n_producto" name="n_producto" maxlength="45" required>
													<label for="nombre_neg" class="" id="lb18">Nombre del Producto: *</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="md-form">
													<input class="form-control" type="text" id="m_producto" name="m_producto" maxlength="45" required>
													<label for="nombre_neg" class="" id="lb19">Descripión del Producto: *</label>
													<div class="text-right">
														<button  class="btn btn-outline-info btn-rounded" onclick="guardaryeditarPro()" id="btnGuardarPro">Guardar Producto</button>
														<button class="btn btn-outline-success btn-rounded" onclick="limpiarPro()">Limpiar</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="row">
									<div class="col-md-10 mx-auto">
										<table id="tbllistadoProductos" class="table table-striped table-bordered table-condensed table-hover text-center table table-responsive-md" style="width: 100%;">
											<thead>
												<th class="text-center">Nombre de producto</th>
												<th class="text-center">Descripción del producto</th>
												<th class="text-center">Modificar</th>
												<th class="text-center">Eliminar</th>
											</thead>

											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!--Fin Formulario Productos del negocio-->

							<!--Formulario Servicios del negocio-->
							<div id="seccion6" >
								<h4 class="card-header text-left py-4 info-color white-text">Registro de Servicios</h4>
								<div class="card-body container col-lg-10 col-md-12">
									<form id="formDatosNServicios" method="post">
										<div class="row">
											<div class="col-12">
												<div class="md-form">
													<input type="hidden" name="idinfo_negocio3" id="idinfo_negocio3" value=<?php echo $nego ?>>
													<input type="hidden" name="idservicio" id="idservicio">
													<input class="form-control" type="text" id="n_servicio" name="n_servicio" maxlength="45" required>
													<label for="nombre_neg" class="" id="lb20">Nombre del Servicio: *</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												<div class="md-form">
													<div class="md-form">
														<textarea  id="d_servicio" name="d_servicio" class="md-textarea form-control" rows="2"></textarea>
														<label for="d_servicio" class="" id="lb21">Descripción del Servicio: *</label>
													</div>
													<div class="text-right">
														<button  class="btn btn-outline-info btn-rounded" onclick="guardaryeditarSer()" id="btnGuardarSer">Guardar Servicio</button>
														<button class="btn btn-outline-success btn-rounded" onclick="limpiarSer()">Limpiar</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="row">
									<div class="col-md-10 mx-auto">
										<table id="tbllistadoServicios" class="table table-striped table-bordered table-condensed table-hover text-center table table-responsive-md" style="width: 100%;"><br>
											<thead>
												<th class="text-center">Nombre de servicio</th>
												<th class="text-center">Descripción del servicio</th>
												<th class="text-center">Modificar</th>
												<th class="text-center">Eliminar</th>
											</thead>

											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!--Fin Formulario Servicios del negocio-->

							<!--Formulario Redes Sociales del Negocio-->
							<div id="seccion7" >
								<h4 class="card-header text-left py-4 info-color white-text">Redes Sociales</h4>
								<div class="card-body container col-lg-10 col-md-12">
									<form id="formDatosNRedes" method="post"><br />
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
										<div class="form-group col-lg-11 col-md-11 col-sm-12 col-xs-12 justify-content-end" style="padding-top: 10px; padding-bottom: 15px;">
											<button class="btn btn-outline-default btn-rounded" onclick="guardaryeditarRS()" id="btnGuardarRS">Guardar Información</button>
										</div>
									</form>
								</div>
							</div>
							<!--Fin Formulario Redes Sociales del Negocio-->

							<!--Formulario Busqueda de Insumos-->
							<div id="seccion8">
								<h4 class="card-header text-left py-4 info-color white-text">Búsqueda de insumos</h4>
								<div class=""><!--row-->
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										<table id="tbllistadoInsumos" class="table table-striped table-bordered table-condensed table-hover table table-responsive text-center" style="width: 100%;">
											<thead><br>
												<tr>
													<th class="text-center" rowspan="2">Nombre</th>
													<th class="text-center" rowspan="2">Descripción / Marca</th>
													<th class="text-center" rowspan="2">Nombre Negocio</th>
													<th class="text-center" rowspan="2">Dirección</th>
													<th class="text-center" rowspan="2">Teléfono</th>
													<th class="text-center" colspan="7">Horarios</th>
												</tr>
												<tr>
													<th class="text-center">Lunes</th>
													<th class="text-center">Martes</th>
													<th class="text-center">Miercoles</th>
													<th class="text-center">Jueves</th>
													<th class="text-center">Viernes</th>
													<th class="text-center">Sabado</th>
													<th class="text-center">Domingo</th>
												</tr>
											</thead>

											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!--Fin Formulario Busqueda de Insumos-->



							<!--Modal de formulario para agregar Negocios-->
							<div class="modal fade" id="ventanaAgregarNegocio" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true" align="center" >
								<div class="modal-dialog modal-notify modal-info" role="document">
									<!--Inicio de encabezado-->
									<div class="modal-content">
										<div class="modal-header text-center">
											<h5 class="modal-title w-100 white-text" id="tituloVentana">Agregar Negocio</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true" class="white-text">&times;</span>
											</button>
										</div>
										<!--Fin inicio de encabezado-->
										<!--Cuerpo de encabezado-->
										<form class="form-inline" id="formAgreNego" method="post">
											<div class="modal-body mx-3" id="formulario">
												<div class="md-form mb-5" id="formIniciarS" method="post">
													<label class="control-label text-default col-md-6">Nombre Negocio</label>
													<input class="form-control text-info col-md-8" type="text" id="n_negocio2" name="n_negocio2" maxlength="55" required/>
												</div>
												<!--Fin cuerpo de encabezado-->
												<!--Inicio pie de encabezado-->
												<div class="modal-footer d-flex justify-content-center">
													<button class="btn btn-outline-default btn-rounded"  id="btnGuardarNegocio" onclick="guardarNegocio(); return false;">Guardar</button>
												</div>
											</div> <br /><br />
											<!--Fin Modal de inicio de sesión-->
										</form>
									</div>
								</div>
							</div>

							<!--Fin Modal de formulario para agregar Negocios-->


							<!--Negocios-->
							<div id="seccion9" >
								<h4 class="card-header text-left py-4 info-color white-text">Negocios</h4>
								<div class=""><!--row-->
									<div class="col-lg-12 justify-content-end text-right mb-3">
										<button class="btn btn-default btn-rounded btn-md waves-effect waves-light" data-toggle="modal" data-target="#ventanaAgregarNegocio" id="btnagregarNegocio">
											<a class="nav-link white-text" href="#" onclick="mostrarformNeg(true)">Agregar</a>
										</button>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										<table id="tblistadoNegocios" class="table table-striped table-bordered table-condensed table-hover table table-responsive-md text-center" style="width: 100%;">
											<thead>
												<th class="text-center">Nombre del negocio</th>
												<th class="text-center">Editar</th>
												<th class="text-center">Eliminar</th>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!--Fin Negocios-->
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
	else
	{
		header("location: modulo_administrador.php");
	}

	require 'footer.php';
	?>
	<script src="scripts/dias_horario.js"></script>
	<script src="scripts/servicios.js"></script>
	<script src="scripts/productos.js"></script>
	<script src="scripts/redes_sociales.js"></script>
	<script src="scripts/info_negocio.js"></script>
	<script src="scripts/direccion.js"></script>
	<script src="scripts/datos_personales.js"></script>
	<script src="scripts/modulo_dueno.js"></script>
	<?php
}
ob_end_flush();

?>