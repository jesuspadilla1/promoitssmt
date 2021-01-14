<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Direccion
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementación del metodo insertar registros
	public function insertar($idinfo_negocio, $calle, $numero, $codigo_p, $colonia, $estado, $municipio)
	{
		$sql="INSERT INTO direccion (calle, numero, codigo_p, colonia, estado, municipio) VALUES('$calle', '$numero', '$codigo_p', '$colonia', '$estado', '$municipio')";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($iddireccion, $idinfo_negocio, $calle, $numero, $codigo_p, $colonia, $estado, $municipio)
	{
		$sql="UPDATE direccion SET calle='$calle', numero='$numero', codigo_p='$codigo_p', colonia='$colonia', estado='$estado', municipio='$municipio' WHERE iddireccion='$iddireccion'";
		ejecutarConsulta($sql);
	}

	//Implementación de metodo para eliminar a un giro
	public function eliminar($iddireccion)
	{
		$sql="DELETE FROM direccion WHERE iddireccion='$iddireccion'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idinfo_negocio)
	{
		$sql="SELECT iddireccion AS iddir, idinfo_negocio AS idneg, calle AS cal, numero AS num, codigo_p AS cod, colonia AS col, estado AS est, municipio AS mun FROM direccion WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para mostrar la colonia de la direccion del negocio
	public function col($idinfo_negocio)
	{
		$sql="SELECT colonia FROM direccion WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

}

?>