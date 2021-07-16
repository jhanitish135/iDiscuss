<?php
//script to connect to the database
$server="localhost";
$username="root";
$password="";
$database="idiscuss";

$conn=mysqli_connect($server,$username,$password,$database);

if(!$conn){
    
    die("Erroe!".mysqli_connect_error());
}


?>