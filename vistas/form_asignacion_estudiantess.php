<!-- Form estudiantess -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_asignacion_estudiantes" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_asignarestudiantes">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_asignarestudiantes" method="POST">
                <br>

                  <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class=" control-label">estudiantes</label>
                        <?php
                          $saberesInst->getSelectestudiantes($pkID_proyectoM);
                          ?>
                    <button id="btn_nuevoestudiante" type="button" class="btn btn-success" data-toggle="modal" data-target="#frm_modal_estudiante"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
</form>
                    <div id='select_tutor'>
                      <label class="control-label">estudiantes Asignados</label>
                      <form id="frm_estudiantessaber_grupo" name="frm_estudiantessaber_grupo"></form>
                    </div>



        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionasignarestudiantes" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionasignarestudiantes"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->