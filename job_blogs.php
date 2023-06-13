<?php
include('./Database/connection.php');
// Retrieve job blogs 
$sql = "SELECT * FROM jobblogs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="job_blogs.css">
  <title>job blogs</title>
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
  <div class="blog-container">
    <?php
    // display job blogs
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $blog_id = $row["blog_id"];
        $title = $row["title"];
        $posted_date = $row["posted_date"];
        $posted_user = $row["posted_user"];
        $description = $row["description"];
        $images = $row['image'];
        // to display 100 character in the front container
        $less_desc = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;
    ?>
        <div class="blog-card" onclick="showdescription(<?php echo $blog_id; ?>)">
          <img src="blogsimage/<?php echo $images; ?>" alt="Blog Image" class="blog-image">
          <div class="blog-info">
            Posted by <?php echo $posted_user; ?> on <?php echo $posted_date; ?>
          </div>
          <h2><?php echo $title; ?></h2>
          <p class="blog-description" id="description_<?php echo $blog_id; ?>"><?php echo $less_desc; ?></p>
          <a href="blogs_details.php?blog_id=<?php echo $blog_id; ?>" class="read-more-btn">Read More</a>
        </div>
    <?php
      }
    } else {
      echo "No blog posts found.";
    }
    // Close the database connection
    $conn->close();
    ?>

    <script>
      function showdescription(blogId) {
        window.location.href = "blogs_details.php?blog_id=" + blogId;
      }
    </script>
  </div>
</body>

</html>