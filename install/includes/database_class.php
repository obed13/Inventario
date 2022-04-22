<?php

class Database {
	// Function to create the tables and fill them with the default data
	function create_tables($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['db_host'],$data['db_user'],$data['db_password'],$data['db_name']);

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Open the default SQL file
		$query = file_get_contents('inventory.sql');

		// Execute a multi query
		$mysqli->multi_query($query);

		// Close the connection
		$mysqli->close();

		return true;
	}
	function create_user($data){
		/*Recoleccion de datos de inicio de sesion al sistema*/
		$username=$data['username'];
		$useremail=$data['useremail'];
		$password=$data['password'];
		$user_password_hash = password_hash($password, PASSWORD_DEFAULT);
		$date_added=date("Y-m-d H:i:s");
		// Connect to the database
		$mysqli = new mysqli($data['db_host'],$data['db_user'],$data['db_password'],$data['db_name']);

		// Check for errors
		if(mysqli_connect_errno())
			return false;
		//Truncate table users
		$mysqli->query("truncate table users");
		if ($mysqli->query("insert into users (user_id, user_name, user_password_hash, user_email, date_added, user_group_id, status) values (1,'$username','$user_password_hash','$useremail','$date_added', '1','1')")){
			return true;
		} else {
			return false;
		}
	}
}