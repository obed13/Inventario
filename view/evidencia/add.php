<?php
	$target_dir="img/productos/product.png";
	$_SESSION['img_tmp']=$target_dir;
	$product_id=time();
?>
<!DOCTYPE html>
<html>
  <head>
	<?php include("head.php");?>
  </head>
  <body class="hold-transition <?php echo $skin;?> sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
		<?php include("main-header.php");?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
		<?php include("main-sidebar.php");?>
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<?php if ($permisos_agregar==1){?>
        <section class="content-header">
		  <h1><i class='fa fa-edit'></i> Agregar Nuevas Evidencias</h1>
		
		</section>
		<!-- Main content -->
        <section class="content">
		<div class="row">
	
        <!-- /.col -->
        <div class="col-md-12">
		<form name="update_register" id="update_register" class="form-horizontal" method="post" enctype="multipart/form-data">
		
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Detalles de los Evidencia</a></li>
             
			  
            </ul>
            <div class="tab-content">
                <div id="resultados_ajax"></div>

                    <div class="tab-pane active" id="details">

                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="note" id="note"></textarea>
                            </div>
                        </div>
                    
                        <div class="form-group ">

                            <label for="model" class="col-sm-2 control-label">Programa</label>
                            <div class="col-sm-4">
                            <input type="hidden"  id="product_id" name="product_id"  value="<?php echo $product_id;?>" >
                            <select class="form-control" name="model" id="model" required>
                                <option value="">Selecciona</option>
                                <?php 
                                    $sql=mysqli_query($con,"select *  from programa where status=1 order by name");
                                    while ($rw=mysqli_fetch_array($sql)){ ?>
                                    <option value="<?php echo $rw['id'];?>"><?php echo $rw['name'];?></option>
                                    <?php } ?>
                            </select>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="product_name" class="col-sm-2 control-label">Subcuenta</label>

                            <div class="col-sm-4">
                            <select class="form-control" name="product_name" id="product_name" required>
                                <option value="">Selecciona</option>
                                <?php 
                                    $sql=mysqli_query($con,"select *  from subcuenta where status=1 order by name");
                                    while ($rw=mysqli_fetch_array($sql)){
                                        $id=$rw['id'];
                                        $name=$rw['name'];
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            </div>
                            <label for="presentation" class="col-sm-2 control-label">Orden de compra</label>

                            <div class="col-sm-4">
                            <input type="text" class="form-control" id="presentation" name="presentation" maxlength="100" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="manufacturer_id" class="col-sm-2 control-label">Empleado</label>

                            <div class="col-sm-4">
                            <select class="form-control" name="manufacturer_id" id="manufacturer_id" required>
                                <option value="">Selecciona</option>
                                <?php 
                                    $sql=mysqli_query($con,"select *  from manufacturers where status=1 order by name");
                                    while ($rw=mysqli_fetch_array($sql)){
                                        $id=$rw['id'];
                                        $name=$rw['name'];
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            </div>
                            
                            <label for="status" class="col-sm-2 control-label">Estado</label>

                            <div class="col-sm-4">
                            <select class="form-control" name="status" id="status">
                                <option value="1">Alta</option>
                                <option value="0">Baja</option>
                                <option value="3">Prestamo</option>
                                </select>
                            </div>
                            
                            
                        </div>

                        <div class="form-group">
                            <label for="buying_price" class="col-sm-2 control-label">Importe</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-usd"></i>
                                </div>
                                <input type="text" class="form-control" id="buying_price" name="buying_price" required pattern="\d+(\.\d{2})?" title="precio con 2 decimales" onkeyup="precio_venta();">
                                </div>
                            </div>
                            <label for="ubicacion_id" class="col-sm-2 control-label">Ubicación</label>

                            <div class="col-sm-4">
                            <select class="form-control" name="ubicacion_id" id="ubicacion_id" required>
                                <option value="">Selecciona</option>
                                <?php 
                                    $sql=mysqli_query($con,"select *  from ubicacion where status=1 order by name");
                                    while ($rw=mysqli_fetch_array($sql)){
                                        $id=$rw['id'];
                                        $name=$rw['name'];
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            </div>
                            
                            
                        </div>
                    
                        <div class="form-group">
                            <label for="categoria_id" class="col-sm-2 control-label">Categoria</label>

                            <div class="col-sm-4">
                            <select class="form-control" name="categoria_id" id="categoria_id" required>
                                <option value="">Selecciona</option>
                                <?php 
                                    $sql=mysqli_query($con,"select *  from categoria where status=1 order by name");
                                    while ($rw=mysqli_fetch_array($sql)){
                                        $id=$rw['id'];
                                        $name=$rw['name'];
                                    ?>
                                    <option value="<?php echo $id;?>"><?php echo $name;?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            </div>
                            
                            
                            
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">Documento</label>

                            <div class="col-sm-6">
                                <input type="file"  class='form-control' name="imagefile" id="imagefile" onchange="upload_image(<?php echo $product_id; ?>);">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-primary actualizar_datos">Guardar datos</button>
                            </div>
                        </div>
                
                    </div>
              <!-- /.tab-pane -->
                </div>
            <!-- /.tab-content -->
            </div>
          <!-- /.nav-tabs-custom -->
		  </form>
        </div>
        <!-- /.col -->
      </div>
     
        </section><!-- /.content -->
		<?php 
		} else{
		?>	
		<section class="content">
			<div class="alert alert-danger">
				<h3>Acceso denegado! </h3>
				<p>No cuentas con los permisos necesario para acceder a este módulo.</p>
			</div>
		</section>		
		<?php
		}
		?>
      </div><!-- /.content-wrapper -->
      <?php include("footer.php");?>
    </div><!-- ./wrapper -->
	<?php include("js.php");?>
	

	<script>
		function upload_image(product_id){
				$("#load_img").text('Cargando...');
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('imagefile',file);
				data.append('product_id',product_id);
				
				
				$.ajax({
					url: "ajax/imagen_evidencia_ajax.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$("#load_img").html(data);
						
					}
				});
				
			}
    </script>
		<script>
		$( "#update_register" ).submit(function( event ) {
		  $('.actualizar_datos').attr("disabled", true);
		  var parametros = $(this).serialize();
		  $.ajax({
				type: "POST",
				url: "./ajax/registro/agregar_evidencia.php",
				data: parametros,
				 beforeSend: function(objeto){
					$("#resultados_ajax").html("Mensaje: Cargando...");
				  },
				success: function(datos){
				$("#resultados_ajax").html(datos);
				$('.actualizar_datos').attr("disabled", false);
				window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove();});}, 5000);
				
			  }
		});		
		  event.preventDefault();
		});
	</script>
	
	
  </body>
</html>