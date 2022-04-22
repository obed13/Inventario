<?php
// get the HTML
ob_start();
	
	session_start();
	if (!isset($_SESSION['user_id'])){
			header("location: index.php");//Redirecciona 
			exit;
	}
	/* Connect To Database*/
	include("config/db.php");
	include("config/conexion.php");
	require_once ("libraries/inventory.php");//Contiene funcion que controla stock en el inventario
	//Ontengo variables pasadas por GET
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
	$fecha_inicio   = mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_inicio'], ENT_QUOTES)));
	$fecha_fin      = mysqli_real_escape_string($con,(strip_tags($_REQUEST['fecha_fin'], ENT_QUOTES)));
	$tables="inventario";
	$campos="inventario.id, inventario.codigo, inventario.nombre, inventario.descripcion,inventario.ubucacion,inventario.categoria,inventario.ordenCompra,inventario.costo,inventario.date";
	$sWhere=" DATE_FORMAT(inventario.date , '%d-%m-%Y')  BETWEEN DATE_FORMAT('$fecha_inicio' , '%d-%m-%Y') AND DATE_FORMAT('$fecha_fin' , '%d-%m-%Y') ";
	$sWhere.=" order by inventario.codigo DESC";
	
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere ");
	//var_dump($query);
	/*Datos de la empresa*/
	$sql_empresa=mysqli_query($con,"SELECT business_profile.name, business_profile.tax, business_profile.address,  currencies.symbol, business_profile.city, business_profile.state, business_profile.postal_code, business_profile.phone, business_profile.email, business_profile.logo_url FROM  business_profile, currencies where business_profile.currency_id=currencies.id and business_profile.id=1");
	$rw_empresa=mysqli_fetch_array($sql_empresa);
	$moneda=$rw_empresa["symbol"];
	$tax=$rw_empresa["tax"];
	$bussines_name=$rw_empresa["name"];
	$address=$rw_empresa["address"];
	$city=$rw_empresa["city"];
	$state=$rw_empresa["state"];
	$postal_code=$rw_empresa["postal_code"];
	$phone=$rw_empresa["phone"];
	$email=$rw_empresa["email"];
	$logo_url=$rw_empresa["logo_url"];
	
/*Fin datos empresa*/

	require_once(dirname(__FILE__).'/pdf/html2pdf.class.php');
		

	require_once (dirname(__FILE__).'/pdf/documentos/html/inventory-report-anual.php');
	$content = ob_get_clean();
    

    try
    {
		
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8');
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content);
        // send the PDF
        $html2pdf->Output('usuarios.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
}
