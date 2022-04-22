<!DOCTYPE html>
<html>
  <head>
	<?php include("head.php");?>
	<style>
		label.error {color: #B94A48; margin-top: 2px;}
	</style>
  </head>
  <body class="hold-transition <?php echo $skin;?> sidebar-mini">
	<?php 
		if ($permisos_agregar==1){
			include("modal/agregar_proveedor.php");
		}
		if ($permisos_editar==1){
			include("modal/editar_proveedor.php");
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
		<?php if ($permisos_ver==1){?>
        <section class="content-header">
				<div class="row">
                    <div class="col-xs-12 col-md-3">
						<div class="input-group">
						  <input type="text" class="form-control" placeholder="Buscar por nombre" id='q' onkeyup="load(1);">
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
							<?php if ($permisos_agregar==1){?>
							<button type="button" class="btn btn-default"  data-toggle="modal" data-target="#proveedor_modal"><i class='fa fa-plus'></i> Nuevo</button>
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
	<script src="dist/js/jquery.validate.min.js"></script>
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
			url:'./ajax/proveedores_ajax.php',
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
		function eliminar(id){
			if(confirm('Esta acción  eliminará de forma permanente el proveedor \n\n Desea continuar?')){
				var page=1;
				var query=$("#q").val();
				var per_page=$("#per_page").val();
				
				var parametros = {"action":"ajax","page":page,"query":query,"per_page":per_page,"id":id};
				
				$.ajax({
					url:'./ajax/proveedores_ajax.php',
					data: parametros,
					 beforeSend: function(objeto){
					$("#loader").html("<img src='./img/ajax-loader.gif'>");
				  },
					success:function(data){
						$(".outer_div").html(data).fadeIn('slow');
						$("#loader").html("");
						window.setTimeout(function() {
						$(".alert").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();});}, 5000);
					}
				})
			}
		}
	</script>
	



<script>
var form1 = $( "#guardar_proveedor" );
form1.validate({ ignore: "" });

$( "#guardar_proveedor" ).submit(function( event ) {
  
 var form1 = $(this).valid(); 
 var parametros = $(this).serialize();
 if (this.hasChildNodes('.nav.nav-tabs')) {
        var validator = $(this).validate();
        $(this).find("input").each(function () {
            if (!validator.element(this)) {
                form1= false;
                $('a[href=#' + $(this).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
                return false;
            }
        });
    }
if (form1) {	
	$('#guardar_datos').attr("disabled", true);
	 $.ajax({
			type: "POST",
			url: "ajax/registro/agregar_proveedor.php",
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
			$('#proveedor_modal').modal('hide');
		  }
	});
  event.preventDefault();
}  
})
</script>

<script>
var form2 = $( "#editar_proveedor" );
form2.validate({ ignore: "" });
$( "#editar_proveedor" ).submit(function( event ) {
	
	var form2 = $(this).valid();
    if (this.hasChildNodes('.nav.nav-tabs')) {
        var validator = $(this).validate();
        $(this).find("input").each(function () {
            if (!validator.element(this)) {
                form2 = false;
                $('a[href=#' + $(this).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
                return false;
            }
        });
    }
	if (form2) {
  $('#actualizar_datos').attr("disabled", true);
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/modificar/proveedor.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Enviando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
			window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove();});}, 5000);
			$('#proveedor_edit').modal('hide');
		  }
	});
  event.preventDefault();
	} 
});
</script>
<script>
		function editar(id){
			var parametros = {"action":"ajax","id":id};
			$.ajax({
					url:'modal/editar/proveedor.php',
					data: parametros,
					 beforeSend: function(objeto){
					$("#loader2").html("<img src='./img/ajax-loader.gif'>");
				  },
					success:function(data){
						$(".outer_div2").html(data).fadeIn('slow');
						$("#loader2").html("");
						checked_all();
					}
				})
		}
		
		
</script>