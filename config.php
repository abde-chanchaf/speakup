<?php

$host="localhost";
$name="root";
$password="";
$db_name="speakup";


session_start();

   $con=Mysqli_connect($host,$name,$password,$db_name);

   if (!$con) {
    echo"error";
   }








?>