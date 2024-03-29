<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_acompanamiento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_acompanamiento">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_acompanamiento" method="POST" enctype="multipart/form-data">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_acompanamiento" name="fkID_acompanamiento" value="'$pkID_acompanamiento'">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha_acompanamiento" name="fecha_acompanamiento" placeholder="Fecha de acompañamiento" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required="true">
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionacompanamiento" type="button" class="btn btn-primary botonnewacompanamiento" data-action="-">
            <span id="lbl_btn_actionacompanamiento"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
