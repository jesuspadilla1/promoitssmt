<?php 
//Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Info_Negocio
{

	//Implementación de constructor
	public function __construct()
	{
	}

	//Implementar un metodo para agregar un negocio
	public function insertar($idpersonal, $n_negocio){	
		$sql="INSERT INTO info_negocio(idpersonal, n_negocio) VALUES('$idpersonal', '$n_negocio')";
		return ejecutarConsulta($sql);
	}

	//Implemetación de metodo para editar registros
	public function editar($idinfo_negocio, $idpersonal, $idgiro, $n_negocio, $ref_negocio, $rfc_negocio, $url_imagen1, $url_imagen2, $tipo_negocio, $tipo_servicio, $pago)
	{
		$sql="UPDATE info_negocio SET idgiro='$idgiro', n_negocio='$n_negocio', ref_negocio='$ref_negocio', rfc_negocio='$rfc_negocio', url_imagen1='$url_imagen1', url_imagen2='$url_imagen2', tipo_negocio='$tipo_negocio', tipo_servicio='$tipo_servicio' WHERE idpersonal='$idpersonal' AND idinfo_negocio='$idinfo_negocio'";
		ejecutarConsulta($sql);

		$sqldel="DELETE FROM negocio_pago WHERE idinfo_negocio='$idinfo_negocio'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;
		
		while ($num_elementos < count($pago)) {
			$sql_detalle = "INSERT INTO negocio_pago(idpago, idinfo_negocio) VALUES('$pago[$num_elementos]', '$idinfo_negocio')";
			ejecutarConsulta($sql_detalle) or $sw=false;
			$num_elementos=$num_elementos + 1;
		}
		return $sw;

	}

	//Implementación de metodo para eliminar a un usuario
	public function eliminar($idinfo_negocio)
	{
		$sql="DELETE FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para mostrar datos de un registro a modificar
	public function mostrar($idinfo_negocio)
	{
		$sql="SELECT * FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para listar los registros
	public function listar()
	{
		$sql="SELECT i.idinfo_negocio AS idinfo_negocio, i.n_negocio AS n_negocio, i.ref_negocio AS ref_negocio, i.rfc_negocio AS rfc_negocio, i.url_imagen1 AS url_imagen1, i.url_imagen2 AS url_imagen2, i.tipo_negocio AS tipo_negocio, g.n_giro as n_giro FROM info_negocio AS i LEFT JOIN giro AS g ON i.idgiro=g.idgiro";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para seleccionar giro
	public function selectG($idinfo_negocio)
	{
		$sql="SELECT idgiro FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

	//Implementación de metodo para determinar pestaña de servicios o productos
	public function tipo($idinfo_negocio)
	{
		$sql="SELECT tipo_negocio FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementación de metodo para determinar pestaña de servicios o productos
	public function tipoSelect($idinfo_negocio)
	{
		$sql="SELECT tipo_negocio FROM info_negocio WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}
		//Implementar un metodo para listar los tipos de pago marcados
	public function listarpagos($idinfo_negocio)
	{
		$sql="SELECT * FROM negocio_pago WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un metodo para obtener las imagenes para el carousel
	public function carousel(){
		$sql="SELECT i.url_imagen1, i.n_negocio, i.ref_negocio, g.n_giro FROM info_negocio AS i JOIN giro AS g ON i.idgiro=g.idgiro WHERE url_imagen1!='prueba' AND url_imagen1!='' ORDER BY RAND() LIMIT 10";
		return ejecutarConsulta($sql);
	}

	//Implementar un metodo para obtener toda la información de las tarjetas de negocios
	public function tarjetas($giro){
		$sql="SELECT i.idinfo_negocio AS id, i.n_negocio AS n_negocio, i.url_imagen2 AS url_imagen2, i.url_imagen1 AS url_imagen1, i.ref_negocio AS ref_negocio, d.calle AS calle, d.numero AS numero, d.colonia AS colonia, d.codigo_p AS codigo_p, d.municipio AS municipio, d.estado AS estado, rs.num_local AS num_local, h.he_lun AS he_lun, h.hc_lun AS hc_lun, h.hs_lun AS hs_lun, h.he_mar AS he_mar, h.hc_mar AS hc_mar, h.hs_mar AS hs_mar, h.he_mie AS he_mie, h.hc_mie AS hc_mie, h.hs_mie AS hs_mie, h.he_jue AS he_jue, h.hc_jue AS hc_jue, h.hs_jue AS hs_jue, h.he_vie AS he_vie, h.hc_vie AS hc_vie, h.hs_vie AS hs_vie, h.he_sab AS he_sab, h.hc_sab AS hc_sab, h.hs_sab AS hs_sab, h.he_dom AS he_dom, h.hc_dom AS hc_dom, h.hs_dom AS hs_dom, i.tipo_servicio AS tipo_servicio, rs.correo_n AS correo_n, rs.num_whats AS num_whats, rs.dir_face AS dir_face, rs.dir_twiter AS dir_twiter, rs.dir_insta AS dir_insta, rs.otro AS otro FROM direccion AS d JOIN info_negocio AS i ON d.idinfo_negocio=i.idinfo_negocio JOIN redes_sociales AS rs ON i.idinfo_negocio=rs.idinfo_negocio JOIN dias_horario AS h ON rs.idinfo_negocio=h.idinfo_negocio WHERE i.idgiro='$giro' AND url_imagen1!='' AND url_imagen2!=''";
		return ejecutarConsulta($sql);
	}

		//Implementar un metodo para listar los tipos de pago marcados por el usuario en tarjetas
	public function listarpagosTarjetas($idinfo_negocio)
	{
		$sql="SELECT t.tipo_pago AS nombre_pago FROM t_pago AS t JOIN negocio_pago AS np ON t.idpago=np.idpago WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

		//Implementar un metodo para mostrar url_imagen1
	public function imagenC($idinfo_negocio)
	{
		$sql="SELECT url_imagen1 WHERE idinfo_negocio='$idinfo_negocio'";
		return ejecutarConsulta($sql);
	}

	//Implementar un metodo para buscar negocio por nombre
	public function busqueda($nombre){
		$sql="SELECT i.idinfo_negocio AS id, i.n_negocio AS n_negocio, i.url_imagen2 AS url_imagen2, i.url_imagen1 AS url_imagen1, i.ref_negocio AS ref_negocio, d.calle AS calle, d.numero AS numero, d.colonia AS colonia, d.codigo_p AS codigo_p, d.municipio AS municipio, d.estado AS estado, rs.num_local AS num_local, h.he_lun AS he_lun, h.hc_lun AS hc_lun, h.hs_lun AS hs_lun, h.he_mar AS he_mar, h.hc_mar AS hc_mar, h.hs_mar AS hs_mar, h.he_mie AS he_mie, h.hc_mie AS hc_mie, h.hs_mie AS hs_mie, h.he_jue AS he_jue, h.hc_jue AS hc_jue, h.hs_jue AS hs_jue, h.he_vie AS he_vie, h.hc_vie AS hc_vie, h.hs_vie AS hs_vie, h.he_sab AS he_sab, h.hc_sab AS hc_sab, h.hs_sab AS hs_sab, h.he_dom AS he_dom, h.hc_dom AS hc_dom, h.hs_dom AS hs_dom, i.tipo_servicio AS tipo_servicio, rs.correo_n AS correo_n, rs.num_whats AS num_whats, rs.dir_face AS dir_face, rs.dir_twiter AS dir_twiter, rs.dir_insta AS dir_insta, rs.otro AS otro FROM direccion AS d JOIN info_negocio AS i ON d.idinfo_negocio=i.idinfo_negocio JOIN redes_sociales AS rs ON i.idinfo_negocio=rs.idinfo_negocio JOIN dias_horario AS h ON rs.idinfo_negocio=h.idinfo_negocio WHERE (i.n_negocio LIKE '%$nombre%' OR colonia LIKE '%$nombre%' OR codigo_p LIKE '%$nombre%' OR municipio LIKE '%$nombre%') AND (i.url_imagen1!='' AND i.url_imagen2!='')";
		return ejecutarConsulta($sql);
	}

	//Implementar un metodo para listar los negocios de un usuario
	public function listarNegocios($idpersonal){	
		$sql="SELECT idinfo_negocio, n_negocio FROM info_negocio WHERE idpersonal='$idpersonal'";
		return ejecutarConsulta($sql);
	}

}

?>