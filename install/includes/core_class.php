<?php

class Core {

	// Function to validate the post data
	function validate_post($data)
	{
		/* Validating the hostname, the database name and the username. The password is optional. */
		return !empty($data['db_host']) && !empty($data['db_user']) && !empty($data['db_name']) && !empty($data['username']) && !empty($data['useremail']) && !empty($data['password']);
	}

	// Function to show an error
	function show_message($type,$message) {
		return $message;
	}

	// Function to write the config file
	function write_config($data) {

		//Creacion de archivo config.php que contiene los datos de conexion a la base de datos	
			$output  = '<?php' . "\n";
			$output .= '/*Datos de conexion a la base de datos*/' . "\n";
			$output .= 'define(\'DB_HOST\', \'' . $data['db_host']. '\');' . "\n";
			$output .= 'define(\'DB_USER\', \'' . $data['db_user']. '\');' . "\n";
			$output .= 'define(\'DB_PASS\', \'' . $data['db_password']. '\');' . "\n";
			$output .= 'define(\'DB_NAME\', \'' . $data['db_name']. '\');' . "\n \n";
			$output .= '/*Datos del usuario administrador del sistema*/' . "\n";
			$output .= 'define(\'USERNAME\', \'' . $data['username']. '\');' . "\n";
			$output .= 'define(\'PASSWORD\', \'' . $data['password']. '\');' . "\n";			
			$output .= '?>';
			
		// Config path
		$output_path 	= '../config/db.php';

		// Write the new database.php file
		$handle = fopen($output_path,'w');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {

			// Write the file
			if(fwrite($handle,$output)) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}

	}

    
}