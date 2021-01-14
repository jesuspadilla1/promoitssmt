<?php
session_start();
if (!isset($_SESSION["n_usuario"])) {
  require 'header.php';
  ?>
  <!--ENCABEZADO DEL CUERPO DE LA PAGINA--> 

<nav class="card-header index navbar navbar-expand-lg navbar-dark primary-color py-4 justify-content-center" id="menuBotones">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo03">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link"  href="index.php">INICIO</a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="#" onclick="mostrarProductos(true)">PRODUCTOS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="mostrarServicios(true)">SERVICIOS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="mostrarBusqueda(true)">BUSCAR NEGOCIOS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="mostrarForm(true)" data-toggle="modal" data-target="#ventanaModal">INICIAR SESIÓN</a>
      </li>
    </ul>
  </div>
</nav>

<!--Modal de inicio de sesión-->
<div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="tituloVentana" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success" role="document">
    <!--Inicio de encabezado-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 white-text" id="tituloVentana">Iniciar Sesión</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>
      <!--Fin inicio de encabezado-->
      <!--Cuerpo de encabezado-->
      <form class="form-inline" id="formIniciarS" method="post">
        <div class="modal-body mx-3" id="formulario">
          <div class="md-form mb-3" id="formIniciarS" method="post">
            <i class="fas fa-user prefix grey-text"></i>
            <input type="text" id="logina" name="logina" required class="form-control validate">
            <label for="logina">Nombre usuario</label>
          </div>

          <div class="md-form mb-3">
            <i class="fas fa-lock prefix grey-text"></i>
            <input type="password" id="clavea" name="clavea" required class="form-control validate">
            <label for="clavea">Contraseña</label>
          </div>
          <!--Fin cuerpo de encabezado-->
          <!--Inicio pie de encabezado-->
          <div class="modal-footer d-flex justify-content-center">
            <button class="btn btn-success btn-rounded" type="submit">Ingresar</button>
          </div>
        </div> <br /><br />
           <!--Fin Modal de inicio de sesión-->
      </form>
    </div>
  </div>
</div>

<!--Caroucel-->
<div class="card text-center" id="divCarousel">
  
</div>
<!--Fin Carousel-->
<!--Opciones de productos-->
<div class="container justify-content-end" id="selectProductos">
  <div class="col-sm-11">
    <h4 class="deep-purple-text">Productos</h4>
    <div class="row justify-content-center">
      <div class="form-group col-md-4 row-fluid">
        <select class="form-control largos" id="idgiro" name="idgiro">
        </select>
      </div>
    </div>
  </div>
</div>
<!--Opciones fo servicios-->
<div class="container justify-content-end" id="selectServicios">
  <div class="col-sm-11">
    <h4 class="deep-purple-text">Servicios</h4>
    <div class="row justify-content-center">
      <div class="form-group col-md-4 row-fluid">
        <select class="form-control largos" id="idgiro2" name="idgiro2" required>
        </select>
      </div>
    </div>
  </div>
</div>


<!--Opciones de búsqueqda de negocio-->
<div class="row justify-content-center" id="busquedaNegocio">
  <div class="col-sm-11">
    <h4 class="container deep-purple-text">Buscar Negocios</h4>
    <div class="row justify-content-center">
      <form class="form-inline col-lg-12 col-md-12 col-sm-5 col-xs-12">
        <div class="md-form d-flex justify-content-center col-lg-12 col-md-12 col-sm-6 col-xs-12">
          <input type="text" id="busqueda" name="busqueda" placeholder="Nombre de negocio o Código Postal o Municipio o Colonia" class="form-control col-md-4" minleength ="1" maxlength="30" required/>
          <label class="justify-content-center col-md-6" for="busqueda">Búsqueda:</label>
        </div>

        <div class="form-inline col-lg-12 col-md-12 col-sm-12 col-xs-12 justify-content-center">
          <button class="btn btn-default btn-rounded btn-md" onclick="busquedaNegocio(); return false;" id="btnBusqueda"><i class="fa fa-search"></i> Buscar</button>
          <button class="btn btn-secondary btn-rounded btn-md" onclick="limpiarBusqueda();" id="clBusqueda"><i class="fa fa-times"></i> Limpiar</button><br/><br/><br/>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Sección de consultas de productos--> 
<div id="divConsultasP">
  
</div>
<!--Sección de consultas de servicios--> 
<div id="divConsultasS">

</div>
<!--Sección de consultas de productos--> 
<div id="divBusqueda">
  
</div>
 




<?php
require 'footer.php';
} else {
  if ($_SESSION['n_usuario']!='admin')
  {
    header("location: modulo_duenos.php");
  } else if ($_SESSION['n_usuario']=='admin') 
  {
    header("location: modulo_administrador.php");
  }
}
?>
<script src="scripts/index.js"></script>
<script src="scripts/login.js"></script>