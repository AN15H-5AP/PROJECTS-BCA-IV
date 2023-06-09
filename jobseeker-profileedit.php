<?php
session_start();
include('./database/connection.php');
$session = $_SESSION['email'];

$stmt = $conn->prepare("SELECT * from job_seeker where Email = ?");
$stmt->bind_param("s",$session);
$stmt->execute();

$result = $stmt->get_result(); 

$jobseekername  = $jobseekeraddress  = $jobseekerphone = $jobseekeremail = $jobseekerdesc = $a = '';
$jobseekernameErr  = $jobseekeraddressErr  = $jobseekerphoneErr = $jobseekeremailErr = $imageErr = $jobseekerdescErr = '';
if (isset($session)) {

    if (isset($_POST['submit'])) {
        $jobseekername = test_input($_POST['jobseekername']);
        if (!preg_match("/^[a-zA-Z ]*$/", $jobseekername)) {
            $jobseekernameErr = "Only letter and whitespace";
        }
        
        $jobseekeraddress = test_input($_POST['jobseekeraddress']);
        if (!preg_match("/^[a-zA-Z ]*$/", $jobseekeraddress)) {
            $jobseekeraddressErr = "only letter and whitespace";
        }
      
        $jobseekerphone = test_input($_POST['jobseekerphone']);
        if (!preg_match("/[0-9]{9}$/", $jobseekerphone)) {
            $jobseekerphoneErr = "invalid phone number";
        }
        $jobseekeremail = test_input($_POST['jobseekeremail']);
        if (!filter_var($jobseekeremail, FILTER_VALIDATE_EMAIL)) {
            $jobseekeremailErr = "invalid email format";
        }
        // $jobseekerdesc = test_input($_POST['details']);

        // $imagefile ="";
        // $target_dir = "./images/uploaded_image";
        // $a = $_FILES["image"]["name"];
        // $target_file = $target_dir.$a;
        // if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		// }else{
        //     $imageErr = "Error uploading file";
        // }

        if (empty($jobseekernameErr) && empty($jobseekeraddressErr) && empty($jobseekerphoneErr) && empty($jobseekeremailErr) ) {
            $stmt = $conn->prepare("UPDATE job_seeker SET Full_name =? ,Email=?,Phone=?,Address=? where Email =?");
            $stmt->bind_param("sssss", $jobseekername, $jobseekeremail, $jobseekerphone, $jobseekeraddress, $session);

            $stmt->execute();
            $stmt->close();
            header("location:jobseekerprofile.php");
        }
        
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Styles/company-profiledit.css">
</head>

<body>
    <?php include('afterloginnav.php') ?>
    <div class="main">
        <div class="dashboard-nav">
            <div class="dashboard-vertical-nav">
                <a href="index.php">Home</a>
                <a href="jobseekerprofile.php">Profile</a>
                <!-- <a href="#">Post Job</a>
                <a href="#">Manage job</a>
                <a href="#">Change Password</a> -->
            </div>
        </div>

        <div class="details">
            <div class="companyinfo">
                <form action="" method="POST" enctype="multipart/form-data">
                <div class="information-profile">
                    <div class="profile-header">
                        <div class="imagesection">
                            <img src="./images/avatar.png" alt="#">
                            <input type="file" name="image">
                        </div>
                    </div>
                </div>
                <?php while($row = mysqli_fetch_assoc($result)){?>
                <div class="detail-info">
                    <h2>Jobseeker Profile</h2>

                        <label for="jobseekername name">Job-Seeker Name</label>
                        <input type="text" name="jobseekername" id="jobseekername" value="<?php echo $row['Full_name']; ?>" >
                        <span><?php  echo $jobseekernameErr; ?></span>


                        <label for="jobseekeraddress">Job-Seeker Address</label>
                        <input type="text" name="jobseekeraddress" id="jobseekeraddress" value="<?php echo $row['Address']; ?>">
                        <span><?php  echo $jobseekeraddressErr; ?></span>


                        <label for="Phonenumber"> Phone</label>
                        <input type="text" name="jobseekerphone" id="jobseekerphone" value="<?php echo $row['Phone']; ?>" >
                        <span><?php  echo $jobseekerphoneErr; ?></span>

                        <label for="email">Email</label>
                        <input type="text" name="jobseekeremail" id="jobseekeremail" value="<?php echo $row['Email']; ?>" >
                        <span><?php  echo $jobseekeremailErr; ?></span>


                        <button class="button" type="submit" name="submit">Update</button>
                    </form>
                </div>
                <?php }
                $stmt->close(); ?>
            </div>
        </div>
    </div>
    <script src="./js/company-profileedit.js"></script>
</body>

</html>