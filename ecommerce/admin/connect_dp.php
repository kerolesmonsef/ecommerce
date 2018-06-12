<?php 
$user='root';
$server='localhost';
$pass='';
$dp='shop';
$con=new mysqli($server,$user,$pass,$dp) or die('error while connect');
echo $con->connect_error;
echo $con->error;
