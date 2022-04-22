<?php

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../../libraries/password_compatibility_library.php");
}	

	if (empty($_GET['product_code'])){
			$errors[] = "El Código está vacío.";
		} elseif (!empty($_GET['product_code'])){

			require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
			// escaping, additionally removing everything that could be (html/javascript-) code
            $product_code = mysqli_real_escape_string($con,(strip_tags($_GET["product_code"],ENT_QUOTES)));

            $tables="products, manufacturers, categoria, ubicacion";
		    $campos="products.product_id, products.product_code, products.product_name, products.note, products.status, products.buying_price, manufacturers.name as empleado, categoria.name,ubicacion.name as ubicacion_name,products.marca,products.modelo,products.serie,products.fecha_adquisicion,products.num_factura,products.num_poliza,products.numero_control";
		    $sWhere="products.manufacturer_id=manufacturers.id AND products.categoria_id=categoria.id AND products.ubicaciones_id=ubicacion.id AND products.product_code =".$product_code."";
            $sWhere.=" order by products.product_code DESC";

            $query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere");

            while($row = mysqli_fetch_array($query)){	
                $codigo=$row['product_code'];
                $nombre=$row['empleado'];
                $descripcion=$row['note'];
                $ubucacion=$row['product_code'];
                $categoria=$row['name'];
                $ubicacion=$row['ubicacion_name'];
                $ordenCompra=$row['product_code'];
                $costo=$row['buying_price'];
                $date= date('Y-m-d H:i:s');
				$marca=$row['marca'];
				$modelo=$row['modelo'];
				$serie=$row['serie'];
				$adquisicion=$row['fecha_adquisicion'];
				$num_factura=$row['num_factura'];
				$num_poliza=$row['num_poliza'];
				$numero_control=$row['numero_control'];

			//Write register in to database 
			$sql = "INSERT INTO `inventario` (`codigo`,`nombre`,`descripcion`,`ubucacion`,`categoria`,`ordenCompra`,`costo`,`date`,`marca`,`modelo`,`serie`,`fecha_adquisicion`,`num_factura`,`num_poliza`,`numero_control`) VALUES ('$codigo','$nombre','$descripcion','$ubicacion','$categoria','$ordenCompra','$costo','$date','$marca','$modelo','$serie','$adquisicion','$num_factura','$num_poliza','$numero_control');";
			$query_new = mysqli_query($con,$sql);
			
			header('Location: ../../inventory.php');

            }
            // if has been added successfully
            if ($query_new) {
                $messages[] = "Inventario del codigo: ".$codigo." ha sido creado con éxito.";
            } else {
                $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.".mysqli_error($con);
            }
		} else 
		{
			$errors[] = "desconocido.";	
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