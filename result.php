<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="device-width,initial-scale=1.0">
    <title>Registration Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $passportnumber = $_POST['passportnumber'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $dateofbirth = $_POST['dateofbirth'];
    $nationality = $_POST['nationality'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Establish connection to database (replace these values with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "info";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO pass_info (passportnumber, firstname, middlename, lastname, dateofbirth, nationality, gender, address) 
            VALUES ('$passportnumber', '$firstname', '$middlename', '$lastname', '$dateofbirth', '$nationality', '$gender', '$address')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "<div class='box'>";
        echo "<h2>New Registration Details</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Passport Number</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Date of Birth</th><th>Nationality</th><th>Gender</th><th>Address</th></tr>";
        echo "<tr><td>$passportnumber</td><td>$firstname</td><td>$middlename</td><td>$lastname</td><td>$dateofbirth</td><td>$nationality</td><td>$gender</td><td>$address</td></tr>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "No data received";
}

// Retrieve previously entered data from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "info";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM pass_info";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='box'>";
    echo "<h2>Previously Entered Details</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Passport Number</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Date of Birth</th><th>Nationality</th><th>Gender</th><th>Address</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["passportnumber"] . "</td>";
        echo "<td>" . $row["firstname"] . "</td>";
        echo "<td>" . $row["middlename"] . "</td>";
        echo "<td>" . $row["lastname"] . "</td>";
        echo "<td>" . $row["dateofbirth"] . "</td>";
        echo "<td>" . $row["nationality"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "0 results";
}
$conn->close();
?>
</body>
</html>
