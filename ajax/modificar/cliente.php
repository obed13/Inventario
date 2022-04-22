<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['client_id'])){
			$errors[] = "ID del cliente vacío";
		} else if (empty($_POST['bussines_name'])){
			$errors[] = "Nombres vacíos";
		}  elseif (empty($_POST['work_phone'])) {
            $errors[] = "Ingresa el número de teléfono de la empresa";
        }  elseif (empty($_POST['first_name'])) {
            $errors[] = "Ingresa los nombres del contacto";
        } elseif (empty($_POST['last_name'])) {
            $errors[] = "Ingresa los apellidos del contacto";
        } elseif (empty($_POST['phone'])) {
            $errors[] = "Ingresa el teléfono del contacto";
        }  elseif (
			!empty($_POST['bussines_name'])
			&& !empty($_POST['work_phone'])
			&& !empty($_POST['first_name'])
			&& !empty($_POST['last_name'])
			&& !empty($_POST['phone'])
			
        ) {
			require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
			// escaping, additionally removing everything that could be (html/javascript-) code
                $name = mysqli_real_escape_string($con,(strip_tags($_POST["bussines_name"],ENT_QUOTES)));
				$address1 = mysqli_real_escape_string($con,(strip_tags($_POST["address1"],ENT_QUOTES)));
                $city = mysqli_real_escape_string($con,(strip_tags($_POST["city"],ENT_QUOTES)));
				$state = mysqli_real_escape_string($con,(strip_tags($_POST["state"],ENT_QUOTES)));
				$postal_code = mysqli_real_escape_string($con,(strip_tags($_POST["postal_code"],ENT_QUOTES)));
				$country_id = mysqli_real_escape_string($con,(strip_tags($_POST["country_id"],ENT_QUOTES)));
				$work_phone	 = mysqli_real_escape_string($con,(strip_tags($_POST["work_phone"],ENT_QUOTES)));
				$website = mysqli_real_escape_string($con,(strip_tags($_POST["website"],ENT_QUOTES)));
				$tax_number	 = mysqli_real_escape_string($con,(strip_tags($_POST["tax_number"],ENT_QUOTES)));
				$first_name	 = mysqli_real_escape_string($con,(strip_tags($_POST["first_name"],ENT_QUOTES)));
				$last_name	 = mysqli_real_escape_string($con,(strip_tags($_POST["last_name"],ENT_QUOTES)));
				$email	 = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
				$phone	 = mysqli_real_escape_string($con,(strip_tags($_POST["phone"],ENT_QUOTES)));
				
				
				$created_at=date("Y-m-d H:i:s");
               
				$client_id=intval($_POST['client_id']);//ID del cliente
				
					// write new  data into database
                    $sql = "UPDATE customers, contacts SET customers.name='$name', customers.tax_number='$tax_number', customers.website='$website', customers.work_phone='$work_phone', contacts.first_name='$first_name', contacts.last_name='$last_name', contacts.email='$email', phone='$phone', address1='$address1', city='$city', state='$state', postal_code='$postal_code', country_id='$country_id'  WHERE customers.id=contacts.client_id and customers.id='".$client_id."'";
                    $query = mysqli_query($con,$sql);

                    // if  has been update successfully
                    if ($query) {
                        $messages[] = "El cliente ha sido actualizado con éxito.";
						
						
                    } else {
                        $errors[] = "Lo sentimos , el actualización falló. Por favor, regrese y vuelva a intentarlo.".mysqli_error($con);
                    }
                
			
		}else {
			$errors[] = "Error desconocido";	
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