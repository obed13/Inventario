<?php
	
	if (isset($_GET['id'])){
		$product_id=intval($_GET['id']);
		$sql_product=mysqli_query($con,"select * from products where  product_id='$product_id'");
		$count=mysqli_num_rows($sql_product);
		$rw_product=mysqli_fetch_array($sql_product);
		$product_code=$rw_product['product_code'];
		$model=$rw_product['model'];
		$product_name=$rw_product['product_name'];
		$presentation=$rw_product['presentation'];
		$note=$rw_product['note'];
		$manufacturer_id=$rw_product['manufacturer_id'];
		$status=$rw_product['status'];
		$buying_price=number_format($rw_product['buying_price'],2,'.','');
		$selling_price=number_format($rw_product['selling_price'],2,'.','');
		$profit=floatval($rw_product['profit']);
		$image_path=$rw_product['image_path'];
		$categoria_id=$rw_product['categoria_id'];
		$ubicaciones_id=$rw_product['ubicaciones_id'];
		$_SESSION['img_tmp']=$image_path;
	}
	
	if (!isset($_GET['id']) or $count!=1){
		header("location: products.php");
	}
	
	
	
	
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
		<?php if ($permisos_ver==1){?>
        <section class="content-header">
		  <h1><i class='fa fa-edit'></i> Detalle bienes</h1>
		
		</section>
		<!-- Main content -->
        <section class="content">
		<div class="row">
		
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
			<div id="load_img">
              <img class=" img-responsive" src="<?php echo 	$image_path;?>" alt="Bussines profile picture">
			  </div>
				<h3 class="profile-username text-center"><?php echo $product_name;?></h3>

              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  
		  
		  <div class="box box-primary">
            <div class="box-body box-profile text-center">
				
					<svg id="barcode"></svg>
				

              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
			<form name="update_register" id="update_register" class="form-horizontal" method="post" enctype="multipart/form-data">
				
			
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#details" data-toggle="tab" aria-expanded="false">Detalles de los bienes</a></li>
            </ul>
            <div class="tab-content">
              <div id="resultados_ajax"></div>
           
             

              <div class="tab-pane active" id="details">
              
                  <div class="form-group ">
                    <label for="product_code" class="col-sm-2 control-label">Código</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="product_code" name="product_code"  value="<?php echo $product_code;?>" disabled>
					  <input type="hidden"  id="product_id" name="product_id"  value="<?php echo $product_id;?>" >
					   
                    </div>
					
					<label for="programa_id" class="col-sm-2 control-label">Programa</label>

                    <div class="col-sm-4">
					<select class="form-control" name="model" id="model" disabled>
						<option value="">Selecciona</option>
						<?php 
							$sql=mysqli_query($con,"select *  from programa where status=1 order by name");
							while ($rw=mysqli_fetch_array($sql)){
								$id=$rw['id'];
								$name=$rw['name'];
								if ($model==$id){$selected1="selected";}else{$selected1="";}
							?>
							<option value="<?php echo $id;?>" <?php echo$selected1;?>><?php echo $name;?></option>
							<?php
							}
						?>
					  </select>
                    </div>
					
					
                  </div>
				 
				  <div class="form-group">
                    <label for="subcuenta_id" class="col-sm-2 control-label">Subcuenta</label>

                    <div class="col-sm-4">
                      <select class="form-control" name="subcuenta_id" id="subcuenta_id" disabled>
						<option value="">Selecciona</option>
						<?php 
							$sql=mysqli_query($con,"select *  from subcuenta where status=1 order by name");
							while ($rw=mysqli_fetch_array($sql)){
								$id=$rw['id'];
								$name=$rw['name'];
								if ($manufacturer_id==$id){$selected1="selected";}else{$selected1="";}
							?>
							<option value="<?php echo $id;?>" <?php echo
							 $selected1;?>><?php echo $name;?></option>
							<?php
							}
						?>
					  </select>
                    </div>
					
					<label for="presentation" class="col-sm-2 control-label">Orden de compra</label>

                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="presentation" name="presentation" value="<?php echo $presentation;?>"  maxlength="100"  disabled>
                    </div>
					
					
                  </div>
                  <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Descripción</label>
                    <div class="col-sm-10">
						<textarea class="form-control" name="note" id="note" disabled><?php echo $note;?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="manufacturer_id" class="col-sm-2 control-label">Empleado</label>

                    <div class="col-sm-4">
                      <select class="form-control" name="manufacturer_id" id="manufacturer_id" disabled>
						<option value="">Selecciona</option>
						<?php 
							$sql=mysqli_query($con,"select *  from manufacturers where status=1 order by name");
							while ($rw=mysqli_fetch_array($sql)){
								$id=$rw['id'];
								$name=$rw['name'];
								if ($manufacturer_id==$id){$selected1="selected";}else{$selected1="";}
							?>
							<option value="<?php echo $id;?>" <?php echo
							 $selected1;?>><?php echo $name;?></option>
							<?php
							}
						?>
					  </select>
                    </div>
					 <label for="status" class="col-sm-2 control-label">Estado</label>

                    <div class="col-sm-4">
                      <select class="form-control" name="status" id="status" disabled>
						<option value="1" <?php if ($status==1){echo "selected";}?>>Alta</option>
						<option value="0" <?php if ($status==0){echo "selected";}?>>Baja</option>
						<option value="3" <?php if ($status==3){echo "selected";}?>>Prestamo</option>
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
						  <input type="text" class="form-control" id="buying_price" name="buying_price" value="<?php echo $buying_price;?>" required pattern="\d+(\.\d{2})?" title="precio con 2 decimales" onkeyup="precio_venta();" disabled>
						</div>
                    </div>
					
					<label for="ubicacion_id" class="col-sm-2 control-label">Ubicación</label>

                    <div class="col-sm-4">
                      <select class="form-control" name="ubicacion_id" id="ubicacion_id" disabled>
						<option value="">Selecciona</option>
						<?php 
							$sql=mysqli_query($con,"select *  from ubicacion where status=1 order by name");
							while ($rw=mysqli_fetch_array($sql)){
								$id=$rw['id'];
								$name=$rw['name'];
								if ($ubicaciones_id==$id){$selected1="selected";}else{$selected1="";}
							?>
							<option value="<?php echo $id;?>" <?php echo
							 $selected1;?>><?php echo $name;?></option>
							<?php
							}
						?>
					  </select>
                    </div>
					
					
                  </div>
                  
				  <div class="form-group">
                    <label for="categoria_id" class="col-sm-2 control-label">Categoria</label>

                    <div class="col-sm-4">
					<select class="form-control" name="categoria_id" id="categoria_id" disabled>
						<option value="">Selecciona</option>
						<?php 
							$sql=mysqli_query($con,"select *  from categoria where status=1 order by name");
							while ($rw=mysqli_fetch_array($sql)){
								$id=$rw['id'];
								$name=$rw['name'];
								if ($categoria_id==$id){$selected1="selected";}else{$selected1="";}
							?>
							<option value="<?php echo $id;?>" <?php echo $selected1;?>><?php echo $name;?></option>
							<?php
							}
						?>
					  </select>
                    </div>
					
					
                  </div>

				  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                      <a href="products.php" class="btn btn-primary actualizar_datos">Regresar</a>
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
	<script type="text/javascript" src="dist/js/JsBarcode.all.min.js"></script>

	<script>
		function upload_image(product_id){
				$("#load_img").text('Cargando...');
				var inputFileImage = document.getElementById("imagefile");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('imagefile',file);
				data.append('product_id',product_id);
				
				
				$.ajax({
					url: "ajax/imagen_product_ajax.php",        // Url to which the request is send
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
				url: "./ajax/modificar/producto.php",
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
				generarbarcode();
			  }
		});		
		  event.preventDefault();
		});
	</script>
	
	<script>
	function precio_venta(){
		var profit = $("#profit").val();
		var buying_price = $("#buying_price").val();
		
		var parametros = {"profit":profit,"buying_price":buying_price};
		$.ajax({
				dataType: "json",
				type:"POST",
				url:'./ajax/precio.php',
				data: parametros,
				 success:function(data){
					//$("#datos").html(data).fadeIn('slow');
				 $.each(data, function(index, element) {
					var precio= element.precio;
					$("#selling_price").val(precio);
                });
    
					
				}
			})
	}
	
	</script>
	<script>
		//función para generar el código de barras
		function generarbarcode(){
			codigo=$("#product_code").val();
			JsBarcode("#barcode", codigo);
			$("#barcode").css('width','100%');
		}
		generarbarcode();
	</script>
  </body>
</html>
