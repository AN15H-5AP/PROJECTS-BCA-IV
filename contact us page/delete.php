<?php
if (isset($_GET['delete'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "JobPortal1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['delete'];

    $sql = "DELETE FROM feedback WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
