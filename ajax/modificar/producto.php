<?php
session_start();

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../../libraries/password_compatibility_library.php");
}

		$pattern = '/^\d+(?:\.\d{2})?$/';
		
		if (empty($_POST['product_id'])){
			$errors[] = "ID del producto está vacío";
		} else if (empty($_POST['product_code'])){
			$errors[] = "Código del producto está vacío";
		}else if (empty($_POST['product_name'])){
			$errors[] = "Nombre del producto está vacío";
		} else if (empty($_POST['manufacturer_id'])){
			$errors[] = "Fabricante está vacío";
		} else if (empty($_POST['buying_price'])){
			$errors[] = "Precio de compra está vacío";
		//} else if (empty($_POST['selling_price'])){
			//$errors[] = "Precio de venta está vacío";
		} else if(preg_match($pattern, $_POST['buying_price']) == '0'){
			$errors[] = "Precio de compra tiene un formato inválido. Asegurate que sea un número con 2 decimales";
		//} else if(preg_match($pattern, $_POST['selling_price']) == '0'){
			//$errors[] = "Precio de venta tiene un formato inválido. Asegurate que sea un número con 2 decimales";
		}  elseif (
			!empty($_POST['product_code'])
			&& !empty($_POST['product_name'])
			&& !empty($_POST['manufacturer_id'])
			&& !empty($_POST['buying_price'])
			//&& !empty($_POST['selling_price'])
			) {
		
			require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
			require_once ("../../libraries/inventory.php");//Contiene funcion que controla stock en el inventario
			// escaping, additionally removing everything that could be (html/javascript-) code
				$product_id=intval($_POST['product_id']);
                $product_code = mysqli_real_escape_string($con,(strip_tags($_POST["product_code"],ENT_QUOTES)));
				$product_name = mysqli_real_escape_string($con,(strip_tags($_POST["product_name"],ENT_QUOTES)));
				$model= mysqli_real_escape_string($con,(strip_tags($_POST["model"],ENT_QUOTES)));
				$note= mysqli_real_escape_string($con,$_POST["note"]);
				$status= mysqli_real_escape_string($con,(strip_tags($_POST["status"],ENT_QUOTES)));
				$manufacturer_id= mysqli_real_escape_string($con,(strip_tags($_POST["manufacturer_id"],ENT_QUOTES)));
				$buying_price= mysqli_real_escape_string($con,(strip_tags($_POST["buying_price"],ENT_QUOTES)));
				$categoria_id= mysqli_real_escape_string($con,(strip_tags($_POST["categoria_id"],ENT_QUOTES)));
				$presentation= mysqli_real_escape_string($con,(strip_tags($_POST["presentation"],ENT_QUOTES)));
				$ubicacion_id= mysqli_real_escape_string($con,(strip_tags($_POST["ubicacion_id"],ENT_QUOTES)));
				$marca= mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
				$modelo= mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));
				$serie= mysqli_real_escape_string($con,(strip_tags($_POST["serie"],ENT_QUOTES)));
				$adquisicion= mysqli_real_escape_string($con,(strip_tags($_POST["adquisicion"],ENT_QUOTES)));
				$factura= mysqli_real_escape_string($con,(strip_tags($_POST["factura"],ENT_QUOTES)));
				$poliza= mysqli_real_escape_string($con,(strip_tags($_POST["poliza"],ENT_QUOTES)));
				$control= mysqli_real_escape_string($con,(strip_tags($_POST["control"],ENT_QUOTES)));
				$profit= floatval($_POST["profit"]);
				$stock= intval($_POST["stock"]);
				$image_path=$_SESSION['img_tmp'];
				if ($stock>0){
					 $stock_actual=get_stock($product_id);
					if ($stock_actual!=$stock){
						if ($stock_actual>$stock){
							//Disminuye
							$dif=abs($stock_actual-$stock);
							
							
							//Inicio Kardex
								$note="Ajuste de inventario salida";
								$type=2;
								$stock_get=get_stock($product_id);
								$stock_total=$stock_get-$dif;
								$costo_promedio=average_cost_min($product_id, $dif, $buying_price);//Obtengo el costo promedio
								$sale_date=date("Y-m-d H:i:s");
								register_kardex($sale_date, $product_id, $dif, $costo_promedio, $buying_price, $stock_total, $note, $type );
							//Fin Kardex
			
			
						} else {
							//Aumenta
							 $dif=abs($stock-$stock_actual);
							
							//Inicio Kardex
								$note="Ajuste de inventario entrada";
								$type=1;
								$stock_get=get_stock($product_id);
								$stock_total=$stock_get+$dif;
								$costo_promedio=average_cost($product_id, $dif, $buying_price);//Obtengo el costo promedio
								$sale_date=date("Y-m-d H:i:s");
								register_kardex($sale_date, $product_id, $dif, $costo_promedio, $buying_price, $stock_total, $note, $type );
							//Fin Kardex
							
						}
					}
					adjustment_inventory($product_id, $stock);//Agrego producto al inventario
					
					
				}
				
				// update data
                    $sql = "UPDATE products SET product_code='".$product_code."',model='".$model."',product_name='".$product_name."', presentation='".$presentation."', categoria_id='".$categoria_id."', ubicaciones_id='".$ubicacion_id."',
					note='".$note."',status='".$status."', manufacturer_id='".$manufacturer_id."', buying_price='".$buying_price."', selling_price='".$buying_price."', profit='".$profit."', image_path='".$image_path."',
					marca='".$marca."',modelo='".$modelo."',serie='".$serie."',fecha_adquisicion='".$adquisicion."',num_factura='".$factura."',num_poliza='".$poliza."',numero_control='".$control."' WHERE product_id='$product_id' ";
                    $query = mysqli_query($con,$sql);

                    // if user has been update successfully
                    if ($query) {
                        $messages[] = "Los datos han sido procesados exitosamente.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. ".mysqli_error($con);
                    }
                
			
		} else {
			$errors[] = " Desconocido";	
		}
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>			