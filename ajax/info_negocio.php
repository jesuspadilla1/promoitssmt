		<?php
	session_start();
	require_once "../modelos/Info_Negocio.php";

	$info_negocio = new Info_Negocio();

	$idinfo_negocio = isset($_POST["idinfo_negocio"])? limpiarCadena($_POST["idinfo_negocio"]):"";
	$idpersonal = isset($_POST["idpersonal2"])? limpiarCadena($_POST["idpersonal2"]):"";
	$idgiro = isset($_POST["idgiro"])? limpiarCadena($_POST["idgiro"]):"";
	$n_negocio = isset($_POST["n_negocio"])? limpiarCadena($_POST["n_negocio"]):"";
	$n_negocio2 = isset($_POST["n_negocio2"])? limpiarCadena($_POST["n_negocio2"]):"";
	$ref_negocio = isset($_POST["ref_negocio"])? limpiarCadena($_POST["ref_negocio"]):"";
	$rfc_negocio = isset($_POST["rfc_negocio"])? limpiarCadena($_POST["rfc_negocio"]):"";
	$url_imagen1 = isset($_POST["url_imagen1"])? limpiarCadena($_POST["url_imagen1"]):"";
	$url_imagen2 = isset($_POST["url_imagen2"])? limpiarCadena($_POST["url_imagen2"]):"";
	$tipo_negocio = isset($_POST["tipo_negocio"])? limpiarCadena($_POST["tipo_negocio"]):"";
	$tipo_servicio = isset($_POST["tipo_servicio"])? limpiarCadena($_POST["tipo_servicio"]):"";

	switch ($_GET["op"]){
		case 'guardaryeditar':
		
		//Imagen de carousel
		if (!file_exists($_FILES['url_imagen1']['tmp_name']) || !is_uploaded_file($_FILES['url_imagen1']['tmp_name']))
		{
			$url_imagen1=$_POST["imagenactual1"];
		}
		else {
			$ext = explode(".", $_FILES["url_imagen1"]["name"]);
			if ($_FILES['url_imagen1']['type'] == "image/jpg" || $_FILES['url_imagen1']['type'] == "image/jpeg" || $_FILES['url_imagen1']['type'] == "image/png")
			{
				$url_imagen1 = round((microtime(true)) . '.' . end($ext));
				move_uploaded_file($_FILES["url_imagen1"]["tmp_name"], "../files/img_negocios_carousel/" .$url_imagen1);
			}
		}


		//Imagen de tarjetas
		if (!file_exists($_FILES['url_imagen2']['tmp_name']) || !is_uploaded_file($_FILES['url_imagen2']['tmp_name']))
		{
			$url_imagen2=$_POST["imagenactual2"];
		}
		else {
			$ext = explode(".", $_FILES["url_imagen2"]["name"]);
			if ($_FILES['url_imagen2']['type'] == "image/jpg" || $_FILES['url_imagen2']['type'] == "image/jpeg" || $_FILES['url_imagen2']['type'] == "image/png")
			{
				$url_imagen2 = round((microtime(true)) . '.' . end($ext));
				move_uploaded_file($_FILES["url_imagen2"]["tmp_name"], "../files/img_negocios_tarjetas/" .$url_imagen2);
			}
		}
		$rspta=$info_negocio->editar($idinfo_negocio, $idpersonal, $idgiro, $n_negocio, $ref_negocio, $rfc_negocio, $url_imagen1, $url_imagen2, $tipo_negocio, $tipo_servicio, $_POST['pago']);
		echo $rspta ? "La información del negocio se actualizó" : "La información del negocio no se pudo actualizar";
		break;




		case 'insertar':

		$idpersonal=$_GET['idpersonal'];
		$rspta=$info_negocio->insertar($idpersonal, $n_negocio2);
		echo $rspta ? "El negocio se agregó correctamente" : "No se pudo agregar el negocio";
		break;
		




		case 'mostrar':
		$rspta=$info_negocio->mostrar($idinfo_negocio);
			//Codificar el resultado utilizando json
		echo json_encode($rspta);
		break;
		





		case 'eliminar':
		$rspta=$info_negocio->eliminar($idinfo_negocio);
		echo $rspta ? "El negocio fue eliminado" : "No se pudo eliminar el negocio";
		break;
		





		case 'listar':
		$rspta=$info_negocio->listar();
			//Declarrar array
		$data= Array();
		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>$reg->idinfo_negocio,
				"1"=>utf8_encode($reg->n_negocio),
				"2"=>utf8_encode($reg->ref_negocio),
				"3"=>utf8_encode($reg->rfc_negocio),
				"4"=>"<img src='../files/img_negocios_carousel/".$reg->url_imagen1."' heigth='50px' width='50px' >",
				"5"=>"<img src='../files/img_negocios_tarjetas/".$reg->url_imagen2."' heigth='50px' width='50px' >",
				"6"=>utf8_encode($reg->tipo_negocio),
				"7"=>utf8_encode($reg->n_giro),
				"8"=>'<button class="btn btn-primary" onclick="moostrar('.$reg->idinfo_negocio.')"><i class="fa fa-pencil"></i></button>',
				"9"=>'<button class="btn btn-danger" onclick="eliminar('.$reg->idinfo_negocio.')"><i class="fa fa-trash"></i></button>'
			);
		}
		$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data),//enviamos el totoal de registros al datatables
				"iTotalDisplayRecords"=>count($data),//Enviamos el total de registros a visualizar
				"aaData"=>$data);
		echo json_encode($results);
		break;




		case 'selectGiro':

		require_once "../modelos/Giro.php";

		$giro = new Giro();

		//se almacena la variable negocio para utilizarla en metodo selectG
		$id=$_GET['negocio'];

		//Se obtiene el giro del negocio logueado
		$select = $info_negocio->selectG($id);

		//Se obtienen todos los giros
		$rspta = $giro->listar();

		//Declaramos el array para almacenar el giro seleccionado
		$gir=array();

		//Se almacena el giro seleccionado por el dueño en el array gir
		while ($g = $select->fetch_object())
		{
			array_push($gir, $g->idgiro);
		}

		echo '<option value="" disabled>Seleccione un giro</option>';

		while ($reg = $rspta->fetch_object())
		{
			$sw=in_array($reg->idgiro, $gir)?'selected="true"' :'';
			echo '<option value='. $reg->idgiro . ' '.$sw.'>' . utf8_encode($reg->n_giro) . '</option>';
		}
		echo '<label class="mdb-main-label">Giro del negocio:</label>';
		break;




		case 'selectGiroP':

		require_once "../modelos/Giro.php";
		
		$giro = new Giro();
		
			//Se obtienen todos los giros
		$rspta = $giro->listarGirosP();
		
		echo '<option value="0">Seleccione un giro</option>';
		
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value='. $reg->idgiro . '>' . utf8_encode($reg->n_giro) . '</option>';
		}
		break;




		case 'selectColonia':

		require_once "../modelos/Direccion.php";
		
		$direccion = new Direccion();
		$id = $_GET['negocio'];

		
		//Se obtiene la colonia 
		$rspta = $direccion->col($id);
		
		while ($reg = $rspta->fetch_object())
		{
			echo '<option value="'. $reg->colonia . '" selected="true">' . $reg->colonia . '</option>';
		}
		break;




		case 'selectGiroS':

		require_once "../modelos/Giro.php";

		$giro = new Giro();

				//Se obtienen todos los giros
		$rspta = $giro->listarGirosS();

		echo '<option value="0">Seleccione un giro</option>';

		while ($reg = $rspta->fetch_object())
		{
			echo '<option value='. $reg->idgiro . '>' . utf8_encode($reg->n_giro) . '</option>';
		}
		break;





		case 'actualizacionG':

		require_once "../modelos/Giro.php";

		$giro = new Giro();

		$opcion = $_POST['giro'];

		if($opcion=='PRODUCTOS')
		{
			$rspta = $giro->listarGirosP();
		} else if($opcion=="SERVICIOS"){
			$rspta = $giro->listarGirosS();
		}

		//se almacena la variable negocio para utilizarla en metodo selectG
		$id=$_GET['negocio'];

		//Se obtiene el giro del negocio logueado
		$select = $info_negocio->selectG($id);

		//Declaramos el array para almacenar el giro seleccionado
		$gir=array();

		//Se almacena el giro seleccionado por el dueño en el array gir
		while ($g = $select->fetch_object())
		{
			array_push($gir, $g->idgiro);
		}

		echo '<option value="0">Seleccione un giro</option>';

		while ($reg = $rspta->fetch_object())
		{
			$sw=in_array($reg->idgiro, $gir)?'selected="true"' :'';
			echo '<option value='. $reg->idgiro . ' '.$sw.'>' . utf8_encode($reg->n_giro) . '</option>';
		}
		break;



		case'tipoSelect':

		$negocio = $_GET['id'];

		$rspta = $info_negocio->tipoSelect($negocio);

		$resultado=array();

		while($res = $rspta->fetch_object())
		{
			array_push($resultado, $res->tipo_negocio);
		}

		if(in_array("PRODUCTOS", $resultado))
		{
			echo '<option value="PRODUCTOS" selected="true">Productos</option>';
			echo '<option value="SERVICIOS">Servicios</option>';
		} else if(in_array("SERVICIOS", $resultado))
		{
			echo '<option value="PRODUCTOS">Productos</option>';
			echo '<option value="SERVICIOS" selected="true">Servicios</option>';
		} else if(in_array("", $resultado))
		{
			echo '<option value="PRODUCTOS">Productos</option>';
			echo '<option value="SERVICIOS">Servicios</option>';
		}

		break;




		case 'obtenerTipo':
		$rspta=$info_negocio->tipo($idinfo_negocio);
			//Codificar el resultado utilizando json
		echo json_encode($rspta);
		break;





		case 'elegirTipo':
		$tipo=$_GET['tipo'];


		if($tipo=="PRODUCTOS"){
			echo '<a class="nav-link" href="#" onclick="mostrarSeccion5(true)">'.$tipo.'</a>';
		} else if ($tipo=="SERVICIOS"){
			echo '<a class="nav-link" href="#" onclick="mostrarSeccion6(true)">'.$tipo.'</a>';
		} else {
			echo '<a class="nav-link" href="#" onclick="mostrarSeccion5(true)">PRODUCTOS / SERVICIOS</a>';
		}

		break;





		case 'pagos':
		//Obtenemos todos los tipos de pagos de la tabla t_pago
		require_once "../modelos/T_Pago.php";
		$pago = new T_Pago();
		$rspta = $pago->listar();

			//Obtener permisos asignados
		$id=$_GET['id'];
		$marcados = $info_negocio->listarpagos($id);
			//Declaramos el array para almacenar todos los pagos marcados
		$valores=array();

			//Almacenar los pagos tipos de pagos asignados al dueño en el array
		while ($pa = $marcados->fetch_object())
		{
			array_push($valores, $pa->idpago);
		}

		
		echo '<label class="mdb-main-label">Tipo pago:</label>';
		echo '<div class="container">';
		
			//Mostramos la lista de pagos en la vista y si estan o no marcados
		while ($reg = $rspta->fetch_object())
		{
			$sw=in_array($reg->idpago, $valores)?'checked' :'';
			echo '<div class="form-check">';
			echo '<ul><input type="checkbox" class="form-check-input filled-in" '.$sw.' id="'.$reg->idpago.'" name="pago[]" value="'.$reg->idpago.'">';
			echo '<label class="form-check-label" for="'.$reg->idpago.'">'.utf8_encode($reg->tipo_pago).'</label>';
			echo '</div>';
		}
		echo '</div>';
		break;





		case 'carousel':
		$rspta=$info_negocio->carousel();
		
		echo '
		<!--BLOQUE DEL  CARRUSELl-->
		<div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
		<!-- Indicators -->
		<ul class="carousel-indicators">';

		$i = 0;
		while($reg = $rspta->fetch_object())
		{
			if($i==0){
				echo '<li data-target="#demo" data-slide-to="'.$i.'" class="active"></li>';
			} else {
				echo '<li data-target="#demo" data-slide-to="'.$i.'"></li>';
			}
			$i++;
		}

		echo '</ul>
		<!-- The slideshow -->
		<div class="carousel-inner" role="listbox">';

		$rspta=$info_negocio->carousel();

		$i = 0;
		while($datos = $rspta->fetch_object())
		{
			if($i==0){
				echo	'<div class="carousel-item active">
				<img src="../files/img_negocios_carousel/'.$datos->url_imagen1.'" class="img-fluid" style="object-fit: cover; width: 100%; height: 600px;">
				<div class="carousel-caption" style="background-image: linear-gradient(rgba(221,228,230, 0.3), rgba(0,0,0,1));">
				<div class="animated fadeInDown">
				<h2 style="color: #ffffff;">'.$datos->n_negocio.'</h2>
				<h4 style="color: #ffffff;">'.utf8_encode($datos->n_giro).'</h4>
				<p style="color: #ffffff;">'.$datos->ref_negocio.'</p>
				</div>
				</div>
				</div>';
			} else {
				echo	'<div class="carousel-item">
				<img src="../files/img_negocios_carousel/'.$datos->url_imagen1.'" class="img-fluid" style="object-fit: cover; width: 100%; height: 600px;">
				<div class="carousel-caption" style="background-image: linear-gradient(rgba(221,228,230, 0.3), rgba(0,0,0,1));">
				<div class="animated fadeInDown">
				<h2 style="color: #ffffff;">'.$datos->n_negocio.'</h2>
				<h4 style="color: #ffffff;">'.utf8_encode($datos->n_giro).'</h4>
				<p style="color: #ffffff;">'.$datos->ref_negocio.'</p>
				</div>
				</div>
				</div>';
			}
			$i++;
		}

		echo '</div>
		<!-- Left and right controls -->
		<a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#demo" role="button" data-slide="next">
		<span class="carousel-control-next-icon"></span>
		</a>
		</div>';
		break;





		case 'consultaProductos':

		sleep(2);
		date_default_timezone_set("America/Mexico_City");

		$giro = $_POST['giro'];
		$n_gir = $_GET['nombre'];

		$rspta = $info_negocio->tarjetas($giro);

		$aux = array();

		while($aux2 = $rspta->fetch_object())
		{
			array_push($aux, $aux2->n_negocio);
		}

		if(sizeof($aux) == 0){
			echo '<div class="alert alert-danger text-center" role="alert">No se encontrarón negocios de '.$n_gir.'</div>';
		} else {

			$rspta = $info_negocio->tarjetas($giro);
			while($reg = $rspta->fetch_object())
			{

				$hc_lun_reg = (intval(substr($reg->hc_lun, -5, 2)) + 01) . substr($reg->hc_lun, -3, 3);
				$hc_mar_reg = (intval(substr($reg->hc_mar, -5, 2)) + 01) . substr($reg->hc_mar, -3, 3);
				$hc_mie_reg = (intval(substr($reg->hc_mie, -5, 2)) + 01) . substr($reg->hc_mie, -3, 3);
				$hc_jue_reg = (intval(substr($reg->hc_jue, -5, 2)) + 01) . substr($reg->hc_jue, -3, 3);
				$hc_vie_reg = (intval(substr($reg->hc_vie, -5, 2)) + 01) . substr($reg->hc_vie, -3, 3);
				$hc_sab_reg = (intval(substr($reg->hc_sab, -5, 2)) + 01) . substr($reg->hc_sab, -3, 3);
				$hc_dom_reg = (intval(substr($reg->hc_dom, -5, 2)) + 01) . substr($reg->hc_dom, -3, 3);
				$hora_actual = date("H:i");
				$estado;

				switch (date("N")){
					case '1':
					if(($hora_actual>$reg->he_lun && $hora_actual<$reg->hs_lun)){
						if(($hora_actual>$reg->hc_lun && $hora_actual<$hc_lun_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '2':
					if(($hora_actual>$reg->he_mar && $hora_actual<$reg->hs_mar)){
						if(($hora_actual>$reg->hc_mar && $hora_actual<$hc_mar_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '3':
					if(($hora_actual>$reg->he_mie && $hora_actual<$reg->hs_mie)){
						if(($hora_actual>$reg->hc_mie && $hora_actual<$hc_mie_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '4':
					if(($hora_actual>$reg->he_jue && $hora_actual<$reg->hs_jue)){
						if(($hora_actual>$reg->hc_jue && $hora_actual<$hc_jue_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '5':
					if(($hora_actual>$reg->he_vie && $hora_actual<$reg->hs_vie)){
						if(($hora_actual>$reg->hc_vie && $hora_actual<$hc_vie_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '6':
					if(($hora_actual>$reg->he_sab && $hora_actual<$reg->hs_sab)){
						if(($hora_actual>$reg->hc_sab && $hora_actual<$hc_sab_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '7':
					if(($hora_actual>$reg->he_dom && $hora_actual<$reg->hs_dom)){
						if(($hora_actual>$reg->hc_dom && $hora_actual<$hc_dom_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

				}

				echo '<div class="card mb-4 mx-auto shadow p-3 mb-5 bg-white rounded" style="max-width: 80%">
				<h4 class="card-header"><strong>'.$reg->n_negocio.'</strong> '.$estado.'</h4>
				<div class="row">
				<div class="col-md-3" style="margin: 3% 3% 3% 3%">
				<img src="../files/img_negocios_tarjetas/'.$reg->url_imagen2.'" class="card-img rounded-circle" alt="..." width="200px" height="300px">
				</div>
				<div class="col-md-8">
				<div class="card-body">
				<p class="card-text"><strong><i class="fa fa-map-signs"  style="font-size: 20px; color:#D2691E;"></i> Referencia:</strong> '.$reg->ref_negocio.'</p>
				<p class="card-text"><strong><i class="fa fa-home" style="font-size: 20px; color:#A0522D"></i> Dirección:</strong> Calle '.$reg->calle.' #'.$reg->numero.', Col. '.$reg->colonia.', C.P. '.$reg->codigo_p.', '.$reg->municipio.', '.$reg->estado.'</p>
				<p class="card-text"><strong><i class="fa fa-phone" style="font-size: 20px; color:#1E90FF;"></i> Teléfono del local:</strong> '.$reg->num_local.'</p>
				<p class="card-text"><strong><i class="fa fa-envelope" style="font-size: 20px; color:#8B0000;"></i> Correo electrónico:</strong> '.$reg->correo_n.'</p>
				<p class="card-text"><strong><i class="fa fa-clock-o" style="font-size: 20px; color:#FF4500;"></i> Horarios</p></strong>
				<table id="horarios" class="table table-responsive table-borderless">
				<tbody style="text-align: right;"> <tr>';

				if($reg->he_lun=='' && $reg->hs_lun==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_lun!='' && $reg->hs_lun!='' && $reg->hc_lun==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;">'.$reg->he_lun.' - '.$reg->hs_lun.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;"> '.$reg->he_lun.' - '.$reg->hc_lun.', '.$hc_lun_reg.' - '.$reg->hs_lun.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_mar=='' && $reg->hs_mar==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_mar!='' && $reg->hs_mar!='' && $reg->hc_mar==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;">'.$reg->he_mar.' - '.$reg->hs_mar.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;">'.$reg->he_mar.' - '.$reg->hc_mar.', '.$hc_mar_reg.' - '.$reg->hs_mar.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_mie=='' && $reg->hs_mie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_mie!='' && $reg->hs_mie!='' && $reg->hc_mie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;">'.$reg->he_mie.' - '.$reg->hs_mie.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;">'.$reg->he_mie.' - '.$reg->hc_mie.', '.$hc_mie_reg.' - '.$reg->hs_mie.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_jue=='' && $reg->hs_jue==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_jue!='' && $reg->hs_jue!='' && $reg->hc_jue==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;">'.$reg->he_jue.' - '.$reg->hs_jue.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;">'.$reg->he_jue.' - '.$reg->hc_jue.', '.$hc_jue_reg.' - '.$reg->hs_jue.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_vie=='' && $reg->hs_vie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_vie!='' && $reg->hs_vie!='' && $reg->hc_vie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;">'.$reg->he_vie.' - '.$reg->hs_vie.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;">'.$reg->he_vie.' - '.$reg->hc_vie.', '.$hc_vie_reg.' - '.$reg->hs_vie.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_sab=='' && $reg->hs_sab==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_sab!='' && $reg->hs_sab!='' && $reg->hc_sab==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;">'.$reg->he_sab.' - '.$reg->hs_sab.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;">'.$reg->he_sab.' - '.$reg->hc_sab.', '.$hc_sab_reg.' - '.$reg->hs_sab.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_dom=='' && $reg->hs_dom==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_dom!='' && $reg->hs_dom!='' && $reg->hc_dom==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;">'.$reg->he_dom.' - '.$reg->hs_dom.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;">'.$reg->he_dom.' - '.$reg->hc_dom.', '.$hc_dom_reg.' - '.$reg->hs_dom.'</td></tr>';
				}

				echo '
				</tbody>
				</table>
				<p class="card-text"><strong><i class="fa fa-truck" style="font-size: 20px; color:#BC8F8F;"></i> Servicio de entrega:</strong> '.$reg->tipo_servicio.'</p>
				<p class="card-text"><strong><i class="fa fa-usd" style="font-size: 20px; color:#8B0000;"></i> Métodos de pago:</p></strong>
				<div>
				<ul>';
				$rspta2 = $info_negocio->listarpagosTarjetas($reg->id);
				while($pagos = $rspta2->fetch_object())
				{
					echo '<li>'.utf8_encode($pagos->nombre_pago).'</li>';
				}

				echo '</ul>
				</div>
				<strong><p class="card-text"><i class="fa fa-globe" style="font-size: 20px; color:#0000CD;"></i> Redes Sociales</p></strong>
				<div>';

				if($reg->dir_face!=''){
					echo '<a href="'.$reg->dir_face.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/face.png" width="30px" height="30px"></a>';
				}
				if($reg->dir_twiter!=''){
					echo '<a href="'.$reg->dir_twiter.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/twiter.png" width="35px" height="35px"></a>';
				}
				if($reg->num_whats!=''){
					echo '<a href="https://api.whatsapp.com/send?phone=52'.$reg->num_whats.'&text=Hola,%20¿qué%20tal?" target="_blank" style="margin-right: 15px;"><img src="../public/img/whatsapp.png" width="42px" height="42px"></a>';
				}
				if($reg->dir_insta!=''){
					echo '<a href="'.$reg->dir_insta.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/insta.png" width="35px" height="35px"></a>';
				}
				if($reg->otro!=''){
					echo '<a href="'.$reg->otro.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/tienda.png" width="35px" height="35px"></a>';
				}
				echo '</div>
				</div>
				</div>   
				</div>
				</div>';
			}
		}

		break;





		case 'consultaServicios':

		sleep(2);
		date_default_timezone_set("America/Mexico_City");

		$giro = $_POST['giro'];
		$n_gir = $_GET['nombre'];

		$rspta = $info_negocio->tarjetas($giro);

		$aux = array();

		while($aux2 = $rspta->fetch_object())
		{
			array_push($aux, $aux2->n_negocio);
		}

		if(sizeof($aux) == 0){
			echo '<div class="alert alert-danger text-center" role="alert">No se encontrarón negocios de '.$n_gir.'</div>';
		} else {

			$rspta = $info_negocio->tarjetas($giro);
			while($reg = $rspta->fetch_object())
			{
				$hc_lun_reg = (intval(substr($reg->hc_lun, -5, 2)) + 01) . substr($reg->hc_lun, -3, 3);
				$hc_mar_reg = (intval(substr($reg->hc_mar, -5, 2)) + 01) . substr($reg->hc_mar, -3, 3);
				$hc_mie_reg = (intval(substr($reg->hc_mie, -5, 2)) + 01) . substr($reg->hc_mie, -3, 3);
				$hc_jue_reg = (intval(substr($reg->hc_jue, -5, 2)) + 01) . substr($reg->hc_jue, -3, 3);
				$hc_vie_reg = (intval(substr($reg->hc_vie, -5, 2)) + 01) . substr($reg->hc_vie, -3, 3);
				$hc_sab_reg = (intval(substr($reg->hc_sab, -5, 2)) + 01) . substr($reg->hc_sab, -3, 3);
				$hc_dom_reg = (intval(substr($reg->hc_dom, -5, 2)) + 01) . substr($reg->hc_dom, -3, 3);
				$hora_actual = date("H:i");
				$estado;

				switch (date("N")){
					case '1':
					if(($hora_actual>$reg->he_lun && $hora_actual<$reg->hs_lun)){
						if(($hora_actual>$reg->hc_lun && $hora_actual<$hc_lun_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '2':
					if(($hora_actual>$reg->he_mar && $hora_actual<$reg->hs_mar)){
						if(($hora_actual>$reg->hc_mar && $hora_actual<$hc_mar_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '3':
					if(($hora_actual>$reg->he_mie && $hora_actual<$reg->hs_mie)){
						if(($hora_actual>$reg->hc_mie && $hora_actual<$hc_mie_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '4':
					if(($hora_actual>$reg->he_jue && $hora_actual<$reg->hs_jue)){
						if(($hora_actual>$reg->hc_jue && $hora_actual<$hc_jue_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '5':
					if(($hora_actual>$reg->he_vie && $hora_actual<$reg->hs_vie)){
						if(($hora_actual>$reg->hc_vie && $hora_actual<$hc_vie_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '6':
					if(($hora_actual>$reg->he_sab && $hora_actual<$reg->hs_sab)){
						if(($hora_actual>$reg->hc_sab && $hora_actual<$hc_sab_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '7':
					if(($hora_actual>$reg->he_dom && $hora_actual<$reg->hs_dom)){
						if(($hora_actual>$reg->hc_dom && $hora_actual<$hc_dom_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

				}

				echo '<div class="card mb-4 mx-auto shadow p-3 mb-5 bg-white rounded" style="max-width: 80%">
				<h4 class="card-header"><strong>'.$reg->n_negocio.'</strong> '.$estado.'</h4>
				<div class="row">
				<div class="col-md-3" style="margin: 3% 3% 3% 3%">
				<img src="../files/img_negocios_tarjetas/'.$reg->url_imagen2.'" class="card-img rounded-circle" alt="..." width="200px" height="300px">
				</div>
				<div class="col-md-8">
				<div class="card-body">
				<p class="card-text"><strong><i class="fa fa-map-signs"  style="font-size: 20px; color:#D2691E;"></i> Referencia:</strong> '.$reg->ref_negocio.'</p>
				<p class="card-text"><strong><i class="fa fa-home" style="font-size: 20px; color:#A0522D"></i> Dirección:</strong> Calle '.$reg->calle.' #'.$reg->numero.', Col. '.$reg->colonia.', C.P. '.$reg->codigo_p.', '.$reg->municipio.', '.$reg->estado.'</p>
				<p class="card-text"><strong><i class="fa fa-phone" style="font-size: 20px; color:#1E90FF;"></i> Teléfono del local:</strong> '.$reg->num_local.'</p>
				<p class="card-text"><strong><i class="fa fa-envelope" style="font-size: 20px; color:#8B0000;"></i> Correo electrónico:</strong> '.$reg->correo_n.'</p>
				<p class="card-text"><strong><i class="fa fa-clock-o" style="font-size: 20px; color:#FF4500;"></i> Horarios</p></strong>
				<table id="horarios" class="table table-responsive table-borderless">
				<tbody style="text-align: right;"> <tr>';

				if($reg->he_lun=='' && $reg->hs_lun==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_lun!='' && $reg->hs_lun!='' && $reg->hc_lun==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;">'.$reg->he_lun.' - '.$reg->hs_lun.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;"> '.$reg->he_lun.' - '.$reg->hc_lun.', '.$hc_lun_reg.' - '.$reg->hs_lun.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_mar=='' && $reg->hs_mar==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_mar!='' && $reg->hs_mar!='' && $reg->hc_mar==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;">'.$reg->he_mar.' - '.$reg->hs_mar.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;">'.$reg->he_mar.' - '.$reg->hc_mar.', '.$hc_mar_reg.' - '.$reg->hs_mar.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_mie=='' && $reg->hs_mie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_mie!='' && $reg->hs_mie!='' && $reg->hc_mie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;">'.$reg->he_mie.' - '.$reg->hs_mie.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;">'.$reg->he_mie.' - '.$reg->hc_mie.', '.$hc_mie_reg.' - '.$reg->hs_mie.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_jue=='' && $reg->hs_jue==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_jue!='' && $reg->hs_jue!='' && $reg->hc_jue==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;">'.$reg->he_jue.' - '.$reg->hs_jue.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;">'.$reg->he_jue.' - '.$reg->hc_jue.', '.$hc_jue_reg.' - '.$reg->hs_jue.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_vie=='' && $reg->hs_vie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_vie!='' && $reg->hs_vie!='' && $reg->hc_vie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;">'.$reg->he_vie.' - '.$reg->hs_vie.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;">'.$reg->he_vie.' - '.$reg->hc_vie.', '.$hc_vie_reg.' - '.$reg->hs_vie.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_sab=='' && $reg->hs_sab==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_sab!='' && $reg->hs_sab!='' && $reg->hc_sab==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;">'.$reg->he_sab.' - '.$reg->hs_sab.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;">'.$reg->he_sab.' - '.$reg->hc_sab.', '.$hc_sab_reg.' - '.$reg->hs_sab.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_dom=='' && $reg->hs_dom==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_dom!='' && $reg->hs_dom!='' && $reg->hc_dom==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;">'.$reg->he_dom.' - '.$reg->hs_dom.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;">'.$reg->he_dom.' - '.$reg->hc_dom.', '.$hc_dom_reg.' - '.$reg->hs_dom.'</td></tr>';
				}

				echo '
				</tbody>
				</table>
				<p class="card-text"><strong><i class="fa fa-truck" style="font-size: 20px; color:#BC8F8F;"></i> Servicio de entrega:</strong> '.$reg->tipo_servicio.'</p>
				<p class="card-text"><strong><i class="fa fa-usd" style="font-size: 20px; color:#8B0000;"></i> Métodos de pago:</p></strong>
				<div>
				<ul>';
				$rspta2 = $info_negocio->listarpagosTarjetas($reg->id);
				while($pagos = $rspta2->fetch_object())
				{
					echo '<li>'.utf8_encode($pagos->nombre_pago).'</li>';
				}

				echo '</ul>
				</div>
				<strong><p class="card-text"><i class="fa fa-globe" style="font-size: 20px; color:#0000CD;"></i> Redes Sociales</p></strong>
				<div>';

				if($reg->dir_face!=''){
					echo '<a href="'.$reg->dir_face.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/face.png" width="30px" height="30px"></a>';
				}
				if($reg->dir_twiter!=''){
					echo '<a href="'.$reg->dir_twiter.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/twiter.png" width="35px" height="35px"></a>';
				}
				if($reg->num_whats!=''){
					echo '<a href="https://api.whatsapp.com/send?phone=52'.$reg->num_whats.'&text=Hola,%20¿qué%20tal?" target="_blank" style="margin-right: 15px;"><img src="../public/img/whatsapp.png" width="42px" height="42px"></a>';
				}
				if($reg->dir_insta!=''){
					echo '<a href="'.$reg->dir_insta.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/insta.png" width="35px" height="35px"></a>';
				}
				if($reg->otro!=''){
					echo '<a href="'.$reg->otro.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/tienda.png" width="35px" height="35px"></a>';
				}
				echo '</div>
				</div>
				</div>   
				</div>
				</div>';
			}
		}

		break;




		case 'busquedaNombre':

		sleep(2);
		date_default_timezone_set("America/Mexico_City");

		$nombre = $_POST['nombre'];

		$rspta = $info_negocio->busqueda($nombre);

		$aux = array();

		while($aux2 = $rspta->fetch_object())
		{
			array_push($aux, $aux2->n_negocio);
		}

		if(sizeof($aux) == 0){
			echo '<div class="alert alert-danger text-center" role="alert">No se encontrarón coincidenias con '.$nombre.'</div>';
		} else {

			$rspta = $info_negocio->busqueda($nombre);
			while($reg = $rspta->fetch_object())
			{
				$hc_lun_reg = (intval(substr($reg->hc_lun, -5, 2)) + 01) . substr($reg->hc_lun, -3, 3);
				$hc_mar_reg = (intval(substr($reg->hc_mar, -5, 2)) + 01) . substr($reg->hc_mar, -3, 3);
				$hc_mie_reg = (intval(substr($reg->hc_mie, -5, 2)) + 01) . substr($reg->hc_mie, -3, 3);
				$hc_jue_reg = (intval(substr($reg->hc_jue, -5, 2)) + 01) . substr($reg->hc_jue, -3, 3);
				$hc_vie_reg = (intval(substr($reg->hc_vie, -5, 2)) + 01) . substr($reg->hc_vie, -3, 3);
				$hc_sab_reg = (intval(substr($reg->hc_sab, -5, 2)) + 01) . substr($reg->hc_sab, -3, 3);
				$hc_dom_reg = (intval(substr($reg->hc_dom, -5, 2)) + 01) . substr($reg->hc_dom, -3, 3);
				$hora_actual = date("H:i");
				$estado;

				switch (date("N")){
					case '1':
					if(($hora_actual>$reg->he_lun && $hora_actual<$reg->hs_lun)){
						if(($hora_actual>$reg->hc_lun && $hora_actual<$hc_lun_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '2':
					if(($hora_actual>$reg->he_mar && $hora_actual<$reg->hs_mar)){
						if(($hora_actual>$reg->hc_mar && $hora_actual<$hc_mar_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '3':
					if(($hora_actual>$reg->he_mie && $hora_actual<$reg->hs_mie)){
						if(($hora_actual>$reg->hc_mie && $hora_actual<$hc_mie_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '4':
					if(($hora_actual>$reg->he_jue && $hora_actual<$reg->hs_jue)){
						if(($hora_actual>$reg->hc_jue && $hora_actual<$hc_jue_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '5':
					if(($hora_actual>$reg->he_vie && $hora_actual<$reg->hs_vie)){
						if(($hora_actual>$reg->hc_vie && $hora_actual<$hc_vie_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '6':
					if(($hora_actual>$reg->he_sab && $hora_actual<$reg->hs_sab)){
						if(($hora_actual>$reg->hc_sab && $hora_actual<$hc_sab_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

					case '7':
					if(($hora_actual>$reg->he_dom && $hora_actual<$reg->hs_dom)){
						if(($hora_actual>$reg->hc_dom && $hora_actual<$hc_dom_reg)){
							$estado = '<label class="badge badge-danger">Cerrado</label>';
						} else
						{
							$estado = '<label class="badge badge-success">Abierto</label>';
						}
					}
					else
					{
						$estado = '<label class="badge badge-danger">Cerrado</label>';
					}
					break;

				}

				echo '<div class="card mb-4 mx-auto shadow p-3 mb-5 bg-white rounded" style="max-width: 80%">
				<h4 class="card-header"><strong>'.$reg->n_negocio.'</strong> '.$estado.'</h4>
				<div class="row">
				<div class="col-md-3" style="margin: 3% 3% 3% 3%">
				<img src="../files/img_negocios_tarjetas/'.$reg->url_imagen2.'" class="card-img rounded-circle" alt="..." width="200px" height="300px">
				</div>
				<div class="col-md-8">
				<div class="card-body">
				<p class="card-text"><strong><i class="fa fa-map-signs"  style="font-size: 20px; color:#D2691E;"></i> Referencia:</strong> '.$reg->ref_negocio.'</p>
				<p class="card-text"><strong><i class="fa fa-home" style="font-size: 20px; color:#A0522D"></i> Dirección:</strong> Calle '.$reg->calle.' #'.$reg->numero.', Col. '.$reg->colonia.', C.P. '.$reg->codigo_p.', '.$reg->municipio.', '.$reg->estado.'</p>
				<p class="card-text"><strong><i class="fa fa-phone" style="font-size: 20px; color:#1E90FF;"></i> Teléfono del local:</strong> '.$reg->num_local.'</p>
				<p class="card-text"><strong><i class="fa fa-envelope" style="font-size: 20px; color:#8B0000;"></i> Correo electrónico:</strong> '.$reg->correo_n.'</p>
				<p class="card-text"><strong><i class="fa fa-clock-o" style="font-size: 20px; color:#FF4500;"></i> Horarios</p></strong>
				<table id="horarios" class="table table-responsive table-borderless">
				<tbody style="text-align: right;"> <tr>';

				if($reg->he_lun=='' && $reg->hs_lun==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_lun!='' && $reg->hs_lun!='' && $reg->hc_lun==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;">'.$reg->he_lun.' - '.$reg->hs_lun.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Lunes</strong></td> <td style="text-align:left;"> '.$reg->he_lun.' - '.$reg->hc_lun.', '.$hc_lun_reg.' - '.$reg->hs_lun.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_mar=='' && $reg->hs_mar==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_mar!='' && $reg->hs_mar!='' && $reg->hc_mar==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;">'.$reg->he_mar.' - '.$reg->hs_mar.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Martes</strong></td> <td style="text-align:left;">'.$reg->he_mar.' - '.$reg->hc_mar.', '.$hc_mar_reg.' - '.$reg->hs_mar.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_mie=='' && $reg->hs_mie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_mie!='' && $reg->hs_mie!='' && $reg->hc_mie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;">'.$reg->he_mie.' - '.$reg->hs_mie.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Miércoles</strong></td> <td style="text-align:left;">'.$reg->he_mie.' - '.$reg->hc_mie.', '.$hc_mie_reg.' - '.$reg->hs_mie.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_jue=='' && $reg->hs_jue==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_jue!='' && $reg->hs_jue!='' && $reg->hc_jue==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;">'.$reg->he_jue.' - '.$reg->hs_jue.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Jueves</strong></td> <td style="text-align:left;">'.$reg->he_jue.' - '.$reg->hc_jue.', '.$hc_jue_reg.' - '.$reg->hs_jue.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_vie=='' && $reg->hs_vie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_vie!='' && $reg->hs_vie!='' && $reg->hc_vie==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;">'.$reg->he_vie.' - '.$reg->hs_vie.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Viernes</strong></td> <td style="text-align:left;">'.$reg->he_vie.' - '.$reg->hc_vie.', '.$hc_vie_reg.' - '.$reg->hs_vie.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_sab=='' && $reg->hs_sab==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_sab!='' && $reg->hs_sab!='' && $reg->hc_sab==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;">'.$reg->he_sab.' - '.$reg->hs_sab.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Sábado</strong></td> <td style="text-align:left;">'.$reg->he_sab.' - '.$reg->hc_sab.', '.$hc_sab_reg.' - '.$reg->hs_sab.'</td></tr>';
				}

				echo '<tr>';

				if($reg->he_dom=='' && $reg->hs_dom==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;"> Cerrado </td></tr>';
				} else if($reg->he_dom!='' && $reg->hs_dom!='' && $reg->hc_dom==''){
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;">'.$reg->he_dom.' - '.$reg->hs_dom.'</td></tr>';
				} else {
					echo '<td><strong style="margin-right: 15px; font-style: italic;">Domingo</strong></td> <td style="text-align:left;">'.$reg->he_dom.' - '.$reg->hc_dom.', '.$hc_dom_reg.' - '.$reg->hs_dom.'</td></tr>';
				}

				echo '
				</tbody>
				</table>
				<p class="card-text"><strong><i class="fa fa-truck" style="font-size: 20px; color:#BC8F8F;"></i> Servicio de entrega:</strong> '.$reg->tipo_servicio.'</p>
				<p class="card-text"><strong><i class="fa fa-usd" style="font-size: 20px; color:#8B0000;"></i> Métodos de pago:</p></strong>
				<div>
				<ul>';
				$rspta2 = $info_negocio->listarpagosTarjetas($reg->id);
				while($pagos = $rspta2->fetch_object())
				{
					echo '<li>'.utf8_encode($pagos->nombre_pago).'</li>';
				}

				echo '</ul>
				</div>
				<strong><p class="card-text"><i class="fa fa-globe" style="font-size: 20px; color:#0000CD;"></i> Redes Sociales</p></strong>
				<div>';

				if($reg->dir_face!=''){
					echo '<a href="'.$reg->dir_face.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/face.png" width="30px" height="30px"></a>';
				}
				if($reg->dir_twiter!=''){
					echo '<a href="'.$reg->dir_twiter.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/twiter.png" width="35px" height="35px"></a>';
				}
				if($reg->num_whats!=''){
					echo '<a href="https://api.whatsapp.com/send?phone=52'.$reg->num_whats.'&text=Hola,%20¿qué%20tal?" target="_blank" style="margin-right: 15px;"><img src="../public/img/whatsapp.png" width="42px" height="42px"></a>';
				}
				if($reg->dir_insta!=''){
					echo '<a href="'.$reg->dir_insta.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/insta.png" width="35px" height="35px"></a>';
				}
				if($reg->otro!=''){
					echo '<a href="'.$reg->otro.'" target="_blank" style="margin-right: 15px;"><img src="../public/img/tienda.png" width="35px" height="35px"></a>';
				}
				echo '</div>
				</div>
				</div>   
				</div>
				</div>';
			}
		}

		break;




		case 'listarNegocios':

		$idpersonal=$_GET['idpersonal'];

		$rspta=$info_negocio->listarNegocios($idpersonal);
			//Declarrar array
		$data= Array();
		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>utf8_encode($reg->n_negocio),
				"1"=>'<button class="btn btn-primary" onclick="actualizarNeg('.$reg->idinfo_negocio.');"><i class="fas fa-pen"></i></button>',
				"2"=>'<button class="btn btn-danger" onclick="eliminarIN('.$reg->idinfo_negocio.')"><i class="fas fa-trash"></i></button>'
			);
		}
		$results = array(
				"sEcho"=>1, //Información para el datatables
				"iTotalRecords"=>count($data),//enviamos el totoal de registros al datatables
				"iTotalDisplayRecords"=>count($data),//Enviamos el total de registros a visualizar
				"aaData"=>$data);
		echo json_encode($results);
		break;
	}

	?>