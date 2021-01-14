<?php
session_start();
require_once "../modelos/Direccion.php";

$direccion = new Direccion();

$iddireccion = isset($_POST["iddireccion"])? limpiarCadena($_POST["iddireccion"]):"";
$idinfo_negocio = isset($_POST["idinfo_negocio"])? limpiarCadena($_POST["idinfo_negocio"]):"";
$calle = isset($_POST["calle"])? limpiarCadena($_POST["calle"]):"";
$numero = isset($_POST["numero"])? limpiarCadena($_POST["numero"]):"";
$colonia = isset($_POST["colonia"])? limpiarCadena($_POST["colonia"]):"";
$codigo_p = isset($_POST["codigo_p"])? limpiarCadena($_POST["codigo_p"]):"";
$estado = isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$municipio = isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	if (empty($iddireccion)) {
		$rspta=$direccion->insertar($idinfo_negocio, $calle, $numero, $codigo_p, $colonia, $estado, $municipio);
		echo $rspta ? "dirección registrada" : "La dirección no se pudo registrar";
	}
	else {
		$rspta=$direccion->editar($iddireccion, $idinfo_negocio, $calle, $numero, $codigo_p, $colonia, $estado, $municipio);
		echo $rspta ? "La dirección no se pudo actualizar" : "Dirección del negocio actualizada";
	}
	break;
	
	case 'mostrar':
	$rspta=$direccion->mostrar($idinfo_negocio);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'eliminar':
	$rspta=$direccion->eliminar($iddireccion);
	echo $rspta ? "dirección eliminada" : "La dirección no se puede eliminar";
	break;
		
}

?>