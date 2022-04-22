<!DOCTYPE html>
<html>
  <head>
	<?php include("head.php");?>
	<!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
	<link href="plugins/table-export/dist/css/tableexport.css" rel="stylesheet" type="text/css">
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
                    <div class="col-xs-3">
						<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar"></i>
						 </div>
						  <input type="text" class="form-control pull-right" value="<?php echo "01".date('/m/Y').' - '.date('d/m/Y');?>" id="range" readonly>
						  
						</div><!-- /input-group -->
					</div>
					<div class="col-xs-12 col-md-3">
						<div class="input-group">
      					<input type="text" class='form-control' name="code" id="code" placeholder="Ingresa el código">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" onclick="load(1);"><i class="fa fa-search"></i></button>
							</span>
						</div>
						
						
							
					</div>
					
					
					
					<div class="col-xs-1">
						<div id="loader" class="text-center"></div>
					</div>
					<div class="col-xs-5 ">
						<div class="btn-group pull-right">
							<?php if ($permisos_ver==1){?>
							<button type="button"  onclick="imprimir();" class="btn btn-default"><i class='fa fa-print'></i> Imprimir</button>
							<?php }?>
						</div>
                    </div>
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
	<!-- Include Required Prerequisites -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
	<!-- Include Date Range Picker -->
		<script src="plugins/daterangepicker/daterangepicker.js"></script>
		<script src="plugins/print/demo/jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>
  </body>
</html>
<script>
	$(function() {
		load(1);
		
		        //Date range picker
       // $('#range').daterangepicker();
		
		 $('#range').daterangepicker({
		"locale": {
        "format": "MM/DD/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    "linkedCalendars": false,
    "autoUpdateInput": false,
    "opens": "right"
});
	});
	function load(page){
		var range=$("#range").val();
		var code=$("#code").val();
		var id_suc=$("#id_suc").val();

		
		var parametros = {"action":"ajax","page":page,'range':range,'code':code,"id_suc":id_suc};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'./ajax/reporte_kardex_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='./img/ajax-loader.gif'>");
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
				$("table").tableExport({formats: ["xlsx", "csv", "txt"], position: 'top', fileName:'Reporte de Kardex',   });
			}
		})
	}
</script>
<script>
function imprimir()
{
    $("#print").printArea();
}
</script>
