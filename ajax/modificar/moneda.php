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
		} else if (empty($_POST['nombre_edit'])){
			$errors[] = "Nombre de la moneda está vacío.";
		} else if (empty($_POST['simbolo_edit'])){
			$errors[] = "Simbolo de la moneda está vacío.";
		} else if (empty($_POST['millar_edit'])){
			$errors[] = "Selecciona separador de millar.";
		} else if (empty($_POST['decimal_edit'])){
			$errors[] = "Selecciona separador de decimal.";
		} else if (empty($_POST['codigo_edit'])){
			$errors[] = "Ingresa el código de la moneda.";
		} elseif (
			!empty($_POST['mod_id'])
			&& !empty($_POST['nombre_edit'])
			&& !empty($_POST['simbolo_edit'])
			&& !empty($_POST['millar_edit'])
			&& !empty($_POST['decimal_edit'])
			&& !empty($_POST['codigo_edit'])
			
			
			){
			require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
			// escaping, additionally removing everything that could be (html/javascript-) code
            $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre_edit"],ENT_QUOTES)));
			$simbolo = mysqli_real_escape_string($con,(strip_tags($_POST["simbolo_edit"],ENT_QUOTES)));
			$precision = intval($_POST['precision_edit']);
			$millar = mysqli_real_escape_string($con,(strip_tags($_POST["millar_edit"],ENT_QUOTES)));
			$decimal = mysqli_real_escape_string($con,(strip_tags($_POST["decimal_edit"],ENT_QUOTES)));
			$codigo = mysqli_real_escape_string($con,(strip_tags($_POST["codigo_edit"],ENT_QUOTES)));
			$id=intval($_POST['mod_id']);
			//Write register in to database 
			$sql = "UPDATE currencies SET name='$nombre', symbol='$simbolo', precision_currency='$precision', 	thousand_separator='$millar', decimal_separator='$decimal', code='$codigo' WHERE id='$id'";
			$query_new = mysqli_query($con,$sql);
            // if has been added successfully
            if ($query_new) {
                $messages[] = "Moneda ha sido actualizada con éxito.";
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