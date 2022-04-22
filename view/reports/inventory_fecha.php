<?php
$dateini = date("Y-m-d", strtotime(date("Y")."-01-01"));
$datefin = date("Y-m-d");;
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
				<div class="row">
                    <div class="col-md-3 col-xs-12">
						Fecha de Inicio: <input type="date" class="form-control" id='fecha_inicio' value="<?php echo $dateini; ?>">
					</div>
					<div class="col-md-3 col-xs-12">
						<!--<input type="text" class="form-control" placeholder="Buscar por nombre" id='q' onkeyup="load(1);">-->
                        <input type="hidden" class="form-control" id='product_code' onkeyup="load(1);">
                        <input type="hidden" class="form-control" id='manufacturer_id' onkeyup="load(1);">
					</div>
					<div class="col-md-3 col-xs-12">
                        Fecha de Fin: <input type="date" class="form-control" id='fecha_fin' value="<?php echo $datefin; ?>">
					</div>
                    
					
					<div class="col-xs-12 col-md-3 ">
						<div class="btn-group pull-right">
					    <button class="btn btn-danger" onclick="load_fecha(1)" id="proceso">Aceptar</button>
						<button type="button"  onclick="reporte_excel();" class="btn btn-success"><i class='fa fa-print'></i> Excel</a>
							<?php if ($permisos_ver==1){?>
								<button type="button"  onclick="reporte();" class="btn btn-warning"><i class='fa fa-print'></i> Imprimir</a>
							<?php }?>
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Mostrar
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right">
							  <li class='active' onclick='per_page(15);' id='15'><a href="#">15</a></li>
							  <li  onclick='per_page(25);' id='25'><a href="#">25</a></li>
							  <li onclick='per_page(50);' id='50'><a href="#">50</a></li>
							  <li onclick='per_page(100);' id='100'><a href="#">100</a></li>
							  <li onclick='per_page(1000000);' id='1000000'><a href="#">Todos</a></li>
							</ul>
							 

						</div>
                    </div>
					<div class="col-xs-12">
						<div id="loader" class="text-center"></div>
						
					</div>
					<input type='hidden' id='per_page' value='15'>
					
             </div>
				
			 
        </section>
			
        <!-- Main content -->
        <section class="content">
			<div id="resultados_ajax"></div>
			<div class="outer_div"></div><!-- Datos ajax Final -->         
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
	<script src="dist/js/VentanaCentrada.js"></script>
  </body>
</html>
	<script>
	$(function() {
		load(1);
	});
	function load(page){
		var query=$("#q").val();
		var product_code=$("#product_code").val();
		var manufacturer_id=$("#manufacturer_id").val();
		
		var per_page=$("#per_page").val();
		var parametros = {"action":"ajax","page":page,'query':query,'product_code':product_code,'manufacturer_id':manufacturer_id,'per_page':per_page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'./ajax/reporte_inventario_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='./img/ajax-loader.gif'>");
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}
	
	function per_page(valor){
		$("#per_page").val(valor);
		load(1);
		$('.dropdown-menu li' ).removeClass( "active" );
		$("#"+valor).addClass( "active" );
	}

    function load_fecha(page){
        var query=$("#q").val();
		var fecha_inicio=$("#fecha_inicio").val();
		var fecha_fin=$("#fecha_fin").val();
		
		var per_page=$("#per_page").val();
		var parametros = {"action":"ajax","page":page,'query':query,'fecha_inicio':fecha_inicio,'fecha_fin':fecha_fin,'per_page':per_page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'./ajax/reporte_inventario_fecha_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='./img/ajax-loader.gif'>");
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
    }
	
	</script>

	<script>
	function reporte(){
		var fecha_inicio=$("#fecha_inicio").val();
		var fecha_fin=$("#fecha_fin").val();
		
		 VentanaCentrada('inventory-report-fecha-print.php?action=ajax&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin,'Reporte inventario','','1024','768','true');
	}
	function reporte_excel(){
		var fecha_inicio=$("#fecha_inicio").val();
		var fecha_fin=$("#fecha_fin").val();
		location.href ='excel/excel_fecha.php?action=excel&&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin;
	}
	</script>