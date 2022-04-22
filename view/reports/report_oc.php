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
                    <div class="col-xs-12 col-md-3">
						<div class="input-group">
						  <input type="text" class="form-control" placeholder="Buscar por Orden de Compra" id='q' onkeyup="load(1);">
						  <span class="input-group-btn">
							<button class="btn btn-default" type="button" onclick='load(1);'><i class='fa fa-search'></i></button>
						  </span>
						</div><!-- /input-group -->
						
					</div>
					<div class="col-md-3 hidden-xs"></div>
					<div class="col-xs-2 col-md-1">
						<div id="loader" class="text-center"></div>
						
					</div>
					<div class="col-xs-10 col-md-5 ">
						<div class="btn-group pull-right">
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
		var per_page=$("#per_page").val();
		var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'./ajax/reporte_oc_ajax.php',
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
	</script>

	<script>
	function reporte(){
		var querys=$("#q").val();
		
		VentanaCentrada('inventory-report-oc-print.php?action=ajax&query='+querys,'Reporte Empleados','','1024','768','true');
	}
	function reporte_excel(){
		var querys=$("#q").val();
		location.href ="excel/excel_compra.php?action=excel&query="+querys;
	}
	</script>