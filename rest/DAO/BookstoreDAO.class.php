<?php











$servername = "127.0.0.1";
$username = "root";
$password = "4@ERbR2gSa6yLg";
$schema = "Bookstore";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>