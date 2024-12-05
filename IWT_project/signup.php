<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['signupEmail'];
    $signup_password = $_POST['signupPassword'];
    $confirmPassword = $_POST['signupConfirmPassword'];
    $signup_username = $_POST['userName'];
    echo $username;

    if ($signup_password === $confirmPassword) {
        $servername = "localhost";
        $username = "root";
        $password = "sanskar";
        $db = "iwt_project";
        $conn = new mysqli($servername, $username, $password,$db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            header("Location: login.html?message=signup_failed");
            exit();
        }
        $sql = "SELECT * FROM usercredentials WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            header("Location: login.html?message=email_already_exists");
            exit();
        }
        else{
            $sql = "INSERT INTO usercredentials (email, password, username) VALUES ('$email', '$signup_password', '$signup_username')";
            if ($conn->query($sql) === TRUE) {
                header("Location: login.html?message=signup_success");
                $conn->close();
                exit();
            } else {
                header("Location: login.html?message=signup_failed");
                exit();
            }
        }
        $conn->close();
    } else {
        // Redirect back to the signup page with an error parameter
        header("Location: login.html?message=passwords_do_not_match");
        exit();
    }
} else {
    echo "Only POST requests are allowed";
}
?>
