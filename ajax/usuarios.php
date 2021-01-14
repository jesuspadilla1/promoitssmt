<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
require_once "../modelos/Usuarios.php";

$usuarios = new Usuarios();

$idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$n_usuario = isset($_POST["n_usuario"])? limpiarCadena($_POST["n_usuario"]):"";
$c_usuario = isset($_POST["c_usuario"])? limpiarCadena($_POST["c_usuario"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	if (empty($idusuario)) {
		$rspta=$usuarios->insertar($n_usuario,$c_usuario);
		echo $rspta ? "Usuario registrado" : "Usuario no se pudo registrar";
	}
	else {
		$rspta=$usuarios->editar($idusuario,$n_usuario,$c_usuario);
		echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
	}
	break;

	case 'desactivar':
	$rspta=$usuarios->desactivar($idusuario);
	echo $rspta ? "Usuario desactivado" : "El usuario no se puede desactivar";
	break;

	case 'activar':
	$rspta=$usuarios->activar($idusuario);
	echo $rspta ? "Usuario activado" : "El usuario no se puede activar";
	break;

	case 'mostrar':
	$rspta=$usuarios->mostrar($idusuario);
		//Codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'eliminar':
	$rspta=$usuarios->eliminar($idusuario);
	echo $rspta ? "Usuario eliminado" : "El usuario no se puede eliminar";
	break;

	case 'listar':
	if (!isset($_SESSION["n_usuario"]))
	{
	  header("Location: ../vistas/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
	}
	else
	{
		if($_SESSION["n_usuario"]=="admin")
		{
			$rspta=$usuarios->listar();
		//Declarrar array
			$data= Array();
			while ($reg=$rspta->fetch_object()) {
				$data[]=array(
					"0"=>$reg->idusuario,
					"1"=>$reg->n_usuario,
					"2"=>$reg->c_usuario,
					"3"=>'<button class="btn btn-primary" onclick="mostrarU('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>',
					"4"=>'<button class="btn btn-danger" onclick="eliminarU('.$reg->idusuario.')"><i class="fa fa-trash"></i></button>',
					/*"5"=>($reg->estado == "activo")?'<input type="checkbox" checked name="'.$reg->idusuario.'" value="'.$reg->idusuario.'">':'<input type="checkbox" name="'.$reg->idusuario.'" value="'.$reg->idusuario.'">',*/
					"5"=>($reg->estado == 'activo')?'<button class="btn btn-warning" onclick="desactivarU('.$reg->idusuario.')"><i class="fa fa-times"></i></button>':
					'  <button class="btn btn-success" onclick="activarU('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
					"6"=>($reg->estado == 'activo')?'<span class="badge badge-success">Activo</span>':'<span class="badge badge-danger">Desactivado</span>'
				);
			}
			$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data),//enviamos el totoal de registros al datatables
			"iTotalDisplayRecords"=>count($data),//Enviamos el total de registros a visualizar
			"aaData"=>$data);
			echo json_encode($results);
		}
		else {
			header("location: ../vistas/index.php");
		}
	}
	break;

	case 'verificar':
	$logina=$_POST['logina'];
	$clavea=$_POST['clavea'];

	$rspta=$usuarios->verificar($logina, $clavea);

	$fetch=$rspta->fetch_object();

	if(isset($fetch)){

			//Declaramos variables de sesión
		$_SESSION['idusuario']=$fetch->idusuario;
		$_SESSION['n_usuario']=$fetch->n_usuario;
		$_SESSION['nombre']=$fetch->nombre;
		$_SESSION['idpersonal']=$fetch->idpersonal;
		$_SESSION['idinfo_negocio']=$fetch->idinfo_negocio;
		$_SESSION['tipo_negocio']=$fetch->tipo_negocio;
	}

	echo json_encode($fetch);

	break;

	case 'salir':

	//Limpiamos las variables de sesión
	session_unset();
	//Destruimos la sesión
	session_destroy();
	//redireccionamos al index
	header("location: ../vistas/index.php");
	break;

}
?>