<?php
session_start();
$companyemail = $_SESSION['email'];
if (!isset($companyemail)) {
  header("location:index.php");
}
include('./database/connection.php');
$sql = "SELECT * FROM company WHERE email = '$companyemail'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./styles/companyprofilee.css">
</head>

<body>
  <div class="navbar">
    <?php include('afterloginnav.php') ?>
  </div>
  <div class="dashboard">
    <div class="dashboard-page">
      <div class="dashboard-nav">
        <div class="dashboard-vertical-nav">

          <a href="index.php"><button class="tablinks">Home</button></a>
          <button class="tablinks" onclick="showcontent(event,'profile')" id="defaultopen">Profile</button>
          <button class="tablinks" onclick="showcontent(event,'postjob')">Post job</button>
          <button class="tablinks" onclick="showcontent(event,'managejob')">Manage job</button>
          <button class="tablinks" onclick="showcontent(event,'application')">Application</button>
          <button class="tablinks" onclick="showcontent(event,'changepassword')">Change Password</button>
        </div>
      </div>

      <!-- ----------------------------profile information------------------->
      <div class="dashboard-content">
        <div id="profile" class="container">
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
            ?>
          <div class="profile">
            <div class="profile-details">
              <div class="profile-header">
                <div class="profile-sub">

                  <div class="imagesection">
                    <!-- company image -->
                      <img src="./images/avatar.png">
                      <!-- <input type="file" name="imagefile"> -->
                    </div>
                    <div class="details">
                      <!-- company name -->
                      <h3>
                        <?php echo $row['company_name'] ?>
                      </h3>
                      <!-- company location -->
                      <p>
                        <?php echo $row['location'] ?>
                      </p>
                    </div>
                  </div>
                  <div class="editoption">
                    <!-- <a href=""><button>Edit</button></a> -->
                    <a class="editprofile" onclick="" href="company-profiledit.php">Edit</a>
                  </div>
                </div>
                <div class="profile-information">
                  <!-- company description/bio section -->
                  <div class="description">
                    <p>
                      <?php echo $row['description'] ?>
                    </p>
                  </div>
                  <div class="profile-subinfo">
                    <p>
                    <h4>Contact person:
                      <?php echo $row['conatact_personname'] ?>
                    </h4>
                    </p>
                    <p><img src="./images/phone.svg" height="18px" width="18px">&nbsp;&nbsp;
                      <?php echo $row['phone'] ?>
                    </p>
                    <p><img src="./images/Email.svg" height="18px" width="18px">&nbsp;&nbsp;
                      <?php echo $row['email'] ?>
                    </p>
                    <img src="./images/website.svg" height="18px" width="18px">&nbsp;&nbsp;<a
                      href="<?php echo $row['website'] ?>">
                      <?php echo $row['website'] ?>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
          <div class="updateprofile">

          </div>
        </div>


        <!------------post job-------------------->
        <div id="postjob" class="container">
          <div class="postjob">
            <div class="postjob-details">
              <!-- company desceiption call from company profile -->
              <div class="postjob-details-qualification">
                <h3>Post JOb</h3>
                <div class="basicinfo">
                  <?php
                  $category = $title = $deadline = $no_of_vacancy = $salary = $location = $jobtype = $decription = '';
                  $categoryErr = $titleErr = $deadlineErr = $no_of_vacancyErr = $salaryErr = $locationErr = $jobtypeErr = $descriptionErr = '';

                  if (isset($_POST['post'])) {

                    if (empty($_POST['basciinfo'])) {
                      $categoryErr = "Category type not selected";
                    } else {
                      $category = $_POST['basciinfo'];
                    }

                    if (empty($_POST['jobtitle'])) {
                      $titleErr = "Job Title is not mentioned";
                    } else {
                      $title = test_input($_POST['jobtitle']);
                    }

                    if (empty($_POST['deadline_date'])) {
                      $deadlineErr = "Deadline date not selected";
                    } else {
                      // $deadline = test_input(date('Y-m-d', strtotime($_POST['deadline_date'])));
                      // $deadline = test_input($_POST['deadline_date']);
                      $deadline = $_POST['deadline_date'];
                      $deadline_datee = date('Y-m-d', strtotime($deadline));
                    }

                    if (empty($_POST['no_of_vacancy'])) {
                      $no_of_vacancyErr = "Mention the number of vacancy";
                    } else {
                      $no_of_vacancy = test_input($_POST['no_of_vacancy']);
                    }

                    if (empty($_POST['estimatedsalary'])) {
                      $salaryErr = "Mention the estimated salary details";
                    } else {
                      $salary = test_input($_POST['estimatedsalary']);
                    }

                    if (empty($_POST['joblocation'])) {
                      $locationErr = "job location not mentioned";
                    } else {
                      $location = test_input($_POST['joblocation']);
                    }

                    if (empty($_POST['jobtype'])) {
                      $jobtypeErr = "job type not selected";
                    } else {
                      $jobtype = test_input($_POST['jobtype']);
                    }
                    if (empty($_POST['jobdescription'])) {
                      $decriptionErr = "Job description cannot be left empty";
                    } else {
                      $description = test_input($_POST['jobdescription']);
                    }

                    if (empty($categoryErr) && empty($titleErr) && empty($deadlineErr) && empty($no_of_vacancyErr) && empty($salaryErr) && empty($locationErr) && empty($jobtypeErr) && empty($decriptionErr)) {
                      $postdate = date('Y-m-d H:i:s');
                      include('./database/connection.php');
                      $email = $_SESSION['email'];
                      $sql = "SELECT company_id,company_name FROM company WHERE email = '$email'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $companyID = $row['company_id'];
                        $companyName = $row['company_name'];
                      }


                      $stmt = $conn->prepare("INSERT INTO job(Category,Job_title, posted_date,deadline_date,no_of_vacancy ,estimated_salary,job_address,Job_Type,Job_description,companyID,CompanyName)VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                      $stmt->bind_param("ssssissssis", $category, $title, $postdate, $deadline_datee, $no_of_vacancy, $salary, $location, $jobtype, $description, $companyID, $companyName);
                      $stmt->execute();
                      $stmt->close();
                    }
                  }
                  function test_input($data)
                  {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                  }
                  ?>
                  <form action="" method="post">

                    <label for="Category"></label>
                    <select name="basciinfo" id="basicinfo" value="<?php ?>">
                      <option value="" id="Select company/industry category">Select company/industry category</option>
                      <option value="IT&Telecommunication" id="IT&Telecommunication">IT&Telecommunication</option>
                      <option value="Graphic Designing" id="Design/Graphics">Design/Graphics</option>
                      <option value="finance" id="Account/Finance">Account/Finance</option>
                      <option value="Medical" id="Medical">Medical</option>
                      <option value="NGO/ING" id="NGO/ING">NGO/ING</option>
                      <option value="Engineering/Architectures" id="Engineering/Architecture">Engineering/Architectures
                      </option>
                      <option value="Tou/Travel" id="Tour/Travel">Tour/Travel</option>
                      <option value="E-comerce" id="E-comerce">E-comerce</option>
                      <span style="color:red">
                        <?php echo $categoryErr; ?>
                      </span>
                    </select>

                    <label for="job title">Job title</label>
                    <input type="text" name="jobtitle" id="jobtitle">
                    <span style="color:red">
                      <?php echo $titleErr; ?>
                    </span>

                    <label for="deadline-date">Deadline Date</label>
                    <input type="date" s name="deadline_date" id="deadline_date">
                    <span style="color:red">
                      <?php echo $deadlineErr ?>
                    </span>

                    <label for="no-of-vacancy">No of Vacancy</label>
                    <input type="number" name="no_of_vacancy" id="no_of_vacancy">
                    <span style="color:red">
                      <?php echo $no_of_vacancyErr; ?>
                    </span>

                    <label for="estimatedsalary">Estimated Salary</label>
                    <input type="text" name="estimatedsalary" id="estimatedsalary">
                    <span style="color:red">
                      <?php echo $salaryErr; ?>
                    </span>

                    <label for="location">Job-Location</label>
                    <input type="text" name="joblocation" id="joblocation">
                    <span style="color:red">
                      <?php echo $locationErr; ?>
                    </span>

                    <label for="jobtype">Job-Type</label>
                    <select name="jobtype" id="jobtype">
                      <option value="">Select Job-type</option>
                      <option value="Full-time">Full-time</option>
                      <option value="part-time">Part-time</option>
                      <option value="Remote">Remote</option>
                    </select>
                    <span style="color:red">
                      <?php $jobtypeErr; ?>
                    </span>

                    <!-- <input type="text" name="jobtype" id="jobtype"> -->

                    <label for="description">Description</label>
                    <textarea name="jobdescription" id="jobdescription" cols="90" rows="30"></textarea>
                    <span style="color:red">
                      <?php echo $descriptionErr; ?>
                    </span>

                    <input type="submit" value="Post" name="post" class="post">
                    <!-- <input type="submit" value="Delete"> -->

                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-----------------manage job------------------->
        <div class="container" id="managejob">
          <div class="managejob">
            <?php
            // $stmt = $conn->prepare("SELECT * FROM job");
            require_once('./database/connection.php');

            $email = $_SESSION['email'];
            $sql = "SELECT company_id FROM company WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $companyID = $row['company_id'];
            }
            $query = "SELECT * FROM job where companyID =$companyID ";
            $result = mysqli_query($conn, $query);
            ?>

            <!-- function for deleing job from mangae job section -->
            <?php
            // function deletejob()
            // {
            //   include './database/connection.php';
            //   $id = isset($_POST['job_id']);
            //   $sql = $conn->prepare("DELETE * from job where job_id =?");
            //   $sql->bind_param("i", $id);
            //   $sql->execute();
            //   $sql->close();
            
            // }
            ?>
            <h2>Manage job </h2>
            <table>
              <tr>
                <th>ID</th>
                <th>Job Title</th>
                <th>Posted_date</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Action</th>
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
                    <?php echo $row['posted_date']; ?>
                  </td>
                  <td>
                    <?php echo $row['deadline_date']; ?>
                  </td>
                  <td> </td>
                  <td>
                    <?php echo '<a class = "btn" href ="jobview.php?id=' . $row['job_id'] . '">View</a>' ?>
                    <?php echo '<a class = "btn"  href ="companyprofile.php?id=' . $row['job_id'] . '">Edit</a>' ?>
                    <?php echo '<a class="btn" href="javascript:void(0);" onclick="confirmDelete(' . $row['job_id'] . ');">Delete</a>' ?>


                  </td>

                </tr>
                <?php
                $counter++;
              }
              ?>

            </table>
          </div>
        </div>
        <!----------application------------->
        <div id="application" class="container">
          <div class="application">
            <h1>application</h1>
          </div>
        </div>

        <!---------------------change password-------------->
        <?php
        $email = $Newpassword = $confirmpassword='';
        $currentpassErr = $confirmpassErr = $newpasswordErr ='';
        if (isset($_POST['changepass'])) {
          //code to verify the current password
          $sql = "SELECT password from company where email = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $companyemail);
          $stmt->execute();
          // $result = $stmt->get_result();
          $isPasswordCorrect = FALSE;
          $stmt->bind_result($company_password);
          if ($stmt->fetch() == TRUE) {
            $isPasswordCorrect = password_verify($password, $company_password);
          } else {
            $currentpass = "Current password doesn't matched";
          }


          //validate new password
          if (empty($_POST['newpassword'])) {
            $currentpassErr = "password is required";
          } else {
            $Newpassword= test_input($_POST['newpassword']);
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

          if(empty($currentpassErr) && empty($newpasswordErr) && empty($confirmpassErr)){
            require_once('./database/connection.php');

            $update_pass = password_hash($Newpassword,PASSWORD_DEFAULT);

            //   $stmt= $conn->prepare("UPDATE company SET password = ?");
            // $stmt->bind_param("s",$update_pass);
            // $stmt->execute();
            // $stm->close();
            $sql = "UPDATE company SET password = $update_pass where email = $companyemail";
            if($conn->query($sql)==TRUE){

              header('location:companyprofile.php');
            }

          }
          
        }
        ?>
        <div id="changepassword" class="container">
          <div class="change-password">
            <div class="password">
              <h3>change password</h3>
              <form action="#" method="post">
                <div class="formdetails">

                  <label for="current passwrod">Current passwrod</label>
                  <input type="password" name="currentpassword" id="currentpassword">
                  <span>
                    <?php echo $currentpassErr ?>
                  </span>

                  <label for="newpassword">New Password</label>
                  <input type="password" name="newpassword" id="newpassword">
                  <span> <?php echo $newpasswordErr; ?></span>


                  <label for="conformpassword">Conform Password</label>
                  <input type="password" name="conformpassword" id="conformpassword">
                  <span><?php echo $confirmpassErr; ?></span>


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
</body>

</html>