<?php
include ('./database/connection.php') ;
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
          <img src="images/<?php echo $images; ?>" alt="Blog Image" class="blog-image">
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