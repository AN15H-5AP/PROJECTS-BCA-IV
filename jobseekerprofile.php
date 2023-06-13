<?php
session_start();
$jobseekeremail = $_SESSION['Email'];
if (!isset($jobseekeremail)) {
    header("location:index.php");
}
include('./database/connection.php');
$sql = "SELECT * FROM job_seeker WHERE Email = '$jobseekeremail'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/jobseekerprofile.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/brands.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/fontawesome.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/solid.css">
</head>

<body>
    <div class="navbar">
        <?php include('jobseeker-afterloginnav.php') ?>
    </div>
    <div class="dashboard">
        <div class="dashboard-page">
            <div class="dashboard-nav">
                <div class="dashboard-vertical-nav">

                    <a href="index.php"><button class="tablinks">Home</button></a>
                    <button class="tablinks" onclick="showcontent(event,'dashboard')" id="defaultopen">Dashboard</button>
                    <button class="tablinks" onclick="showcontent(event,'profile')">Profile</button>
                    <button class="tablinks" onclick="showcontent(event,'savedjobs')">Bookmarked job</button>
                    <button class="tablinks" onclick="showcontent(event,'application')">Application History</button>
                    <button class="tablinks" onclick="showcontent(event,'resume')">View Resume</button>
                    <button class="tablinks" onclick="showcontent(event,'changepassword')">Change Password</button>
                </div>
            </div>

            <!-- ----------------------------profile information------------------->
            <div class="dashboard-content">
                <!-- ----------------------------dashboard information------------------->
                <div id="dashboard" class="container">
                    <h2>Dashboard</h2>
                    <div class="counter_area">
                        <div class="counter">
                            <h3>Total Applied Jobs</h3>
                            <span class="count" id="">
                                <!-- php to count the total number of company  -->
                                <?php
                                // echo "$total_companies";
                                ?>22
                            </span>
                        </div>
                        <div class="counter">
                            <h3>Total Saved jobs</h3>
                            <span class="count" id="">
                                <!-- php to count the total number of job seeker  -->
                                <?php
                                // echo "$total_job_seeker";
                                ?>5
                            </span>
                        </div>
                        <div class="counter">
                            <h3>Total shortlisted</h3>
                            <span class="count" id="">
                                <!-- php to count the total number of vacancies  -->
                                <?php
                                // echo "$total_vacancies";
                                ?>12
                            </span>
                        </div>
                        <div class="counter">
                            <h3>Total Rejected Jobs</h3>
                            <span class="count" id="">
                                <!-- php to count the total number of applied jobs  -->
                                <?php
                                // echo "$total_applied_jobs";
                                ?>10
                            </span>
                        </div>
                    </div>
                </div>




                <div id="profile" class="container">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="profile">
                            <div class="profile-details">
                                <div class="profile-header">
                                    <div class="profile-sub">

                                        <div class="imagesection">
                                            <!-- job seeker image image -->
                                            <img src="./images/avatar.png">
                                            <!-- <input type="file" name="imagefile"> -->
                                        </div>
                                        <div class="details">
                                            <!-- job seeker name -->
                                            <h3>
                                                <span style="color:blue;">Welcome!!</span>
                                                <?php echo $row['Full_name'] ?>
                                            </h3>
                                            <!-- job seeker address -->
                                            <p>
                                                <?php echo $row['Address'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="editoption">
                                        <!-- <a href=""><button>Edit</button></a> -->
                                        <a class="editprofile" onclick="" href="jobseeker-profileedit.php">Edit</a>
                                    </div>
                                </div>
                                <div class="profile-information">
                                    <div class="profile-subinfo">

                                        <p><img src="./images/phone.svg" height="18px" width="18px">&nbsp;&nbsp;
                                            <?php echo $row['Phone'] ?>
                                        </p>
                                        <p><img src="./images/Email.svg" height="18px" width="18px">&nbsp;&nbsp;
                                            <?php echo $row['Email'] ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>




                <!-----------------saved job------------------->
                <div class="container" id="savedjobs">
                    <div class="savedjobs">
                        <!-- code to retrieve data  -->
                        <?php
                        // include './database/connection.php';

                        // $jobseeker_id = $row[$jobseeker_id]; // Replace with the actual jobseeker ID

                        // $sql = "SELECT id, job_title, company_name, applied_date FROM job_seeker WHERE id = $jobseeker_id";

                        // $result = $conn->query($sql);
                        ?>

                        <h2>Bookmarked Jobs </h2>

                        <table border="1">
                            <tr>
                                <th>ID</th>
                                <th>Job Title</th>
                                <th>Company Name</th>
                                <th>Applied Date</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["Job_seeker_id"] . "</td>";
                                    echo "<td>" . $row["job_title"] . "</td>";
                                    echo "<td>" . $row["companyName"] . "</td>";
                                    echo "<td>" . $row["applied_date"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No bookmarked jobs found</td></tr>";
                            }
                            ?>
                        </table>

                    </div>
                </div>


                <!----------application history------------->
                <div id="application" class="container">
                    <div class="application">
                        <h1>application</h1>

                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Job Title</th>
                                <th>Company Name</th>
                                <th>Applied Date</th>
                                <th>Status</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            <?php $counter = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $counter; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['job_title']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['companyName']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['applied_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Status']; ?>
                                    </td>


                                </tr>
                            <?php
                                $counter++;
                            }
                            ?>

                        </table>
                    </div>
                </div>


                <!------------resume section-------------------->

                <div id="resume" class="container">
                    <h2>Resume Upload</h2>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" enctype="multipart/form-data">
                        <input type="file" name="resumeFile" id="resumeFile">
                        <input type="submit" value="Upload" name="submit">
                    </form>
                    <button id="viewResumeBtn" onclick="viewResume()">View Resume</button>
                    <div id="resumeContent"></div>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["submit"])) {
                        $targetDir = "./uploads/";
                        $targetFile = $targetDir . basename($_FILES["resumeFile"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                        // Check if file is a resume (e.g., PDF, DOCX, etc.)
                        // if ($imageFileType !== "pdf" && $imageFileType !== "doc" && $imageFileType !== "docx") {
                        //     echo "Only PDF, DOC, and DOCX files are allowed.";
                        //     $uploadOk = 0;
                        // }

                        // Check if file already exists
                        if (file_exists($targetFile)) {
                            echo "Sorry, the file already exists.";
                            $uploadOk = 0;
                        }

                        // Check file size (limit it to 5MB)
                        if ($_FILES["resumeFile"]["size"] > 5 * 1024 * 1024) {
                            echo "Sorry, the file is too large.";
                            $uploadOk = 0;
                        }

                        // Move the uploaded file to the target directory
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["resumeFile"]["tmp_name"], $targetFile)) {
                                echo "The file has been uploaded.";
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        }
                    }
                    ?>

                    <?php
                    $resumeFile = "./uploads/resume.pdf";
                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["viewResume"])) {
                        if (file_exists($resumeFile)) {
                            header('location:jobseekerprofile.php');
                            readfile($resumeFile);
                            exit();
                        } else {
                            echo "Resume not found.";
                        }
                    }
                    ?>
                </div>

                <!---------------------change password-------------->
                <?php
                $email = $Newpassword = $confirmpassword = '';
                $currentpassErr = $confirmpassErr = $newpasswordErr = '';
                if (isset($_POST['changepass'])) {
                    //code to verify the current password
                    $sql = "SELECT Password from job_seeker where Email = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $jobseekeremail);
                    $stmt->execute();
                    // $result = $stmt->get_result();
                    $isPasswordCorrect = FALSE;
                    $stmt->bind_result($jobseeker_password);
                    if ($stmt->fetch() == TRUE) {
                        $isPasswordCorrect = password_verify($password, $jobseeker_password);
                    } else {
                        $currentpass = "Current password doesn't matched";
                    }
                    $stmt->close();

                    //validate new password
                    if (empty($_POST['newpassword'])) {
                        $currentpassErr = "password is required";
                    } else {
                        $Newpassword = test_input($_POST['newpassword']);
                        //check if the password is strong or not
                        if (strlen($Newpassword) < 8) {
                            $newpasswordErr = "Password must be at least 8 characters long";
                        } elseif (!preg_match("#[0-9]+#", $Newpassword)) {
                            $newpasswordErr = "Password must contain at least one number";
                        } elseif (!preg_match("#[A-Z]+#", $Newpassword)) {
                            $newpasswordErr = "Password must contain at least one uppercase letter";
                        } elseif (!preg_match("#[a-z]+#", $Newpassword)) {
                            $newpasswordErr = "Password must contain at least one lowercase letter";
                        }
                    }

                    //compare the new password and confirm password
                    if (empty($_POST["conformpassword"])) {
                        $confirmpassErr = "Please confirm your password";
                    } else {
                        $confirmpassword = test_input($_POST["conformpassword"]);
                        // check if passwords match
                        if ($confirmpassword != $Newpassword) {
                            $confirmpassErr = "Passwords do not match";
                        }
                    }

                    //update the password into database

                    if (empty($currentpassErr) && empty($newpasswordErr) && empty($confirmpassErr)) {
                        include('./database/connection.php');

                        $update_pass = password_hash($Newpassword, PASSWORD_DEFAULT);

                        $stmt = $conn->prepare("UPDATE job_seeker SET Password = ?");
                        $stmt->bind_param("s", $update_pass);
                        $stmt->execute();
                        $stmt->close();
                        $sql = "UPDATE company SET password = $update_pass where Email = $jobseekeremail";
                        $result = $conn->query($sql);
                        if ($result) {

                            echo "password updated sucessfully";
                            header('location:jobseekerprofile.php');
                        }
                    }
                }

                ?>
                <div id="changepassword" class="container">
                    <div class="change-password">
                        <div class="password">
                            <h3>Change Your Password</h3>
                            <form action="#" method="post">
                                <div class="formdetails">

                                    <label for="current passwrod">Current passwrod</label>
                                    <input type="password" name="currentpassword" id="currentpassword">
                                    <span>
                                        <?php echo $currentpassErr ?>
                                    </span>

                                    <label for="newpassword">New Password</label>
                                    <input type="password" name="newpassword" id="newpassword">
                                    <span>
                                        <?php echo $newpasswordErr; ?>
                                    </span>


                                    <label for="conformpassword">Conform Password</label>
                                    <input type="password" name="conformpassword" id="conformpassword">
                                    <span>
                                        <?php echo $confirmpassErr; ?>
                                    </span>


                                    <input type="submit" name="changepass" value="Change Password">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="./js/companyprofile.js"></script>
    <script>
        document.getElementById('viewResume').addEventListener('click', function() {
            const resumeViewer = document.getElementById('resumeViewer');
            const resumeInput = document.getElementById('resume');
            const resumeName = resumeInput.files[0]?.name;

            if (resumeName) {
                const filePath = './uploads' + resumeName;
                resumeViewer.innerHTML = '<iframe src="${filePath}" width="100%" height="100%"></iframe>';
            } else {
                alert('Please upload a resume first.');
            }
        });
    </script>
</body>

</html>