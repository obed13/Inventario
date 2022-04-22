 <form class="form-horizontal" method="post" id="update_register" name="update_register" >
<!-- Modal -->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar impuesto</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
				<label for="name_edit" class="col-sm-2 control-label">Nombre</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="name_edit" name="name_edit" placeholder="Descripción del impuesto" required maxlength="100">
					<input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="value_edit" class="col-sm-2 control-label">Valor (%)</label>
				<div class="col-sm-3">
				  <input type="text" class="form-control" id="value_edit" name="value_edit" placeholder="13" required maxlength="5">
				</div>
				
				<label for="status_edit" class="col-sm-2 control-label">Estado</label>
				<div class="col-sm-4">
				  <select class='form-control' name="status_edit" id="status_edit" required>
					<option value="1">Activo</option>
					<option value="2">Inactivo</option>
				  </select>
				</div>
			  </div>
			  
			
			  
			  
			  
				
			 

	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="actualizar_datos" class="btn btn-primary">Actualizar datos</button>
      </div>
    </div>
  </div>
</div>
</form>