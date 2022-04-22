
<!DOCTYPE html>
<html>
  <head>
  
	<?php include("head.php");?>
  </head>
  <body class="hold-transition <?php echo $skin;?> sidebar-mini">
  	<?php 
		if ($permisos_agregar==1){
		include("modal/facturacion.php");
		include("modal/agregar_cliente.php");
		}
	?>
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
		  <h1><i class='fa fa-edit'></i> Agregar nueva venta</h1>
		
		</section>
		<!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Nueva Venta</h3>
              
            </div>
            <div class="box-body">
              <div class="row">
                        

                        <!-- *********************** Purchase ************************** -->
                        <div class="col-md-12 col-sm-12">
                            <form  method="post" name="save_sale" id="save_sale">
                            <div class="box box-info">
                                <div class="box-header box-header-background-light with-border">
                                    <h3 class="box-title  ">Detalles de la Factura</h3>
									<div class='pull-right'>
										<button type="submit"  class="btn btn-success pull-right "><i class="fa fa-print"></i> Guardar e imprimir</button>
									</div>
                                </div>

                                <div class="box-background">
                                <div class="box-body">
									
                                    <div class="row">

                                    <div class="col-md-5">

                                        <label>Cliente</label>
										<div class="input-group">
											<select class="form-control select2" name="customer_id" id="customer_id" >
												<option value="">Selecciona Cliente</option>
											</select>
											<span class="input-group-btn">
												<button class="btn btn-default" type="button" data-toggle="modal" data-target="#cliente_modal"><i class='fa fa-plus'></i> Nuevo</button>
											</span>
										</div>	
                                    </div>
                                    <div class="col-md-3">
                                        <label>Fecha</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" name="purchase_date"  value="<?php echo date("d/m/Y")?>" disabled="">

                                            <div class="input-group-addon">
                                                <a href="#"><i class="fa fa-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-2">

                                        <label>Factura Nº</label>
                                       <input type="text" class="form-control" name="sale_number" id="sale_number" required value="<?php echo nex_sale_number();?>" >
                                    </div>
									
									<div class="col-md-2">

                                        <label>Agregar productos</label>
                                       <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><i class='fa fa-search'></i> Buscar productos</button>
                                    </div>
                                    </div>
									<div class='row'>
										
								</div>
								 </form>
								 <div class='row'>
									<form id="barcode_form" method>	
									<hr>
										 <div class="col-md-1">
											<input class='form-control' type='text' name='barcode_qty' id='barcode_qty'  value='1' required>
										 </div>	
										 
										 <div class="col-md-6">
											<div class="input-group">
													<input class='form-control' type='text' name='barcode' id='barcode' required placeholder="Ingresa el código de barras">
													<span class="input-group-btn">
														<button class="btn btn-default" type="submit" ><i class='fa fa-barcode'></i> </button>
													</span>
											</div>
										 </div>		
									</form>			
								</div>
                                </div><!-- /.box-body -->
                                    </div>


                                

                                

					
                            </div>
                            <!-- /.box -->
                           
                        </div>
                        <!--/.col end -->
						

					
					 
                    </div>
					
					<div id="resultados_ajax" class='col-md-12' style="margin-top:4px"></div><!-- Carga los datos ajax -->
					<div id="resultados" class='col-md-12' style="margin-top:4px"></div><!-- Carga los datos ajax -->
					<div class="box-footer">
						
                    </div>
					
							
			
		   </div><!-- /.box-body -->
            
          </div><!-- /.box -->	
     
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
	<!-- Select2 -->
	
    <script src="plugins/select2/select2.full.min.js"></script>
	<script src="dist/js/VentanaCentrada.js"></script>
	<script>
	$(function () {
        //Initialize Select2 Elements
		$(".select2").select2();
		var taxes=$("#taxes").val();
		$("#resultados" ).load( "./ajax/agregar_tmp.php?tax="+taxes );
		load(1);
	});
		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_ventas.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	function agregar (id)
		{
			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=document.getElementById('cantidad_'+id).value;
			var taxes=$("#taxes").val();
			//Inicia validacion
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}
			if (isNaN(precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_tmp.php",
        data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad+"&tax="+taxes,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
			
			
			
		}
		
			function eliminar (id)
		{
		var taxes=$("#taxes").val();	
		$.ajax({
        type: "GET",
        url: "./ajax/agregar_tmp.php",
        data: "id="+id+"&tax="+taxes,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		function update_sale(customer_id){
		$.ajax({
        type: "POST",
        url: "./ajax/agregar_venta.php",
        data: "customer_id="+customer_id,
			 success: function(datos){
			$("#resultados").html(datos);
			}
		});
		}
		
		$( "#save_sale" ).submit(function( event ) {
			var customer_id=$("#customer_id").val();
			var sale_number=$("#sale_number").val();
			var taxes=$("#taxes").val();
			//Inicia validacion
			if (isNaN(sale_number))
			{
			alert('Esto no es un numero');
			$("#sale_number").val("");
			$("#sale_number").focus();
			return false;
			}
			
			
			VentanaCentrada('new-sale-pdf.php?customer_id='+customer_id+'&sale_number='+sale_number+'&tax='+taxes,'Nueva factura','','1024','768','true');
			
		});	
		
					
				

	</script>
	<script type="text/javascript">




$(document).ready(function() {
    $( ".select2" ).select2({        
    ajax: {
        url: "ajax/customers_select2.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                results: data
            };
        },
        cache: true
		
		
		
    },
    minimumInputLength: 2
	
})

});
</script>
	<script>
$( "#guardar_cliente" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/registro/agregar_cliente.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Enviando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove();});}, 5000);
			$('#cliente_modal').modal('hide');
		  }
	});
  event.preventDefault();
})
</script>
<script>
		$("#barcode_form" ).submit(function( event ) {
		  var barcode=$("#barcode").val();
		  var barcode_qty=$("#barcode_qty").val();
		  var id_sucursal=0;
		  var taxes=$("#taxes").val();
		  parametros={'barcode':barcode,'id_sucursal':id_sucursal,'barcode_qty':barcode_qty,'tax':taxes};
		  
		  $.ajax({
			type: "POST",
			url: "./ajax/agregar_tmp.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados").html(datos);
			$("#barcode").val("");
			$("#barcode").focus();
			}
		});
			
		  event.preventDefault();
		})
	</script>
	<script>
		function tax_value(value){
			$("#resultados" ).load( "./ajax/agregar_tmp.php?tax="+value );
		}
	</script>
  </body>
</html>
