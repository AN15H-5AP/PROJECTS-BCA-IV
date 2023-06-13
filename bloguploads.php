<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blogs upload</title>
    <link rel="stylesheet" href="job_blogs.css">
</head>

<body>

    <?php
    include('./Database/connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $posted_user = $_POST["posted_user"];
        $description = $_POST["description"];
        $image_name = "";

        // Check if image file is uploaded
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $image_name = $_FILES["image"]["name"];
            $image_tmp = $_FILES["image"]["tmp_name"];
            $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

            // Generate a unique filename
            $image_filename = uniqid() . '.' . $image_extension;

            // Move the uploaded file to the folder
            // if (move_uploaded_file($image_tmp, "blogsimage/" . $image_filename)) {
            //     echo "Image uploaded successfully.";
            // } else {
            //     echo "Failed to move the uploaded image.";
            // }

            // Insert the details into database
            $sql = "INSERT INTO jobblogs (title, posted_user, description, image) VALUES ('$title', '$posted_user', '$description', '$image_filename')";
            if ($conn->query($sql) === TRUE  &&  move_uploaded_file($image_tmp, "blogsimage/" . $image_filename)) {
                // echo '<p>Job blog uploaded successfully.</p>';
                header('location:admindashboard.php');
            } else {
                echo ' Error:uploading job blogs';
            }
        }
    }

    $conn->close();

    ?>
    <div class="upload-form">
        <h2>Upload Job Blog</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="posted_user">Posted User:</label>
                <input type="text" id="posted_user" name="posted_user" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Upload">
            </div>
        </form>
    </div>
</body>

</html>