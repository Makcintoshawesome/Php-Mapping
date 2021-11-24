<?php

     $MySQLiconn = new MySQLi("localhost","root","","php_mapping");
	 
	 if($MySQLiconn->connect_errno)
	 {
		 die("ERROR : -> ".$MySQLiconn->connect_error);
	 }
	 
