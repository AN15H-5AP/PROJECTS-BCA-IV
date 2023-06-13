<!-- session start here  -->
<?php
session_start();
?>


<!-- php to fetch data in counter area -->
<?php
include('./Database/connection.php');
// <php to count the total number of company 
$sql = "SELECT COUNT(*) as company_id FROM company ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_companies = $row['company_id'];


// <!-- php to count the total number of job seeker  
$sql = "SELECT COUNT(*) as Job_seeker_id FROM job_seeker";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_job_seeker = $row['Job_seeker_id'];

//  php to count the total number of vacancies  
$sql = "SELECT sum(no_of_vacancy) as no_of_vacancy FROM job";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$total_vacancies = $row['no_of_vacancy'];

// <!-- php to count the total number of applied jobs  
// $sql = "SELECT COUNT(*) as total_applied_jobs FROM ";
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($result);
// $total_applied_jobs = $row['total_applied_jobs'];


//close the connection 
mysqli_close($conn);
?>

<!-- sql to update the password of the admin user in the Database -->
<?php
include('./Database/connection.php');
$newpassErr = $confirmpasserr = "";
if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if (strlen($password) < 8) {
        $newpassErr = "password must be of 8 character";
    } else {
        $sql = "UPDATE admin_login set Password='$password' where Admin_id =1";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script> 
            
            </script>";
        }
    }
}

// function loadDoc() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("submit-area").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "submit.php", true);
//     xhttp.send();
// }

// Close the connesubmit-area input[type=submit]ction
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./styles/admindashboard.css">


</head>

<body>
    <div class="navbar">
        <?php include('afterloginnav.php') ?>

    </div>
    <div class="dashboard">
        <div class="dashboard_flex">
            <div id="menu">
                <div class="items">
                    <ul>
                        <li><a onclick="openTab(event,'dashboard_tab')" class="tablinks" id="defaultOpen">Dashboard</a>
                        </li>
                        <li><a onclick="openTab(event,'company_tab')" class="tablinks">Manage Company</a></li>
                        <li><a onclick="openTab(event,'jobseeker_tab')" class="tablinks">Manage Job Seeker</a></li>
                        <li><a onclick="openTab(event,'setting_tab')" class="tablinks">Setting</a></li>
                        <li><a onclick="openTab(event,'manage-blogs')" class="tablinks">Manage Blogs</a></li>
                        <li><a onclick="openTab(event,'logout_tab')" class="tablinks">Logout</a></li>

                    </ul>
                </div>
            </div>
            <div class=" dashboard_content">
                <section id="container">
                    <!-- main container for all the tabs to open -->
                    <div class="main-container">

                        <!-- dashboard tab start here  -->
                        <div class="tabcontent" id="dashboard_tab">
                            <h3 class="content_heading">
                                Admin Dashboard
                            </h3>
                            <!-- Dashboard content goes here -->
                            <div class="counter_area">
                                <div class="counter">
                                    <h3>Total Companies</h3>
                                    <span class="count" id="">
                                        <!-- php to count the total number of company  -->
                                        <?php
                                        echo "$total_companies";
                                        ?>
                                    </span>
                                </div>
                                <div class="counter">
                                    <h3>Total Job Seekers</h3>
                                    <!-- sql to update the password of the admin user in the Database -->
                                    <span class="count" id="">
                                        <!-- php to count the total number of job seeker  -->
                                        <?php
                                        echo "$total_job_seeker";
                                        ?>
                                    </span>
                                </div>
                                <div class="counter">
                                    <h3>Total Vacancies</h3>
                                    <span class="count" id="">
                                        <!-- php to count the total number of vacancies  -->
                                        <?php
                                        echo "$total_vacancies";
                                        ?>
                                    </span>
                                </div>
                                <div class="counter">
                                    <h3>Total Applied Jobs</h3>
                                    <span class="count" id="">
                                        <!-- php to count the total number of applied jobs  -->
                                        <?php
                                        // echo "$total_applied_jobs";
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- tab for the manage company start here -->
                        <div class="tabcontent" id="company_tab">
                            <h3 class="content_heading">
                                Manage Company
                            </h3>
                            <!-- Manage Company content goes here -->

                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th> Email</th>
                                    <th> Phone</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                                <!-- php to retrive company data from the Database in the tabe  -->
                                <?php
                                include('./Database/connection.php');

                                $sql = "SELECT * FROM company";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['company_id'] . "</td>";
                                        echo "<td>" . $row['company_name'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        // echo "<td>" . $row['Action'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </table>
                        </div>

                        <!-- manage job seeker tab start here  -->
                        <div class="tabcontent" id="jobseeker_tab">
                            <!-- Manage Job Seeker content goes here -->
                            <h3 class="content_heading">
                                Manage Job Seeker
                            </h3>
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Job-Seeker Name</th>
                                    <th>Address</th>
                                    <th> Email</th>
                                    <th> Phone</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                                <!-- php to fetch the jobseeker content from the databse in the table -->
                                <?php
                                include('./Database/connection.php');

                                $sql = "SELECT * FROM job_seeker";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['Job_seeker_id'] . "</td>";
                                        echo "<td>" . $row['Full_name'] . "</td>";
                                        echo "<td>" . $row['Address'] . "</td>";
                                        echo "<td>" . $row['Email'] . "</td>";
                                        echo "<td>" . $row['Phone'] . "</td>";
                                        // echo "<td>" . $row['Action'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </table>
                        </div>

                        <!-- manage blogs post -->
                        <div class="tabcontent" id="company_tab">
                            <h3 class="content_heading">
                                Manage Company
                            </h3>
                            <!-- Manage Company content goes here -->

                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Address</th>
                                    <th> Email</th>
                                    <th> Phone</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                                <!-- php to retrive company data from the Database in the tabe  -->
                                <?php
                                include('./Database/connection.php');

                                $sql = "SELECT * FROM company";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['company_id'] . "</td>";
                                        echo "<td>" . $row['company_name'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        // echo "<td>" . $row['Action'] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                mysqli_close($conn);
                                ?>
                            </table>
                        </div>

                        <!-- manage job seeker tab start here  -->
                        <div class="tabcontent" id="manage-blogs">
                            <!-- Manage Job Seeker content goes here -->
                            <?php
                            include('bloguploads.php')
                            ?>

                        </div>

                        <!-- seting tab for the admin dashboard -->
                        <div class="tabcontent" id="setting_tab">
                            <!-- Setting content goes here -->
                            <h3 class="content_heading">
                                Setting
                            </h3>
                            <div class="form-control">
                                <div class="setting-title">
                                    <h3>Change your Password Here</h3>
                                </div>
                                <div class="setting_area">

                                    <!-- form for password change of admin user -->
                                    <form method="POST" class="form">
                                        <div class="setting_form_input">
                                            <label for="password1">New Password</label>
                                            <input type="password" name="password" id="password" placeholder="new password">
                                            <span class="error">
                                                <!-- dispaly the error message  -->
                                                <?php echo $newpassErr; ?>

                                            </span>

                                            <label for="password2">Confirm Password</label>
                                            <input type="password" name="confirmpassword" id="confirmpassword" placeholder=" Re-Enter New password">
                                            <span class="error">
                                                <!-- display the error message -->
                                                <?php echo $confirmpasserr; ?>
                                            </span>
                                        </div>

                                        <div class="submit-area">
                                            <input type="submit" name="submit" value="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <script src="./js/dashboard.js"></script>
            </div>
        </div>
    </div>
</body>

</html>