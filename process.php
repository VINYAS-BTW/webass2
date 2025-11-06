<?php
$file = 'data.json';
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

$host = getenv('db_host');
$port = getenv('db_port');
$dbname = getenv('db_name');
$user = getenv('db_user');
$pass = getenv('db_pass');
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass sslmode=require");

if (!$conn) {
    die("<p style='color:red;'>Database connection failed: " . pg_last_error() . "</p>");
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

    $query = "INSERT INTO registrations (name, email, phone, dob, gender, course, message)
              VALUES ($1, $2, $3, $4, $5, $6, $7)";
    $result = pg_query_params($conn, $query, [
        $data['name'], $data['email'], $data['phone'],
        $data['dob'], $data['gender'], $data['course'], $data['message']
    ]);

    $existingData = json_decode(file_get_contents($file), true);
    $existingData[] = $data;
    file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT));

    if ($result) {
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
        <p style='color:green;'>Saved to PostgreSQL and data.json successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error saving data: " . pg_last_error($conn) . "</p>";
    }
}

pg_close($conn);
?>
