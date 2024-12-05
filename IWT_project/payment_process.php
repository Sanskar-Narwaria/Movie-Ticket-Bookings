<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        .success{
            display: flex;
            position :absolute;
            align-items: center;
            flex-direction :column;
            height: 130px;
            width: 500px;
            background-color: #F5EFFF;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        }
        .success p{
            margin-top:20px;
            font-size: 20px;
            color : #E4003A;
            font-weight: bold;
        }
        .success .btn {
            display: block;
            padding: 10px 20px;
            background-color: #36C2CE;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 2px;
            text-align: center;
        }

    </style>

</head>
<body>
<?php
include 'connections.php';
if (isset($_POST['payment'])) {
    $date = explode("-", $_POST['movie_date']);
    $time = explode(":", $_POST['movie_time']);

    $show_time = $date[2] . '-' . $date[1] . '-' . $date[0] . ' ' . $time[0] . ':' . $time[1] . ':00';

    $sql = "INSERT INTO bookings (customer_name, email, phone, movie_name, seats, total_amount, show_time , movie_id ) 
            VALUES ('" . $_POST['customer_name'] . "', '" . $_POST['email'] . "', '" . $_POST['phone_number'] . "', 
                    '" . $_POST['movie_name'] . "', '" . $_POST['seats'] . "', '" . $_POST['total_amount'] . "', 
                    '" . $show_time . "', '" . $_POST['movie_id'] . "')";

    if ($con->query($sql) === TRUE) {
        echo "<div class='success'>";
        echo "<p>Congratulations! Booking Confirmed!</p>";
        echo "<button type='button' class='btn' name = 'btn'>Go to Home Page</button>";
        echo "</div>";
        
    } else {
        echo "<div class='error'>";
        echo "Error: " . $sql . "<br>" . $con->error;
        echo "</div>";
    }
    $con->close();
} else {
    echo "<div class='error'>";
    echo "Payment not set.";
    echo "</div>";
}
?>
</body>
<script>
    let btn = document.querySelector('.btn');
    btn.addEventListener('click', () => {
        window.location.href = 'index.php';
    });
</script>
</html>
