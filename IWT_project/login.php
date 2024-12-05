<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    $servername = "localhost";
    $username = "root";
    $db_password = "sanskar"; 
    $db = "iwt_project";
    $conn = new mysqli($servername, $username, $db_password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        header("Location: login.html?message=login_failed");
        exit();
    }

   
    $sql = "SELECT * FROM usercredentials WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $user = $result->fetch_assoc();

        $_SESSION['username'] = $user['username'];  
        $_SESSION['email'] = $user['email'];       
        header("Location: index.php?message=login_successful");
        $conn->close();
        exit();
    } else {
        header("Location: login.html?message=invalid_credentials");
        $conn->close();
        exit();
    }
} else {
    echo "Only POST requests are allowed";
}
?>