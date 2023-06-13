<?php
    require_once ('./Database/connection.php');
if(isset($_GET['job_id'])){
    $del = $_GET['job_id'];

    
    $stmt = $conn->prepare("DELETE FROM job WHERE job_id = ?");
    $stmt->bind_param("i", $del); 
    $stmt->execute();
    $stmt->close();

    header("location: companyprofile.php");
    }

?>