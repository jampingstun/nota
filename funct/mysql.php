<?php
      	mysql_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pass']) or die("CONNECTION FAILED");
	mysql_select_db($dbconfig['db']) or die('DATABASE FAILED');
?>