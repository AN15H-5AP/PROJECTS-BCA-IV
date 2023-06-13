<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$database_name = 'JobPortal1';

$conn = new mysqli($servername,$username, $password,$database_name);
if($conn->connect_error){
    die(mysqli_connect_error());
}
$sql = "UPDATE job set status = case when deadline_date >= CURDATE() Then 'Active' else 'Expire' end ";


// $sql = "CREATE DATABASE JobPortal";

// if($conn->query($sql)==true){
//     echo "Database created";
// }
// else{
//     echo "Failed";
// }
?>