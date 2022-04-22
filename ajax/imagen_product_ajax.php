
	<?php
	
				session_start();
				/* Connect To Database*/
				require_once ("../config/db.php");
				require_once ("../config/conexion.php");
				$product_id=intval($_REQUEST['product_id']);
				$target_dir="../img/productos/";
				$image_name = time()."_".basename($_FILES["imagefile"]["name"]);
				$target_file = $target_dir .$image_name ;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$imageFileZise=$_FILES["imagefile"]["size"];
				
				/* Inicio Validacion*/
				// Allow certain file formats
				if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) and $imageFileZise>0) {
				$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
				} else if ($imageFileZise > 5242880) {//1048576 byte=1MB  5242880 byte=5MB
				$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
				} else if (empty($product_id)){
					$errors[]= "<p>ID del producto está vacío.</p>";
				}  else
			{
				
				
				
				/* Fin Validacion*/
				if ($imageFileZise>0){
				move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file);
				$imagen=basename($_FILES["imagefile"]["name"]);
				$img_update="image_path='img/productos/$image_name' ";
				$_SESSION['img_tmp']="img/productos/$image_name";
				?>
				<img class="img-responsive" src="img/productos/<?php echo $image_name;?>" alt="Bussines profile picture">
				<?php
				}	else { 
					$target_dir="img/productos/product.png";
					$_SESSION['img_tmp']=$target_dir;
					$errors[] = "Lo sentimos, actualización falló. Intente nuevamente.";
				}
			}
				
					
				
				
				
		
	?>
	
	<?php 
										if (isset($errors)){
											?>
										<div class="alert alert-danger">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Error! </strong>
											<?php
											foreach ($errors as $error){
													echo $error;
												}
											?>
										</div>	
											<?php
										}
									?>
									<?php 
										if (isset($messages)){
											?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Aviso! </strong>
											<?php
											foreach ($messages as $message){
													echo $message;
												}
											?>
										</div>	
											<?php
										}
									?>