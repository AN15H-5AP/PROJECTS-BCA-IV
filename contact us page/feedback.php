<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <style>
        input[type=text],
        textarea {
            width: 80%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            cursor: text;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
            display: block;
        }

        form {
            margin-left: 8vh;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            margin-left: 5em;
            padding: 14px;
            width: 60%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            width: 40%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            display: block;
            align-items: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        }

        h1 {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Customer Feedback</h1>
        <form action="" method="post">

            <label for="fullnamename">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Your name..">

            <label for="email"> Email</label>
            <input type="text" id="email" name="email" placeholder="Your Email address..">

            <label for="phone"> Phone</label>
            <input type="text" id="phone" name="phone" placeholder="Your contact number..">


            <label for="address"> Address</label>
            <input type="text" id="address" name="address" placeholder="Your address..">

            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write your feedback here.." style="height:200px"></textarea>

            <input type="submit" value="Submit">

        </form>
    </div>
</body>

</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "JobPortal1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $subject = $_POST['subject'];

    $sql = "INSERT INTO feedback (name, email, phone, address, subject) VALUES ('$name', '$email', '$phone', '$address', '$subject')";

    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Close connection
$conn->close();
?>