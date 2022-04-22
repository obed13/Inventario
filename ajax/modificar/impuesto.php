<?php

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../../libraries/password_compatibility_library.php");
}	
	if (empty($_POST['mod_id'])){
			$errors[] = "ID está vacío.";
		} else if (empty($_POST['name_edit'])){
			$errors[] = "Nombre del impuesto está vacío.";
		} else if (empty($_POST['value_edit'])){
			$errors[] = "Valor del impuesto está vacío.";
		} else if (empty($_POST['status_edit'])){
			$errors[] = "Selecciona le estado.";
		} elseif (
			!empty($_POST['mod_id'])
			&& !empty($_POST['name_edit'])
			&& !empty($_POST['value_edit'])
			&& !empty($_POST['status_edit'])
			
			
			
			){
			require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
			// escaping, additionally removing everything that could be (html/javascript-) code
            $name = mysqli_real_escape_string($con,(strip_tags($_POST["name_edit"],ENT_QUOTES)));
			$value = floatval($_POST['value_edit']);
			$status = intval($_POST['status_edit']);
			$id=intval($_POST['mod_id']);
			//Write register in to database 
			$sql = "UPDATE taxes SET name='$name', value='$value', status='$status' WHERE id='$id'";
			$query_new = mysqli_query($con,$sql);
            // if has been added successfully
            if ($query_new) {
                $messages[] = "Impuesto ha sido actualizado con éxito.";
            } else {
                $errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.".mysqli_error($con);
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