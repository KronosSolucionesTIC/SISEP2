<?php

//ini_set('error_reporting', E_ALL|E_STRICT);
//ini_set('display_errors', 1);

include '../controller/cambio_estado_grupo_invController.php';

include '../controller/proyectoController.php';

include '../controller/docentesController.php';

include '../controller/estudiantesController.php';

include '../controller/grupoController.php';

include '../conexion/datos.php';

$cambia_estadoGInst = new cambio_estado_grupo_invController();

$arrPermisosEG = $cambia_estadoGInst->getPermisosModulo_Tipo(57, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaEG = $arrPermisosEG[0]['crear'];

$docentesInst = new docentesController();

$arrPermisosD = $docentesInst->getPermisosModulo_Tipo(26, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaD = $arrPermisosD[0]['crear'];

$estudiantesInst = new estudiantesController();

$arrPermisoseg = $estudiantesInst->getPermisosModulo_Tipo(30, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creaeg = $arrPermisoseg[0]['crear'];

$rolEstudiante = $estudiantesInst->getRolEstudiante();

$re = $rolEstudiante[0]["pkID_rol"];

//print_r($re);

$detalles_grupoInst = new grupoController();

$arrPermisos = $detalles_grupoInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea = $arrPermisos[0]['crear'];

$pkID_grupo = $_GET["id_grupo"];

$estado = $detalles_grupoInst->getEstadoGrupo($pkID_grupo);

$estadoG = $estado[0]['fkID_estado'];

$proyectoInst = new proyectoController();

$arrPermisosp = $proyectoInst->getPermisosModulo_Tipo(32, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$creap = $arrPermisosp[0]['crear'];

$tipo_user = $_COOKIE[$NomCookiesApp . '_IDtipo'];

//print_r($tipo_user);

//++++++++++++++++++++++++++++++

$grupoGen = $detalles_grupoInst->getGruposId($pkID_grupo);

//variables grado
$pkID_grado = $grupoGen[0]["fkID_grado"];
$nom_grado  = $grupoGen[0]["nom_grado"];
//variables de institucion
$pkID_institucion = $grupoGen[0]["fkID_institucion"];
$nom_institucion  = $grupoGen[0]["nom_institucion"];
//------------------------------------------
$arrPermisosEstudiantes = $detalles_grupoInst->getPermisosModulo_Tipo(38, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaEstudiante         = $arrPermisosEstudiantes[0]['crear'];
//+++++++++++++++++++++++++++++++
$arrPermisosDocentes = $detalles_grupoInst->getPermisosModulo_Tipo(39, $_COOKIE[$NomCookiesApp . '_IDtipo']);
$creaDocente         = $arrPermisosDocentes[0]['crear'];
//------------------------------------------

$numeroEstudiantes = $detalles_grupoInst->getNumEstudiantesGrupo(9, $pkID_grupo, $pkID_grado);

$ne = $numeroEstudiantes[0]['num_estudiantes'];

$proyectoMGen = $detalles_grupoInst->getProyectosMarcoGrupo($pkID_grupo);
$pkID_proyectoM = $proyectoMGen[0]["pkIDproyecto"];  

//echo date("Y-m-d");

//print_r($fecha);
//++++++++++++++++++++++++++++++++++
include 'form_asignacion_estudiantes.php';
include 'form_sesion_grupo.php';
include 'form_estudiantes.php';
include 'form_docentes.php';
include 'form_grupo_estudiante.php';
include 'form_grupo_docente.php';
include "form_proyecto.php";
include "form_modal_archivos.php";
include "form_album_grupo.php";
include "frm_modal_proyectog.php";
//++++++++++++++++++++++++++++++++++/**/
?>
  
<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="grupo" name="grupo" value=<?php echo $pkID_grupo; ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="estado" name="estado" value=<?php echo $estadoG; ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="fecha" name="fecha" value=<?php echo date("Y-m-d"); ?>>
    </div>
</div>

<div class="form-group " hidden>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="modulo" name="modulo" value=<?php echo $id_modulo; ?>>
    </div>
</div>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
  	 <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_proyecto" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_docente" value=<?php echo $id_modulo ?>>

      <input type="hidden" id="id_mod_page_estudiante" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/grupoonly.png">Grupo - <?php echo $proyectoMGen[0]["nombre"] . ' - ' . $proyectoMGen[0]["nombre_proyecto"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->

    <div class="col-lg-12">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $proyectoMGen[0]["pkIDproyecto"]; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="academico.php?id_proyectoM=<?php echo $proyectoMGen[0]["pkIDproyecto"]; ?>" class="migadepan">Académico</a></li>
            <li><a href="grupo.php?id_proyectoM=<?php echo $proyectoMGen[0]["pkIDproyecto"]; ?>" class="migadepan">Grupo ondas</a></li>
            <li class="active migadepan">Detalle Grupos </li>
          </ol> 
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs tabs-proc3" role="tablist">
	        <li id="li_general" role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
          	<li id="li_estudiantes" role="presentation"><a href="#estudiantes" aria-controls="general" role="tab" data-toggle="tab">Estudiantes</a></li>
	        <li id="li_proyectos" role="presentation"><a href="#proyectos" aria-controls="general" role="tab" data-toggle="tab">Proyecto</a></li>
	        <li id="li_acompañamiento" role="presentation"><a href="#acompañamiento" aria-controls="general" role="tab" data-toggle="tab">Sesiones de Acompañamientos</a></li>
	        <li id="li_album" role="presentation"><a href="#album" aria-controls="general" role="tab" data-toggle="tab">Galeria</a></li>
	    </ul>

	    <div class="tab-content">

			<div role="tabpanel" class="tab-pane" id="general">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instanciFa php controller -->
							<?php $detalles_grupoInst->getDataGrupoGen($pkID_grupo);?>
						</div>
						<div class="col-md-12" hidden="true">
							<input type="text" id="grupo_id" value=<?php echo $pkID_grupo; ?>>
							<input type="text" id="grado_grupo" value=<?php echo $pkID_grado; ?>>
							<input type="text" id="institucion_grupo" value=<?php echo $pkID_institucion; ?>>
						</div>
					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<div role="tabpanel" class="tab-pane" id="estudiantes">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="titulohead">

			            <div class="row">
			              <div class="col-md-6">
			                  <div class="titleprincipal"><h4>Estudiantes Asignados - <?php echo $proyectoMGen[0]["nombre"] . ' - ' . $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
			              </div>
			              <div class="col-md-6 text-right">
			      			 <button id="btn_asignarestudiante" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="<?php echo $pkID_grupo ?>" data-target="#frm_modal_asignacion_estudiante" <?php if (($creaeg != 1) || ($ne >= 30)) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Asignar Estudiante</button>
			              </div>
			            </div>

		            </div>
		            <!-- /.panel-heading -->

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo_estudiante">
				                  <thead>
				                      <tr>
				                          <th>Nombres</th>
				                          <th>Apellidos</th>
				                          <th>Documento</th>
				                          <th>Grado</th>
				                          <th data-orderable="false">Opciones</th>
				                      </tr>
				                  </thead>

				                  <tbody>
				                      <?php
$detalles_grupoInst->getTablaEstudiantesGrupo($pkID_grupo);
?>
				                  </tbody>
				              </table>
					        </div>
					        <!-- /.table-responsive -->
						</div>

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<div role="tabpanel" class="tab-pane" id="acompañamiento">
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="titulohead">

			            <div class="row">
			              <div class="col-md-6">
			                  <div class="titleprincipal"><h4>Sesiones de Acompañamiento - <?php echo $proyectoMGen[0]["nombre"] . ' - ' . $proyectoMGen[0]["nombre_proyecto"] ?></h4></div>
			              </div>
			              <div class="col-md-6 text-right">
			      			 <button id="btn_nuevosesiong" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="<?php echo $pkID_grupo ?>" data-target="#frm_modal_sesion_grupo" <?php if (($creaeg != 1) || ($ne >= 30)) {echo 'disabled="disabled"';}?> ><span class="glyphicon glyphicon-plus"></span> Crear Sesión de Acompañamiento</button>   
			              </div>
			            </div>

		            </div>
		            <!-- /.panel-heading -->

					<div class="panel-body">

						<div class="col-md-12">
							<div class="dataTable_wrapper">
				              <table class="display table table-striped table-bordered table-hover" id="tbl_grupo_sesion">
				                  <thead>
				                      <tr>
				                          <th>Fecha</th>
				                          <th>Tema</th>
				                          <th>Lista</th> 
				                          <th data-orderable="false">Opciones</th>
				                      </tr>
				                  </thead>

				                  <tbody>
				                 <?php
									$detalles_grupoInst->getTablaSesionGrupo($pkID_grupo);
									?>
				                  </tbody>
				              </table>
					        </div>
					        <!-- /.table-responsive -->
						</div>

					</div>

				</div>
				<!-- /.contenido general -->

			</div>

			<div role="tabpanel" class="tab-pane" id="album">
				<br>
				<!-- contenido general -->

				<div class="panel panel-default proc-pan-def3">

					<div class="titulohead"> 

			            <div class="row">
			              <div class="col-md-6">
			                  <div class="titleprincipal"><h4>Galeria de Álbumes</h4></div>
			              </div>
			              <div class="col-md-6 text-right">
			      			 <button id="btn_album_grupo" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal"  data-grupo="<?php echo $pkID_taller ?>" data-target="#frm_modal_album_grupo"><span class="glyphicon glyphicon-plus"></span> 
			      			 Crear album</button>

			      			 <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID_grup" name="pkID_grup" value=<?php echo $pkID_grupo; ?>>
                        </div>
                    </div>
			              </div>
			            </div>

		            </div>
		            <br><br>
		            <!-- /.panel-heading -->

					<div class="container-fluid">
						<div class="row">
							<?php
								$detalles_grupoInst->getSelectAlbumGrupo($pkID_grupo);
							?>

						
						</div>
					</div>

				</div>

				<!-- /.contenido general -->

			</div>


			<div role="tabpanel" class="tab-pane" id="proyectos">
				<br>
				<!-- contenido general -->
				<br>
				<!-- contenido general -->
				<div class="panel panel-default proc-pan-def3">

					<div class="panel-body">

						<div class="col-md-12">
							<!-- instancia php controller -->
							<?php $detalles_grupoInst->getDataProyectoGen($pkID_grupo);?>
						</div>
						<div class="col-md-12" hidden="true">
							<input type="text" id="grupo_id" value=<?php echo $pkID_grupo; ?>>
							<input type="text" id="grado_grupo" value=<?php echo $pkID_grado; ?>>
							<input type="text" id="institucion_grupo" value=<?php echo $pkID_institucion; ?>>
						</div>
					</div>

				</div>
				<!-- /.contenido general -->

			</div>

	    </div>

      </div>
      <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->