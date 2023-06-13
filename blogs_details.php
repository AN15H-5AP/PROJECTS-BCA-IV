<?php
include('./Database/connection.php');

$blog_id = $_GET["blog_id"];

// Retrieve the blog details
$sql = "SELECT * FROM jobblogs WHERE blog_id = $blog_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row["title"];
    $posted_date = $row["posted_date"];
    $posted_user = $row["posted_user"];
    $description = $row["description"];
    $images = $row['image'];
} else {
    // If the blog doesn't exist, redirect to the job blogs page
    header("Location: job_blogs.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="job_blogs.css">
    <title>blogs details</title>
</head>

<body>
    <div class="navbarflow">
        <div class="logo">
            <a href="index.php">
                <img src="./images/logo.svg" alt="company logo">
            </a>
        </div>

        <div class="links">
            <a href="index.php">Home</a>
            <a href="job_blogs.php">Blog</a>
            <a href="">Contact</a>
            <a href="">About us</a>
        </div>

        <div class="navbutton">
            <?php if (!isset($_SESSION['email'])) { ?>
                <div class="signin">
                    <a href="job_seekerlogin.php">
                        <button type="submit"><img src="./images/sign in.png" height="13px" width="13px" style="align-items: center;"> Sign in</button>
                    </a>
                </div>
                <div class="signup">
                    <a href="company-registration.php">
                        <button type="submit"><img src="./images/post.png" width="13px" height="13px" alt=""> Post
                            Job</button>
                    </a>
                </div>
            <?php } else { ?>
                <div class="afterlogin">
                    <img src="./images/Account icon.svg" alt="#" class="test">
                    <div class="dropdown">
                        <a href="companyprofile.php"><button>profile</button></a>
                        <a href="sessiondestroy.php"><button>Log out</button></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="blog-details">
        <img src="blogsimage/<?php echo $images; ?>" alt="Blog Image" class="blog-image">
        <h2><?php echo $title; ?></h2>
        <div class="posted-info">
            Posted by <?php echo $posted_user; ?> on <?php echo $posted_date; ?>
        </div>
        <div class="description">
            <?php echo $description; ?>
        </div>
    </div>
</body>

</html>