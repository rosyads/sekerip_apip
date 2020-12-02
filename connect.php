<?php
$host = "localhost";   //Host
$username = "root";    //User
$password = ""; //Passsword
$database = "db_ganesa";     // Database Name
 
//creating a new connection object using mysqli 
$link = new mysqli($host, $username, $password, $database);
 
//if there is some error connecting to the database
//with die we will stop the further execution by displaying a message causing the error.
if ($link->connect_error) {
    die("Database connection failed: " . $link->connect_error);
}
?>