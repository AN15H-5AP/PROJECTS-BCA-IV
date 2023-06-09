<?php
$target_dir = "./uploads";
$target_file = $target_dir . basename($_FILES["resume"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
// if ($fileType != ".pdf" && $fileType != "doc" && $fileType != "docx") {
//     echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
//     $uploadOk = 0;
// }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["resume"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

