<?php
	$_SESSION['purchase_id']=intval($_GET['id']);
	$sql_purchase=mysqli_query($con,"select * from purchases where purchase_id='".$_SESSION['purchase_id']."'");
	$count=mysqli_num_rows($sql_purchase);
	$rw_purchase=mysqli_fetch_array($sql_purchase);
	$purchase_order_number=$rw_purchase['purchase_order_number'];
	$supplier_id=$rw_purchase['supplier_id'];
	$purchase_date=$rw_purchase['purchase_date'];
	$purchase_date= date('d/m/Y', strtotime($rw_purchase['purchase_date']));
	if (!isset($_GET['id']) or $count!=1){
		header("location: purchase_list.php");
	}
	
	
	
?>
<!DOCTYPE html>
<html>
  <head>
 	<?php include("head.php");?>
	<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  </head>
  <body class="hold-transition <?php echo $skin;?> sidebar-mini">
  	<?php 
		if ($permisos_editar==1){
		include("modal/buscar_productos.php");
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
		<?php if ($permisos_editar==1){?>
        <section class="content-header">
		  <h1><i class='fa fa-edit'></i> Editar compra</h1>
		
		</section>
		<!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Compra</h3>
              
            </div>
            <div class="box-body">
              <div class="row">
                        

                        <!-- *********************** Purchase ************************** -->
                        <div class="col-md-12 col-sm-12">
                            <form method="post">
                            <div class="box box-info">
                                <div class="box-header box-header-background-light with-border">
                                    <h3 class="box-title  ">Detalles de la compra</h3>
                                </div>

                                <div class="box-background">
                                <div class="box-body">
                                    <div class="row">

                                    <div class="col-md-4">

                                        <label>Proveedor</label>
                                        <select class="form-control select2" name="supplier_id" onchange="return update_purchase(this.value,1);">
											<option value="">Selecciona Proveedor</option>
											<?php 
											$sql_supplier=mysqli_query($con,"select id, name from suppliers order by name");
											while ($rw=mysqli_fetch_array($sql_supplier)){
												if ($supplier_id==$rw['id']){$selected="selected";}
												else{$selected="";}
											?>
											<option value="<?php echo $rw['id'];?>" <?php echo $selected;?>><?php echo $rw['name'];?></option>
											<?php
											}
											?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Fecha</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker" name="purchase_date"  value="<?php echo $purchase_date;?>" readonly onchange="return update_purchase(this.value,2);">

                                            <div class="input-group-addon">
                                                <a href="#"><i class="fa fa-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-3">

                                        <label>Compra Nº</label>
                                       <input type="text" class="form-control" name="order_number" id="order_number"  value="<?php echo $purchase_order_number;?>" onkeyup="return update_purchase(this.value,3);">
                                    </div>
									
									<div class="col-md-2">

                                        <label>Agregar productos</label>
                                       <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal"><i class='fa fa-search'></i> Buscar productos</button>
                                    </div>
                                    </div>

                                </div><!-- /.box-body -->
                                    </div>


                                <div class="box-footer">

                                </div>

                                


                            </div>
                            <!-- /.box -->
                            </form>
                        </div>
                        <!--/.col end -->
						


                    </div>
					<div id="resultados" class='col-md-12' style="margin-top:4px"></div><!-- Carga los datos ajax -->
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
	<script>
	$(function () {
        //Initialize Select2 Elements
		$(".select2").select2();
		$( "#resultados" ).load( "./ajax/agregar_compra.php" );
		//datepicker
		$('.datepicker').datepicker({
			format: 'dd/mm/yyyy',
			 endDate: '-1d',
			autoclose: true
		});
	});
	
		$(document).ready(function(){
			load(1);
			
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_compras.php?action=ajax&page='+page+'&q='+q,
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
        url: "./ajax/agregar_compra.php",
        data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
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
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_compra.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		function update_purchase(valor,campo){
		$.ajax({
        type: "POST",
        url: "./ajax/agregar_compra.php",
        data: "valor="+valor+"&campo="+campo,
			 success: function(datos){
			$("#resultados").html(datos);
			}
		});
		}
		
		

		
					
				

	</script>
	
  </body>
</html>
