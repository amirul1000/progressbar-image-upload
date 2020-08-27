<?php
function ini_set_settings()
{  
  ini_set('display_errors', '1');
  ini_set('error_reporting', E_ALL  & ~E_NOTICE & ~E_DEPRECATED);
}

 /*
  Get Enum Value
 */
 function getEnumFieldValues($tableName = null, $field = null)
   {
       // Make a DDL query
       $query = "SHOW COLUMNS FROM $tableName LIKE " . q($field);
      
       $result = mysql_query($query);
	   
       $data   = mysql_fetch_array($result);

       if(eregi("('.*')", $data['Type'], $match))
       {
          $enumStr       = ereg_replace("'", '', $match[1]);
          $enumValueList = explode(',', $enumStr);
       }

       return $enumValueList;
   }
   
/*
  Get Field Type
*/
 function getFieldType($tableName = null, $field = null)
   {
       // Make a DDL query
       $query = "SHOW COLUMNS FROM $tableName LIKE " . q($field);
      
       $result = mysql_query($query);
	   
       $data   = mysql_fetch_array($result);
       $splitTypeData = explode("(",$data['Type']);
	   $typeName = $splitTypeData[0];
       return $typeName;
   }
/* 
 Get table fields list 
 */ 
function  getTableFieldsName($table)
{
    $sql          =  "select * from  ".$table."";
    $res          =  mysql_query($sql);
    $fields       =  mysql_num_fields($res);
    // Setup an array to store return info
      $hash = array();

      for ($i=0; $i < $fields; $i++)
      {
         $name          =  mysql_field_name($res, $i);
         $hash[$name]   = $name ;
      }
    return $hash;
}
/*
  Table List
*/
function getTableList($dbname)
{
    $sql = "SHOW TABLES FROM $dbname";
	$result = mysql_query($sql);
	
	if (!$result) {
		echo "DB Error, could not list tables\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	while ($row = mysql_fetch_row($result)) {
		 $arrTable[] = $row[0];
	}
	mysql_free_result($result);
	return $arrTable;
}
/*
 Set Foreign Key Field value
*/
function setForeignKeyIdValue($db,$table,$field,$value)
{
   if($field==null)
   {
      $hash = getTableFieldsName($table);
	  foreach($hash as $key=>$value2)
		{
			if(!(eregi("_id", $key, $match)||$key=="id"))
			{ 
			  $field=$key;
			  break;
			}
		}
   }
    
	$info['table']    = $table;
	$info['fields']   = array($field);   	   
	$info['where']    =  "1 AND id='".$value."' LIMIT 0,1";
	$res  =  $db->select($info);
	return $res[0][$field];
}
function q($str = null)
	   {
		  return "'" . mysql_escape_string($str) . "'";
	   }

 function   debug($var)
	 {
       echo "<pre>";
	      print_r($var);
	   echo "</pre>";
     }
	 
	 

function cleanPOSTData()
{
	foreach($_REQUEST as $key=>$value)
	{
		if($key=="csrf")
		{
			continue;
		}
		
		checkSpecial($value);
	}
}

function checkSpecial($string)
{
	//if (preg_match('/[\'^£$%&*()}{#~<>,|=+¬]/', $string))
    if (preg_match('/\'/', $string))
	{
		 echo "one or more of the 'special characters' found in $string";
		exit;
	}
}	 

//check file extension
function check_file_extension2($_files)
{
  foreach($_files as $key=>$name)
  {
     if(strlen($_files[$key]['name'])>0 && $_files[$key]['size']>0)
	 {
			 unset($arr);			
			 $arr = explode(".",$_files[$key]['name']);			
			 $extension = strtolower($arr[count($arr)-1]);			
			 if(!( $extension == "pdf" || $extension == "png"  || $extension == "jpg" || $extension == "jpeg"))
			 {
				 $_SESSION['extension'] = $extension;
			    // echo '<font color="red"><h3>Error:'.$extension .' is not supported file</h3></font>';
				 return false;
			 }
	 }
	// echo $arr[count($arr)-1];
  } 
  return true;
}
if(check_file_extension2($_FILES)==false)
{
	$message = '<font color="red"><h3>Error:'.$_SESSION['extension'] .' is not supported file</h3></font>';
	exit;
}
?>