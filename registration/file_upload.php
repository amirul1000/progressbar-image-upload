<?php
       session_start();
	   require(dirname(__FILE__) . '/../Simple-Ajax-Uploader-master/code/Uploader.php');
	   
	   include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   
		sleep(1);
		if(strlen($_FILES['vat_file']['name'])>0 && $_FILES['vat_file']['size']>0)
		{
			$_SESSION['vat_file_tmp_name'] = base64_encode(file_get_contents($_FILES['vat_file']['tmp_name']));
			$_SESSION['vat_file_name']     = $_FILES['vat_file']['name'];
			
		   echo json_encode(array('success' => true)); 	
		   exit;
		}
		if(strlen($_FILES['noc_file']['name'])>0 && $_FILES['noc_file']['size']>0)
		{
		   $_SESSION['noc_file_tmp_name'] = base64_encode(file_get_contents($_FILES['noc_file']['tmp_name']));	
		   $_SESSION['noc_file_name'] = $_FILES['noc_file']['name'];	
		   echo json_encode(array('success' => true)); 	
		   exit;	
		}
		
?>