<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../../libraries/password_compatibility_library.php");
}
		if (empty($_POST['id_plantilla'])){
			$errors[] = "Selecciona una plantilla";
		}   elseif (
			!empty($_POST['id_plantilla'])
			
			) {
		
			require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
			// escaping, additionally removing everything that could be (html/javascript-) code
				$id_plantilla= intval($_POST["id_plantilla"]);
				
				mysqli_query($con,'update templates set status=0');
            
				// update data
                    $sql = "UPDATE templates SET status='1' WHERE id='$id_plantilla'";
                    $query = mysqli_query($con,$sql);

                    // if user has been update successfully
                    if ($query) {
                        $messages[] = "Los datos han sido actualizados exitosamente.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
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