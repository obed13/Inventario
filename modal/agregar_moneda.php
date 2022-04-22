 
<form class="form-horizontal" method="post" id="new_register" name="new_register" >
<!-- Modal -->
<div class="modal fade" id="modal_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nueva Moneda</h4>
      </div>
      <div class="modal-body">
	  
			  <div class="form-group">
				<label for="nombre" class="col-sm-4 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la moneda"required>
				</div>
			  </div>
	  

			  <div class="form-group">
				<label for="simbolo" class="col-sm-4 control-label">Símbolo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="simbolo" name="simbolo" placeholder="Símbolo de la moneda" required maxlength="3">
				</div>
			  </div>
			  <div class="form-group">
				<label for="precision" class="col-sm-4 control-label">Precisión</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="precision" name="precision" placeholder="Número de decimales" required maxlength="1" pattern='[0-9]{1}'>
				</div>
			  </div>
		

			  <div class="form-group">
				<label for="millar" class="col-sm-4 control-label">Separador de millares</label>
				<div class="col-sm-8">
				 <select class="form-control" id="millar" name="millar" required>
					<option value="">-- Selecciona --</option>
					<option value=".">Punto (.) </option>
					<option value=",">Coma (,)</option>
				  </select>
				</div>
			  </div>
 

			  <div class="form-group">
				<label for="decimal" class="col-sm-4 control-label">Separador de decimales</label>
				<div class="col-sm-8">
				 <select class="form-control" id="decimal" name="decimal" required>
					<option value="">-- Selecciona --</option>
					<option value=".">Punto (.) </option>
					<option value=",">Coma (,)</option>
				  </select>
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="codigo" class="col-sm-4 control-label">Código</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código de la moneda" required maxlength="3" >
				</div>
			  </div>
	  

	 
	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="guardar_datos" class="btn btn-primary">Registrar</button>
      </div>
    </div>
  </div>
</div>
</form>