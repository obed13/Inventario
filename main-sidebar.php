<?php 
 if (isset($_SESSION['user_id'])){

?>
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/admin.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['full_name']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ</li>
            <li class="<?php if (isset($home) and $home==1){echo "active";}?>">
              <a href="index.php">
                <i class="fa fa-home"></i> <span>Inicio</span> 
              </a>
              
            </li>
			<?php 
				permisos_menu('Bienes',$cadena_permisos);
				if ($permisos_ver_menu==1){
			?>
            <li class="<?php if (isset($reports) and $reports==1){echo "active";}?> treeview">
              <a href="#">
                <i class="glyphicon glyphicon-file"></i> <span>Bienes Inventariados</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if (isset($report_empleado) and $report_empleado==1){echo "active";}?>"><a href="products.php"><i class="fa fa-tag"></i>Bienes Altas</a></li>
				
				<li class="<?php if (isset($purchases_report) and $purchases_report==1){echo "active";}?>"><a href="products1.php"><i class="fa fa-tag"></i>Bienes Bajas</a></li>
				
				<li class="<?php if (isset($report_categoria) and $report_categoria==1){echo "active";}?>"><a href="products2.php"><i class="fa fa-tag"></i>Bienes Prestamo </a></li>
				
				<li class="<?php if (isset($report_categoria) and $report_categoria==1){echo "active";}?>"><a href="products3.php"><i class="fa fa-tag"></i>Bienes Traspaso </a></li>
				
				<li class="<?php if (isset($report_programa) and $report_programa==1){echo "active";}?>"><a href="products4.php"><i class="fa fa-tag"></i>Bienes No Inventaribles </a></li>
			 </ul>
            </li>
			<?php } ?>
			
			<?php 
				permisos_menu('Informacion',$cadena_permisos);
				if ($permisos_ver_menu==1){
			?>
            <li class="<?php if (isset($reports) and $reports==1){echo "active";}?> treeview">
              <a href="#">
                <i class="glyphicon glyphicon-file"></i> <span>Información General</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if (isset($report_empleado) and $report_empleado==1){echo "active";}?>"><a href="manufacturers.php"><i class="fa fa-tag"></i>Empleados</a></li>
				
				<li class="<?php if (isset($purchases_report) and $purchases_report==1){echo "active";}?>"><a href="ubicacion.php"><i class="fa fa-tag"></i>Ubicación</a></li>
				
				<li class="<?php if (isset($report_categoria) and $report_categoria==1){echo "active";}?>"><a href="categoria.php"><i class="fa fa-tag"></i>Categoria</a></li>
				
				<li class="<?php if (isset($report_categoria) and $report_categoria==1){echo "active";}?>"><a href="programa.php"><i class="fa fa-tag"></i>Programa</a></li>
				
				<li class="<?php if (isset($report_programa) and $report_programa==1){echo "active";}?>"><a href="subcuenta.php"><i class="fa fa-tag"></i>Subcuenta </a></li>
			 </ul>
            </li>
			<?php } ?>
			
			  <?php 
				permisos_menu('registro',$cadena_permisos);
				if ($permisos_ver_menu==1){
			?>
            <li class="<?php if (isset($reports) and $reports==1){echo "active";}?> treeview">
              <a href="#">
                <i class="glyphicon glyphicon-file"></i> <span>Inventario y Evidencia</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if (isset($report_empleado) and $report_empleado==1){echo "active";}?>"><a href="evidencia.php"><i class="fa fa-tag"></i>Evidencia</a></li>
				
				<li class="<?php if (isset($purchases_report) and $purchases_report==1){echo "active";}?>"><a href="inventory.php"><i class="fa fa-tag"></i>Inventario Anual</a></li>
				
			 </ul>
            </li>
			<?php } ?>
			
			<?php 
				permisos_menu('informatica',$cadena_permisos);
				if ($permisos_ver_menu==1){
			?>
            <li class="<?php if (isset($reports) and $reports==1){echo "active";}?> treeview">
              <a href="#">
                <i class="glyphicon glyphicon-file"></i> <span>Informatica</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if (isset($report_empleado) and $report_empleado==1){echo "active";}?>"><a href="informatica.php"><i class="fa fa-tag"></i>Registro de Mantenimientos</a></li>
				
				<li class="<?php if (isset($purchases_report) and $purchases_report==1){echo "active";}?>"><a href="#"><i class="fa fa-tag"></i>Reportes de Mantenimientos</a></li>
				
			 </ul>
            </li>
			<?php } ?>
			  
			  
			<?php 
				permisos_menu('Reportes',$cadena_permisos);
				if ($permisos_ver_menu==1){
			?>
            <li class="<?php if (isset($reports) and $reports==1){echo "active";}?> treeview">
              <a href="#">
                <i class="glyphicon glyphicon-signal"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if (isset($report_empleado) and $report_empleado==1){echo "active";}?>"><a href="inventory_report_empleado.php"><i class="fa fa-bar-chart"></i> Reporte de Empleados</a></li>
				
				<li class="<?php if (isset($purchases_report) and $purchases_report==1){echo "active";}?>"><a href="inventory_report_fecha.php"><i class="fa fa-bar-chart"></i> Reporte por Fecha</a></li>
				
				<li class="<?php if (isset($report_categoria) and $report_categoria==1){echo "active";}?>"><a href="inventory_report_no_inventariables.php"><i class="fa fa-bar-chart"></i> Reporte No Inventariables</a></li>
				
				<li class="<?php if (isset($report_categoria) and $report_categoria==1){echo "active";}?>"><a href="inventory_report_categoria.php"><i class="fa fa-bar-chart"></i> Reporte por Categoria</a></li>
				
				<li class="<?php if (isset($report_programa) and $report_programa==1){echo "active";}?>"><a href="inventory_report_programa.php"><i class="fa fa-bar-chart"></i> Reporte por Programa</a></li>
				
				<li class="<?php if (isset($report_subcuenta) and $report_subcuenta==1){echo "active";}?>"><a href="inventory_report_subcuenta.php"><i class="fa fa-bar-chart"></i> Reporte por Subcuenta</a></li>
				
				<li class="<?php if (isset($report_ubicacion) and $report_ubicacion==1){echo "active";}?>"><a href="inventory_report_ubicacion.php"><i class="fa fa-bar-chart"></i> Reporte por Ubicación</a></li>
				
				<li class="<?php if (isset($report_oc) and $report_oc==1){echo "active";}?>"><a href="inventory_report_oc.php"><i class="fa fa-bar-chart"></i> Reporte por Oden de Compra</a></li>
				
				<li class="<?php if (isset($anual_report) and $anual_report==1){echo "active";}?>"><a href="inventory_anual.php"><i class="fa fa-bar-chart"></i> Reporte de Inventario Anual</a></li>
				
				
				<li class="<?php if (isset($resguardo_art) and $resguardo_art==1){echo "active";}?>"><a href="informatica.php"><i class="fa fa-bar-chart"></i> Resguardo por Articulo</a></li>
				
				<li class="<?php if (isset($resguardo_emp) and $resguardo_emp==1){echo "active";}?>"><a href="resguardo_empleado.php"><i class="fa fa-bar-chart"></i> Resguardo por Empleado</a></li>
			 </ul>
            </li>
			<?php } ?>
			<?php 
				permisos_menu('Permisos',$cadena_permisos);
				$permisos_grupos=$permisos_ver_menu;
				permisos_menu('Usuarios',$cadena_permisos);
				$permisos_usuarios=$permisos_ver_menu;
				if ($permisos_grupos==1 or $permisos_usuarios==1){
			?>
			<li class="<?php if (isset($access) and $access==1){echo "active";}else {echo "";}?> treeview">
              <a href="#">
                <i class="fa fa-lock"></i> <span>Administrar accesos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			<?php 
				if ($permisos_grupos==1){
			?>  
                <li class="<?php if (isset($groups) and $groups==1){echo "active";}else {echo "";}?>"><a href="group_list.php"><i class="glyphicon glyphicon-briefcase"></i> Grupos de usuarios</a></li>
			<?php } ?>	
			<?php 
				if ($permisos_usuarios==1){
			?>
				<li class="<?php if (isset($users) and $users==1){echo "active";}else {echo "";}?>"><a href="user_list.php"><i class="fa fa-users"></i> Usuarios</a></li>
			<?php } ?>	
              </ul>
            </li>
            <?php } ?>
            
           
          </ul>
        </section>
        <!-- /.sidebar -->
		<?php
 }
		?>