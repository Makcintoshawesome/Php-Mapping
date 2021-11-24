<?php
include_once 'class.crud.php';
$crud = new CRUD();

if(isset($_POST['editPageInfo']))
{

	
     $locationLatitude = $MySQLiconn->real_escape_string($_POST['locationLatitude']);
     $locationLongitude = $MySQLiconn->real_escape_string($_POST['locationLongitude']);
   
	 $SQL = $MySQLiconn->query("UPDATE map_tab SET locationLatitude='$locationLatitude',locationLongitude='$locationLongitude' WHERE ID=1");

	 if(!$SQL)
	 {
		 echo $MySQLiconn->error;
	 } 

	   echo '<script language="javascript">';
		echo 'alert("Click to show your desired location!")';
		echo '</script>';
		echo '<meta http-equiv="refresh" content="0;url=search.php" />';
}

?>