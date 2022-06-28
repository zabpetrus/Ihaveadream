<?php


$dbname = "epiz_32051686_db";

$dbuser = "epiz_32051686";
$dbpass = "oPYRvRwGGLJ8chC";
$dbhost = "sql208.epizy.com";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn){

	        die("Falha na conexao: " . mysqli_connect_error());

	    }
?>