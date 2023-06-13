<?php 

include ('connection.php');



$sql = "CREATE TABLE job(
    job_id INT unsigned auto_increment primary key,
    category VARCHAR(200) not null,
    job_title VARCHAR(100) not null,
    posted_date DATE ,
    deadline_date DATE,
    estimated_salary VARCHAR(100),
    no_of_vacancy INT not null,
    job_address VARCHAR(200) not null,
    job_type varchar(50) not null,
    job_description VARCHAR(255) not null,
    companyID int(10) unsigned, 
    FOREIGN KEY(companyID) REFERENCES company(company_id),
    companyName varchar(200) not null
)";
    $sql = "UPDATE job set status = case when deadline_date >= CURDATE() Then 'Active' else 'Expire' end ";
$sql = "CREATE TABLE Job_seeker(
    Job_seeker_id int(20) unsigned auto_increment primary key,
    Full_name varchar(100) not null,
    Email varchar(200) unique,
    Password varchar(200) not null,
    Address varchar(200) NOT NULL,
    Phone varchar(100),
    Resume_file varchar(100) not null
)";
// $sql = "CREATE TABLE Job_seeker(
//     Job_seeker_id int(20) unsigned auto_increment primary key,
//     Full_name varchar(100) not null,
//     Email varchar(200) unique,
//     Password varchar(200) not null,
//     Address varchar(200) NOT NULL,
//     Phone int(20),
//     Resume_file varchar(100) not null
// )";
// $sql = "CREATE TABLE  job_category(
//     category_id int(20) auto_increment primary key,
//     category_name varchar(100) not null
// )";
if(mysqli_query($conn, $sql)){
    echo "table created successfully";
}
else{
    echo "error creating database";
}
?>