 <form class="form-horizontal" method="post" id="update_register" name="update_register" >
<!-- Modal -->
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Moneda</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
				<label for="nombre_edit" class="col-sm-4 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre_edit" name="nombre_edit" placeholder="Nombre de la moneda"required>
					<input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="simbolo_edit" class="col-sm-4 control-label">Símbolo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="simbolo_edit" name="simbolo_edit" placeholder="Símbolo de la moneda" required maxlength="3">
					
				</div>
			  </div>
			  <div class="form-group">
				<label for="precision_edit" class="col-sm-4 control-label">Precisión</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="precision_edit" name="precision_edit" placeholder="Número de decimales" required maxlength="1" pattern='[0-9]{1}'>
					
				</div>
			  </div>
			
			  <div class="form-group">
				<label for="millar_edit" class="col-sm-4 control-label">Separador de millares</label>
				<div class="col-sm-8">
				 <select class="form-control" id="millar_edit" name="millar_edit" required>
					<option value="">-- Selecciona --</option>
					<option value=".">Punto (.) </option>
					<option value=",">Coma (,)</option>
				  </select>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="decimal_edit" class="col-sm-4 control-label">Separador de decimales</label>
				<div class="col-sm-8">
				 <select class="form-control" id="decimal_edit" name="decimal_edit" required>
					<option value="">-- Selecciona --</option>
					<option value=".">Punto (.) </option>
					<option value=",">Coma (,)</option>
				  </select>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="codigo_edit" class="col-sm-4 control-label">Código</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="codigo_edit" name="codigo_edit" placeholder="Código de la moneda" required maxlength="3" >
					
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