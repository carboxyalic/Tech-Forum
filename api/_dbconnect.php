<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "php-forum";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    echo "Database ka connection check kro";
}
