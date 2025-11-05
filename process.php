<?php
$file = 'data.json';
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $data = [
        'name' => htmlspecialchars($_POST['name']),
        'email' => htmlspecialchars($_POST['email']),
        'phone' => htmlspecialchars($_POST['phone']),
        'dob' => htmlspecialchars($_POST['dob']),
        'gender' => htmlspecialchars($_POST['gender']),
        'course' => htmlspecialchars($_POST['course']),
        'message' => htmlspecialchars($_POST['message']),
        'timestamp' => date("Y-m-d H:i:s")
    ];

    
    $existingData = json_decode(file_get_contents($file), true);


    $existingData[] = $data;

 
    file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT));

    
    echo "
    <h3>Registration Successful!</h3>
    <p><strong>Name:</strong> {$data['name']}</p>
    <p><strong>Email:</strong> {$data['email']}</p>
    <p><strong>Phone:</strong> {$data['phone']}</p>
    <p><strong>Date of Birth:</strong> {$data['dob']}</p>
    <p><strong>Gender:</strong> {$data['gender']}</p>
    <p><strong>Course:</strong> {$data['course']}</p>
    <p><strong>Message:</strong> {$data['message']}</p>
    <hr>
    <p style='color:green;'>Your details were saved to <strong>data.json</strong> successfully!</p>
    ";
} else {
    echo "<p style='color:red;'>Invalid Request!</p>";
}
?>
