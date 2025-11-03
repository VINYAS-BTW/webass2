<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $course = htmlspecialchars($_POST['course']);
    $message = htmlspecialchars($_POST['message']);

    echo "
    <h3>Registration Successful!</h3>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Course:</strong> $course</p>
    <p><strong>Message:</strong> $message</p>
    <hr>
    <p style='color:green;'>Your form has been submitted successfully!</p>
    ";
} else {
    echo "<p style='color:red;'>Invalid Request!</p>";
}
?>
