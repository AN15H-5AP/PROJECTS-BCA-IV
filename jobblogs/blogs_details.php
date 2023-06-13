<?php
include ('./database/connection.php') ;

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
    <div class="blog-details">
        <img src="images/<?php echo $images; ?>" alt="Blog Image" class="blog-image">
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