<?php
session_start();
$companyemail = $_SESSION['email'];
include("./Database/connection.php");
if (!isset($companyemail)) {
  header("location:index.php");
}
$category = $title = $deadline = $deadlinedatetime= $no_of_vacancy = $salary = $location = $jobtype = $decription = '';
$categoryErr = $titleErr = $deadlineErr = $no_of_vacancyErr =$deadlinetimeErr= $salaryErr = $locationErr = $jobtypeErr = $descriptionErr = '';
$select = $jobtitle = $deadlinedate = $noofvacancy = $estimatedsalary = $jobaddress = $type = $jobdescription = '';
$id = isset($_GET['job_id']);
if (isset($_POST[""]) && !empty($_POST['replace'])) {


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
    $deadline = $_POST['deadline_date'];
    $deadline_datee = date('Y-m-d', strtotime($deadline)); 
  }
  if(empty($_POST['deadline_time'])){
    $deadlinetimeErr = "Time not selected";
  }else{
    $deadlinetime = $_POST['deadline_time'];
  }
  $deadlinedatetime = $deadline_datee .' '.$deadlinetime;
  

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

    $stmt = $conn->prepare("UPDATE job SET Category =?,Job_title=?,deadline_date=?,no_of_vacancy=?,estimated_salary=?,job_address=?,Job_Type=?,Job_description=? where 	job_id = ? ");
    $stmt->bind_param("sssissssi", $category, $title, $deadlinedatetime, $no_of_vacancy, $salary, $location, $jobtype, $description, $id );
    $stmt->execute();
    $stmt->close();
    header("location:companyprofile.php");
  }
} 
  //check id before processiong further
  if (isset($_GET['job_id'])) {
    $id = trim($_GET['job_id']);

    $stmt = $conn->prepare("SELECT * from job where job_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);

      $select = $row['category'];
      $jobtitle = $row['job_title'];
      $deadlinedate = $row['deadline_date'];
      $date = date('Y-m-d',strtotime($deadlinedate));
      $time = date('H:i:s',strtotime($deadlinedate));
      $noofvacancy = $row['no_of_vacancy'];
      $estimatedsalary = $row['estimated_salary'];
      $jobaddress = $row['job_address'];
      $type = $row['job_type'];
      $jobdescription = $row['job_description'];
    } else {
      echo "Error";
      header("location:companyprofile.php");
      exit();
    }
    $stmt->close();
  } else {
    echo header('location:index.php');
  }
// }
// }else {
//   header("location:index.php");
//   exit();
// }

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./Styles/companyproffile.css">
  <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/brands.css">
  <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/fontawesome.css">
  <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/solid.css">
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
          <button class="tablinks">Post job</button>
        </div>
      </div>

      <!-- ----------------------------profile information------------------->
      <div class="dashboard-content">
        <div id="profile" class="container">
          <!------------post job-------------------->
          <div id="postjob" class="container">
            <div class="postjob">
              <div class="postjob-details">
                <!-- company desceiption call from company profile -->
                <div class="postjob-details-qualification">
                  <h3>Post JOb</h3>
                  <div class="basicinfo">
                    <form action="" method="post">
                      <?php echo $id; ?>
                      <label for="Category"></label>
                      <select name="basciinfo" id="basicinfo">

                        <option value="" id="Select company/industry category" value="">Select
                          company/industry category</option>
                        <option value="IT&Telecommunication" id="IT&Telecommunication" <?php echo ($select == 'IT&Telecommunication') ? 'selected' : ''; ?>>IT&Telecommunication</option>
                        <option value="Design/Graphics" id="Design/Graphics" <?php echo ($select == 'Design/Graphics') ? 'selected' : ''; ?>>Design/Graphics</option>
                        <option value="Account/Finance" id="Account/Finance" <?php echo ($select == 'Account/Finance') ? 'selected' : ''; ?>>Account/Finance</option>
                        <option value="Medical" id="Medical" value="Medical" <?php echo ($select == 'Medical') ? 'selected' : ''; ?>>Medical</option>
                        <option value="NGO/INGO" id="NGO/ING" <?php echo ($select == 'NGO/INGO') ? 'selected' : ''; ?>>
                          NGO/INGO</option>
                        <option value=" Engineering/Architectures" id="Engineering/Architecture" <?php echo ($select == 'Engineering/Architectures') ? 'selected' : ''; ?>>Engineering/Architectures
                        </option>
                        <option id="Tour/Travel" value="Tour/Travel" <?php echo ($select == 'Tour/Travel') ? 'selected' : ''; ?>>Tour/Travel</option>
                        <option id="E-comerce" value="E-comerce" <?php echo ($select == 'E-comerce') ? 'selected' : ''; ?>>E-comerce</option>
                        <span style="color:red">
                          <?php echo $categoryErr; ?>
                        </span>
                      </select>

                      <label for="job title">Job title</label>
                      <input type="text" name="jobtitle" id="jobtitle" value="<?php echo $jobtitle; ?>">
                      <span style="color:red">
                        <?php echo $titleErr; ?>
                      </span>

                      <label for="deadline-date">Deadline Date</label>
                      <input type="date" s name="deadline_date" id="deadline_date" value="<?php echo $date; ?>">
                      <span style="color:red">
                        <?php echo $deadlineErr ?>
                      </span>

                      <label for="deadline-time">Time</label>
                    <input type="time" name="deadline_time" id="deadline_time" value ="<?php echo $time; ?>">
                    <span style="color:red">
                     <?php  echo $deadlinetimeErr ?> 
                    </span>

                      <label for="no-of-vacancy">No of Vacancy</label>
                      <input type="number" name="no_of_vacancy" id="no_of_vacancy" value="<?Php echo $noofvacancy; ?>">
                      <span style="color:red">
                        <?php echo $no_of_vacancyErr; ?>
                      </span>

                      <label for="estimatedsalary">Estimated Salary</label>
                      <input type="text" name="estimatedsalary" id="estimatedsalary"
                        value="<?php echo $estimatedsalary; ?>">
                      <span style="color:red">
                        <?php echo $salaryErr; ?>
                      </span>

                      <label for="location">Job-Location</label>
                      <input type="text" name="joblocation" id="joblocation" value="<?php echo $jobaddress; ?>">
                      <span style="color:red">
                        <?php echo $locationErr; ?>
                      </span>

                      <label for="jobtype">Job-Type</label>
                      <select name="jobtype" id="jobtype">
                        <option value="">Select Job-type</option>
                        <option value="Full time" <?php echo ($type = 'Full time') ? 'selected' : ''; ?>>Full time
                        </option>
                        <option value="Part time" <?php echo ($type = 'Part time') ? 'selected' : ''; ?>>Part time
                        </option>
                        <option value="Remote" <?php echo ($type = 'Remote') ? 'selected' : ''; ?>>Remote</option>
                      </select>
                      <span style="color:red">
                        <?php $jobtypeErr; ?>
                      </span>

                      <!-- <input type="text" name="jobtype" id="jobtype"> -->

                      <label for="description">Description</label>
                      <textarea name="jobdescription" id="jobdescription" cols="90"
                        rows="30"><?php echo $jobdescription ?></textarea>
                      <span style="color:red">
                        <?php echo $descriptionErr; ?>
                      </span>
                      <input type="hidden" name="job_id" value="<?php echo $id; ?>" />
                      <input type="submit" name="replace" value="Update" class="post">
                      <!-- <input type="submit" value="Delete"> -->

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <script src="./js/companyprofile.js"></script> -->
</body>

</html>