<?php


$dbname = "epiz_31951169_db";

$dbuser = "epiz_31951169";
$dbpass = "TCbNPP3mNzA";
$dbhost = "sql309.epizy.com";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn){

	        die("Falha na conexao: " . mysqli_connect_error());

	    }
?>