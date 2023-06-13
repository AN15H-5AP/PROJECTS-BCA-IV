<?php
session_start();
include('./Database/connection.php');
$session = $_SESSION['email'];

$stmt = $conn->prepare("SELECT * from company where email = ?");
$stmt->bind_param("s", $session);
$stmt->execute();

$result = $stmt->get_result();

$comapnyname = $contactperson = $companyaddress = $companywebsite = $companyphone = $companyemail = $companydesc = $a = '';
$comapnynameErr = $contactpersonErr = $companyaddressErr = $companywebsiteErr = $companyphoneErr = $companyemailErr = $imageErr = $companydescErr = '';
if (isset($session)) {

    if (isset($_POST['submit'])) {
        $companyname = test_input($_POST['companyname']);
        if (!preg_match("/^[a-zA-Z ]*$/", $companyname)) {
            $comapnynameErr = "Only letter and whitespace";
        }
        $contactperson = test_input($_POST['contactperson']);
        if (!preg_match("/^[a-zA-Z ]*$/", $contactperson)) {
            $contactpersonErr = "only letter and whitespace";
        }
        $companyaddress = test_input($_POST['companyaddress']);
        if (!preg_match("/^[a-zA-Z ]*$/", $companyaddress)) {
            $companyaddressErr = "only letter and whitespace";
        }
        $companywebsite = ($_POST['companywebsite']);
        if (!preg_match("~^(?:f|ht)tps?://~", $companywebsite)) {
            $companywebsite = 'https://' . $companywebsite;
            $companywebsiteErr = "invalid website format";
        }
        $companyphone = test_input($_POST['companyphone']);
        if (!preg_match("/[0-9]{10}$/", $companyphone)) {
            $companyphoneErr = "invalid phone number";
        }
        $companyemail = test_input($_POST['companyemail']);
        if (!filter_var($companyemail, FILTER_VALIDATE_EMAIL)) {
            $companyemailErr = "invalid email format";
        }
        $companydesc = test_input($_POST['details']);


        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $imageName = $_FILES["image"]["name"];
            $targetDir = "./images/uploaded_image/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $validExtensions = ["jpg", "jpeg", "png"];
            if (in_array($imageFileType, $validExtensions)) {

                if ($_FILES["image"]["size"] <= 5 * 1024 * 1024) {

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        // Store the image name in the Database
                        $imageName = $_FILES["image"]["name"];
                    } else {
                        $imageErr = "Error uploading files";
                    }
                } else {
                    $imageErr = "Files should be less than 5MB";
                }
            } else {
                $imageErr = "Invalid image format";
            }
        } else {
            $imageErr = "Error uploading files";
        }





        if (empty($comapnynameErr) && empty($contactpersonErr) && empty($companyaddressErr) && empty($companywebsiteErr) && empty($companyphoneErr) && empty($companyemailErr) && empty($companydescErr)) {
            $stmt = $conn->prepare("UPDATE company SET company_name =? ,conatact_personname =?,email=?,phone=?,location=?,website=?,description=?,Image_name=? where email =?");
            $stmt->bind_param("sssssssss", $companyname, $contactperson, $companyemail, $companyphone, $companyaddress, $companywebsite, $companydesc, $imageName, $session);

            $stmt->execute();
            $stmt->close();
            header("location:companyprofile.php");
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
    <link rel="stylesheet" href="./styles/companyprofiledit.css">
</head>

<body>
    <?php include('afterloginnav.php') ?>
    <div class="main">
        <div class="dashboard-nav">
            <div class="dashboard-vertical-nav">
                <a href="index.php">Home</a>
                <a href="companyprofile.php">Profile</a>
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
                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                $imagefile = $row['Image_name'];
                            ?>
                                <div class="imagesection">
                                    <?php if ($row['Image_name'] == '') {
                                        echo '<img src = ./images/avatar.png>';
                                    } else {
                                        echo '<img src="./images/uploaded_image/' . $row['Image_name'] . '">';
                                    } ?>
                                    <input type="file" name="image">
                                </div>
                        </div>
                    </div>
                    <div class="detail-info">
                        <h2>Company Profile</h2>

                        <label for="company name">Company Name</label>
                        <input type="text" name="companyname" id="Companyname" value="<?php echo $row['company_name']; ?>">
                        <span>
                            <?php echo $comapnynameErr; ?>
                        </span>

                        <label for="contact perosn name">Contact Person name</label>
                        <input type="text" name="contactperson" id="contactperson" value="<?php echo $row['conatact_personname']; ?>">
                        <span>
                            <?php echo $contactpersonErr; ?>
                        </span>


                        <label for="companyaddress">Company Address</label>
                        <input type="text" name="companyaddress" id="companyaddress" value="<?php echo $row['location']; ?>">
                        <span>
                            <?php echo $companyaddressErr; ?>
                        </span>

                        <label for="comapnywebsite">Conpamy Website(optional)</label>
                        <input type="text" name="companywebsite" id="comapanywebsite" value="<?php echo $row['website']; ?>">
                        <span>
                            <?php echo $companywebsiteErr; ?>
                        </span>

                        <label for="Phonenumber">Company Phone</label>
                        <input type="text" name="companyphone" id="comapanyphone" value="<?php echo $row['phone']; ?>">
                        <span>
                            <?php echo $companyphoneErr; ?>
                        </span>

                        <label for="email">Company Email</label>
                        <input type="text" name="companyemail" id="companyemail" value="<?php echo $row['email']; ?>">
                        <span>
                            <?php echo $companyemailErr; ?>
                        </span>

                        <label for="textarea">Description</label>
                        <textarea name="details" id="details" cols="90" rows="20"><?php echo $row['description'] ?></textarea> <br>

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