<?Php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$name = $email = $phone = $password = $confirm_password = "";
$nameErr = $emailErr = $phoneErr = $passwordErr = $confirm_passwordErr = "";

if (isset($_POST['submit'])) {
  //validate name
  if (empty($_POST["fname"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  //validate email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if email address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  //validate phne
  if (empty($_POST['phone'])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST['phone']);
    //check whetehter the number starts from 9 and have 10 digits
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
      $phoneErr = "Invalid phone number format";
    }
  }

  //validate password
  if (empty($_POST['password'])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST['password']);
    //check if the password is strong or not
    if (strlen($password) < 8) {
      $passwordErr = "Password must be at least 8 characters long";
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $passwordErr = "Password must contain at least one number";
    } elseif (!preg_match("#[A-Z]+#", $password)) {
      $passwordErr = "Password must contain at least one uppercase letter";
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $passwordErr = "Password must contain at least one lowercase letter";
    }
  }

  //validate conform password
  if (empty($_POST["conpassword"])) {
    $confirm_passwordErr = "Please confirm your password";
  } else {
    $confirm_password = test_input($_POST["conpassword"]);
    // check if passwords match
    if ($confirm_password != $password) {
      $confirm_passwordErr = "Passwords do not match";
    }
  }
  //data insert into Database
  if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($passwordErr) && empty($confirm_passwordErr)) {
    include('./Database/connection.php');

    $job_seeker_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO job_seeker(Full_name,Email,Phone,Password) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $job_seeker_password);

    $stmt->execute();
    $stmt->close();
    $_SESSION['registered'] = '<div class="notification">
    <div class="notification_body">
      your account has been created !
    </div>
  </div>';
    header("location:job_seekerlogin.php");
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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./Styles/job_seekerregistration.css">
</head>

<body>
  <div class="navbar">
    <?php include('job_seekerregistrationnav.php') ?>

  </div>
  <div class="registration">
    <div class="imagesection">
      <img src="./images/registration.png" alt="registration image" class="img-registration">
    </div>
    <div class="formfields">
      <div class="textarea">
        <h2>Create Your Free Account</h2>
        <h4>Fill your basic information below </h4>
      </div>
      <div class="forminput">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

          <label for="Full name"></label>
          <input type="text" name="fname" id="fname" value="<?php if (isset($_POST['fname'])) {
                                                              echo $_POST['fname'];
                                                            } ?>" placeholder="Full name">
          <span style="color:red" ;>
            <?php echo "$nameErr"; ?>
          </span>
          <label for="email"></label>
          <input type="email" name="email" id="email" value="<?php if (isset($_POST['email'])) {
                                                                echo $_POST['email'];
                                                              } ?>" placeholder="Email">
          <span style="color:red" ;>
            <?php echo "$emailErr"; ?>
          </span>

          <label for="phone"></label>
          <input type="text" name="phone" id="phone" value="<?php if (isset($_POST['phone'])) {
                                                              echo $_POST['phone'];
                                                            } ?>" placeholder="Mobile Number">
          <span style="color:red" ;>
            <?php echo "$phoneErr"; ?>
          </span>

          <label for="password"></label>
          <input type="password" name="password" id="password" value="<?php if (isset($_POST['password'])) {
                                                                        echo $_POST['password'];
                                                                      } ?>" placeholder="password">
          <span style="color:red" ;>
            <?php echo "$passwordErr"; ?>
          </span>

          <label for="conpassword"></label>
          <input type="password" name="conpassword" id="conpassword" placeholder="Conform password">
          <span style="color:red" ;>
            <?php echo "$confirm_passwordErr"; ?>
          </span>

          <p>By clicking the below Create Account button.<br>agree terms and condition of insearch</p>
          <input type="submit" class="signup" name="submit" value="Create Account">
        </form>
      </div>
      <div class="redirect-login">
        <p>Already have account? <a href="job_seekerlogin.php">Sign in</a></p>
      </div>
    </div>
  </div>


</body>

</html>