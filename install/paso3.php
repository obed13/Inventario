<?php 
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}	
set_time_limit (900);//Tiempo maximo de ejecucion
if($_POST) 
{	
	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');
	
	$core = new Core();	
	$database = new Database();
	
	// Validate the post data
	if($core->validate_post($_POST) == true){
	
	
/*Recoleccion de variables para la conexion de la base de datos*/
$db_host=$_POST['db_host'];
$db_user=$_POST['db_user'];
$db_password=$_POST['db_password'];
$db_name=$_POST['db_name'];
/*Fin de recoleccion de variables para la conexion de la base de datos*/

/*Recoleccion de datos de inicio de sesion al sistema*/
$username=$_POST['username'];
$useremail=$_POST['useremail'];
$password=$_POST['password'];
$user_password_hash = password_hash($password, PASSWORD_DEFAULT);
/*Fin de recoleccion de datos de inicio de sesion al sistema*/
if(!@$con=mysqli_connect($db_host,$db_user,$db_password, $db_name))
{
$error_warning='Error: No se pudo conectar a la base de datos por favor aseg&uacute;rese de que el servidor de base de datos, nombre de usuario y la contrase&ntilde;a es correcta!';
}
else
{
			
			/*------Volcado de los datos --------*/
			if ($database->create_tables($_POST) == false) {
			$error_warning = "Las tablas de la bases de datos no se pudieron crear, por favor, compruebe la configuración.";
			}
			sleep(30);
			if ($database->create_user($_POST) == false) {
			$error_warning = "No se pudo crear el usuario, por favor intente nuevamente.";
			}
			if ($core->write_config($_POST) == false) {
			$error_warning = $core->show_message('error',"El archivo de configuración de base de datos no se puede escribir.");
			}
			// If no errors, redirect to login page
			if(!isset($message)) {
				$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
				$redir .= "://".$_SERVER['HTTP_HOST'];
				$redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
				$redir = str_replace('install/','',$redir); 
				header( 'Location:'.$redir.'login.php', 'refresh') ;
			}
				
			
					
}		

} else {
		$error_warning = $core->show_message('error','No todos los campos han sido rellenados correctamente. Se requiere el host, usuario de la base de datos, nombre de la base de datos, nombre de usuario del sistema, email de usuario y contraseña de acceso al sistema.');
	}

}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Instalaci&oacute;n del Sistema</title>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<script language="JavaScript" type="text/javascript" src="../js/install.js"></script>
</head>
<body>
<div id="container">
  <div id="content">
    <div id="content_top"></div>
    <div id="content_middle">
	
	<h1 style="background: url('view/image/configuration.png') no-repeat;">Paso 3 - Configuraci&oacute;n</h1>
<div style="width: 100%; display: inline-block;">
  <div style="float: left; width: 569px;">
    <?php if (isset($error_warning)) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <form  method="post"  id="form" name='form' onsubmit="return validar();">
      <p>1 . Por favor, introduzca sus datos de conexi&oacute;n a la base de datos.</p>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 15px;">
        <table>
          <tr>
            <td width="185"><span class="required">*</span>Servidor:</td>
            <td><input type="text" name="db_host" id="db_host" value="localhost" required/>
              <br /><td>
          </tr>
          <tr>
            <td><span class="required">*</span>Usuario:</td>
            <td><input type="text" name="db_user" id="db_user"  required/>
              <br /><td>
          </tr>
          <tr>
            <td>Contrase&ntilde;a:</td>
            <td><input type="text" name="db_password" id="db_password" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span>Nombre de la Base de Datos:</td>
            <td><input type="text" name="db_name" id="db_name" required/>
              <br />
            </td>
          </tr>
        </table>
      </div>
      <p>2. Por favor, introduzca un nombre de usuario y una contrase&ntilde;a para la administraci&oacute;n.</p>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 15px;">
        <table>
          <tr>
            <td width="185"><span class="required">*</span>Nombre de Usuario:</td>
            <td><input type="text" name="username" id="username" value="admin" required/>
			</td>
          </tr>
		  <tr>
            <td width="185"><span class="required">*</span>Email:</td>
            <td><input type="email" name="useremail" id="useremail" value="" required/>
			</td>
          </tr>
          <tr>
            <td><span class="required">*</span>Contrase&ntilde;a:</td>
            <td><input type="text" name="password" id="password" required/>
			</td>
          </tr>

        </table>
      </div>
    <div style="text-align: right;"><input type="submit" value="Continuar" style="padding:4px; cursor:pointer;"/><span class="button_right"></span></a></div>
    </form>
  </div>
  <div style="float: right; width: 205px; height: 400px; padding: 10px; color: #663300; border: 1px solid #FFE0CC; background: #FFF5CC;">
    <ul>
      <li>Licencia</li>
      <li>Pre-Instalaci&oacute;n</li>
      <li><b>Configuraci&oacute;n</b></li>
      <li>Finalizado</li>
    </ul>
  </div>
</div>
   </div>
    <div id="content_bottom"></div>
  </div>
  </div>
</body>
</html>

	