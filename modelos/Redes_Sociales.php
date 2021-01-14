<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Redes_Sociales
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación del metodo insertar registros
	public function insertar($correo_n, $num_local, $num_whats, $dir_face, $dir_twiter, $dir_insta, $otro)
	{
		$sql="INSERT INTO redes_sociales (correo_n, num_local, num_whats, dir_face, dir_twiter, dir_insta, otro) VALUES('$correo_n', '$num_local', '$num_whats', '$dir_face', '$dir_twiter', '$dir_insta', '$otro')";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($idredes_sociales, $correo_n, $num_local, $num_whats, $dir_face, $dir_twiter, $dir_insta, $otro)
	{
		$sql="UPDATE redes_sociales SET correo_n='$correo_n', num_local='$num_local', num_whats='$num_whats', dir_face='$dir_face', dir_twiter='$dir_twiter', dir_insta='$dir_insta', otro='$otro' WHERE idredes_sociales='$idredes_sociales'";
		ejecutarConsulta($sql);
	}

	//Implementación de metodo para eliminar a un giro
	public function eliminar($idredes_sociales)
	{
		$sql="DELETE FROM redes_sociales WHERE idredes_sociales='$idredes_sociales'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idinfo_negocio)
	{
		$sql="SELECT * FROM redes_sociales WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsultaSimpleFila($sql);
	}

}

?>