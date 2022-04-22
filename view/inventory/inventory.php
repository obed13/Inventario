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
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Buscar por código" id='product_code' onkeyup="load(1);">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" onclick='load(1);'><i class='fa fa-search'></i></button>
						  	</span>
						</div><!-- /input-group -->
					</div>
					<div class="col-md-3 col-xs-12">
						<!--<input type="text" class="form-control" placeholder="Buscar por nombre" id='q' onkeyup="load(1);">-->
					</div>
					<div class="col-md-3 col-xs-12">
						<div class="input-group">
						<!--<select name="manufacturer_id" id="manufacturer_id" class="form-control" onchange="load(1);">
							<option value="">Selecciona Empleado</option>
						<?php
						$query=mysqli_query($con,"select id, name from manufacturers order by name");
						while ($rw=mysqli_fetch_array($query)){
							?>
							<option value="<?php echo $rw['id'];?>"><?php echo $rw['name'];?></option>
							<?php
						}	
						?>	
						</select>
							<span class="input-group-btn">
							<button class="btn btn-default" type="button" onclick='load(1);'><i class='fa fa-search'></i></button>
						  </span>-->
						</div><!-- /input-group -->
					</div>
					
					<div class="col-xs-12 col-md-3 ">
						<div class="btn-group pull-right">
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

		if($("#product_code").length > 1){
			load(1);
		}else{
			$(".outer_div").empty();
		}
		
	});
	function load(page){
		var product_code=$("#product_code").val();
		var per_page=$("#per_page").val();

		var parametros = {"action":"ajax","page":page,'product_code':product_code,'per_page':per_page};
		
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'./ajax/inventario_ajax.php',
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