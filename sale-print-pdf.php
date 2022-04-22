<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	// get the HTML
     ob_start();
	 if (!isset($_SESSION['user_id'])){
			header("location: index.php");//Redirecciona 
			exit;
	}
		
	/* Connect To Database*/
	include("config/db.php");
	include("config/conexion.php");
	include("libraries/inventory.php");
	
	//Ontengo variables pasadas por GET
	$_SESSION['sale_id']=intval($_GET['id']);
	$sale_id=$_SESSION['sale_id'];
	$sql_sale=mysqli_query($con,"select * from sales where sale_id='".$_SESSION['sale_id']."'");
	$count=mysqli_num_rows($sql_sale);
	$rw_sale=mysqli_fetch_array($sql_sale);
	$sale_number=$rw_sale['sale_number'];
	$customer_id=$rw_sale['customer_id'];
	$total_sales=$rw_sale['total'];
	$sql_customer=mysqli_query($con,"select * from customers where id='".$customer_id."'");
	$rw_customer=mysqli_fetch_array($sql_customer);
	$customer_name=$rw_customer['name'];
	$customer_address=$rw_customer['address1'];
	$customer_city=$rw_customer['city'];
	$customer_state=$rw_customer['state'];
	$customer_postal_code=$rw_customer['postal_code'];
	$customer_work_phone=$rw_customer['work_phone'];
	$customer_id=$rw_customer['id'];
	
	if (!isset($_GET['id']) or $count!=1){
		echo "<script>window.close();</script>";
		exit;
	}
	
	$sale_date= date('d/m/Y', strtotime($rw_sale['sale_date']));
	
	$sql_contact=mysqli_query($con,"select email from  contacts where client_id='".$customer_id."'");
	$rw_contact=mysqli_fetch_array($sql_contact);
	$customer_email=$rw_contact['email'];
	
	/*Datos de la empresa*/
		$sql_empresa=mysqli_query($con,"SELECT business_profile.name, business_profile.tax, business_profile.address,  currencies.symbol, business_profile.city, business_profile.state, business_profile.postal_code, business_profile.phone, business_profile.email, business_profile.logo_url FROM  business_profile, currencies where business_profile.currency_id=currencies.id and business_profile.id=1");
		$rw_empresa=mysqli_fetch_array($sql_empresa);
		$moneda=$rw_empresa["symbol"];
		$bussines_name=$rw_empresa["name"];
		$address=$rw_empresa["address"];
		$city=$rw_empresa["city"];
		$state=$rw_empresa["state"];
		$postal_code=$rw_empresa["postal_code"];
		$phone=$rw_empresa["phone"];
		$email=$rw_empresa["email"];
		$logo_url=$rw_empresa["logo_url"];
		
	/*Fin datos empresa*/
		$tax=get_id("sales","tax_value","sale_id",$sale_id);
		$tax_txt=get_id("taxes","name","value",$tax);
	/*Template*/
		$sql_template=mysqli_query($con,"select * from templates where status=1");
		$rw_template=mysqli_fetch_array($sql_template);
		$file_template=$rw_template['file'];
	/*Template*/

	require_once(dirname(__FILE__).'/pdf/html2pdf.class.php');
		

    
     include(dirname('__FILE__').'/pdf/documentos/html/'.$file_template);
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
