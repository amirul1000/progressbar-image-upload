<?php
       session_start();
	   //error_reporting(0);
       include("../common/lib.php");
	   include("../lib/class.db.php");
	   include("../common/config.php");
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
		  case 'add_form1': 		       
				$_SESSION['vat_file_tmp_name'] = base64_decode($_SESSION['vat_file_tmp_name']);
			    //$_SESSION['vat_file_name']     = $_FILES['vat_file']['name'];
			    $_SESSION['noc_file_tmp_name'] = base64_decode($_SESSION['noc_file_tmp_name']);
			    //$_SESSION['noc_file_name'] = $_FILES['noc_file']['name'];	
				$info['table']    = "registration";				
								
				
				if(strlen($_SESSION['vat_file_name'])>0)
				{
					
					if(!file_exists("../registration_images"))
					{ 
					   mkdir("../registration_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_SESSION['vat_file_name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_SESSION['vat_file_name'])));
					}
					$filePath="../registration_images/".$file;
					
					//move_uploaded_file($_SESSION['vat_file_name_tmp_name'],$filePath);
					
					$fp=fopen($filePath,"w");
					
					fwrite($fp,$_SESSION['vat_file_tmp_name']);
					
					$data['vat_file']="registration_images/".trim($file);
					
					unset($_SESSION['vat_file_tmp_name']);
					unset($_SESSION['vat_file_name']);
				}
				
				if(strlen($_SESSION['noc_file_name'])>0)
				{
					
					if(!file_exists("../registration_images"))
					{ 
					   mkdir("../registration_images",0755);	
					}
					if(empty($_REQUEST['id']))
					{
					  $file=getMaxId($db)."_".str_replace(" ","_",strtolower(trim($_SESSION['noc_file_name'])));
					}
					else
					{
					  $file=trim($_REQUEST['id'])."_".str_replace(" ","_",strtolower(trim($_SESSION['noc_file_name'])));
					}
					$filePath="../registration_images/".$file;
					//move_uploaded_file($_SESSION['noc_file_tmp_name'],$filePath);
					$fp=fopen($filePath,"w");
					
					fwrite($fp,$_SESSION['noc_file_tmp_name']);
					
					$data['noc_file']="registration_images/".trim($file);
					
					unset($_SESSION['noc_file_tmp_name']);
					unset($_SESSION['noc_file_name']);
				}
				
				
                $data['project']   = trim($_REQUEST['project']);
				$info['data']     =  $data;
				if(empty($_REQUEST['id']))
				{
					 $db->insert($info);
					 $Id = $db->lastInsert(true);					
				}
				else
				{
					$Id            = $_REQUEST['id'];
					$info['where'] = "id='".$Id."'";
					$db->update($info);
				}
			    include("success.php");		         

				break;		
									
	     default :    
		       include("registration_form1_editor.php");		         
	   }

//Protect same image name
 function getMaxId($db)
 {
	   $info['table']    = "registration";
	   $info['fields']   = array("max(id) as maxid");   	   
	   $info['where']    =  "1=1";
	  
	   $resmax  =  $db->select($info);
	   if(count($resmax)>0)
	   {
		 $max = $resmax[0]['maxid']+1;
	   }
	   else
	   {
		$max=0;
	   }	  
	   return $max;
 }

?>
