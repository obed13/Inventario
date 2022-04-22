<?php

/*Datos de la empresa*/
	$sql1=mysqli_query($con,"SELECT * FROM business_profile where id=1");
	$rw1=mysqli_fetch_array($sql1);
	$name=$rw1["name"];
	$number_id=$rw1['number_id'];
	$email=$rw1['email'];
	$phone=$rw1['phone'];
	$tax=$rw1['tax'];
	$currency_id=$rw1['currency_id'];
	$timezone_id=$rw1['timezone_id'];
	$address=$rw1['address'];
	$city=$rw1['city'];
	$postal_code=$rw1['postal_code'];
	$state=$rw1['state'];
	$country_id=$rw1['country_id'];
	$logo_url=$rw1['logo_url'];
	/*Fin datos empresa*/
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
		<?php if ($permisos_editar==1){?>
        
		<!-- Main content -->
        <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Configuración de plantilla de factura</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			
			<div class="row">
				<div id='resultados_ajax' class='col-md-12'></div>
					<?php
						$n=1;
						$sql=mysqli_query($con,"select * from templates order by name");
						while($rw=mysqli_fetch_array($sql)){
							$status=$rw['status'];
					?>
								
					<div class="col-xs-6 col-md-3 text-center">
						<a href="#" class="thumbnail" data-toggle="modal" data-target="#imagemodal" data-url="img/preview/<?php echo $rw['image'];?>" data-title="<?php echo $rw['name'];?>">
						  <img src="img/preview/<?php echo $rw['image'];?>" alt="...">
						</a>
						<input type="radio" name="id_plantilla" id="id_plantilla" value="<?php echo $rw['id'];?>" <?php if ($status== 1){echo "checked";}?> > <?php echo $rw['name'];?>
					  </div>
					<?php
					if ($n%4==0){
						echo "<div class='clearfix'></div>";
					}
					$n++;
						}
						
					?>
								
					  
					 
			</div>
        </div>
        <!-- /.box-body -->
        <div class="panel-footer text-center">
            <button type="submit" class="btn btn-success" onclick="updateProfile();"><i class="fa fa-refresh"></i> Actualizar datos</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

	</section>
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
	<!-- Creates the bootstrap modal where the image will appear -->
		<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Image preview</h4>
			  </div>
			  <div class="modal-body">
				<img src="" id="imagepreview" style="width: 100%" >
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			  </div>
			</div>
		  </div>
		</div>
	<?php include("js.php");?>
	<script>
		function updateProfile(){
			id_plantilla =$('#id_plantilla:checked').val();
			var parametros = {"id_plantilla":id_plantilla };
			 $.ajax({
				type: "POST",
				url: "./ajax/modificar/plantilla.php",
				data: parametros,
				 beforeSend: function(objeto){
					$("#resultados_ajax").html("Mensaje: Cargando...");
				  },
				success: function(datos){
				$("#resultados_ajax").html(datos);
			  }
			});
		}
		$('#imagemodal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var url = button.data('url')
		  var title = button.data('title')
		  var modal = $(this)
		  modal.find('.modal-title').text(title)
		  $('#imagepreview').attr('src', url);
		})
	</script>

  </body>
</html>
