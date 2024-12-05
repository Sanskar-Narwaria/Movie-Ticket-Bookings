<?php
include "connections.php";
if (isset($_POST['confirm_booking'])) {
    
    $arr = array(
        'movie_name' => $_POST['movie_name'],
        'customer_name' => $_POST['customer_name'],
        'email' => $_POST['email'],
        'phone_number' => $_POST['phone_number'],
        'movie_date' => $_POST['movie_date'],
        'movie_time' => $_POST['movie_time'],
        'movie_id' => $_POST['movie_id'],
        'seats'  => $_POST['selected_seats'],
        'total_amount' => $_POST['total_amount']
    );

    $Query = "SELECT * FROM movie WHERE id = ".$arr['movie_id'];
    $movieDetails = mysqli_query($con, $Query);
    $row = mysqli_fetch_array($movieDetails);
    // echo print_r($row);

    // foreach ($arr as $key => $value) {
    //     echo "$key: $value <br>";
    // }
}
else{
    echo "No booking button clicked!";
}
?>

<!DOCTYPE html>

<html>  
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Confirmation</title>
        <link rel="stylesheet" href="style_payment.css">
    </head>
    <body>
        <div class='container'>
            <h1>Booking Details</h1>
            <div class='movie-box'>
                
            <?php
                echo '<img src="' . $row['img_src'] . '" alt="'.$row['movie_name'].'">';
            ?>
            </div>
            <?php
            echo '<p> Movie Title : '.$arr['movie_name'].'</p>';
            echo '<p> Movie Date : '.$arr['movie_date'].'</p>';
            echo '<p> Movie Time : '.$arr['movie_time'].'</p>';
            echo '<p> Seats : '.$arr['seats'].'</p>';
            echo '<p> Total Amount : '.$arr['total_amount'].'</p>';
            ?>
    

            <form method="POST" action="payment_process.php">
            <input type="hidden" name="movie_name" value="<?php echo $arr['movie_name']; ?>">
            <input type="hidden" name="customer_name" value="<?php echo $arr['customer_name']; ?>">
            <input type="hidden" name="email" value="<?php echo $arr['email']; ?>">
            <input type="hidden" name="phone_number" value="<?php echo $arr['phone_number']; ?>">
            <input type="hidden" name="movie_date" value="<?php echo $arr['movie_date']; ?>">
            <input type="hidden" name="movie_time" value="<?php echo $arr['movie_time']; ?>">
            <input type="hidden" name="seats" value="<?php echo $arr['seats']; ?>">
            <input type="hidden" name="total_amount" value="<?php echo $arr['total_amount'];?>">
            <input type="hidden" name="movie_id" value="<?php echo $arr['movie_id'];?>">
            
            <button type="submit" class="payment_btn" name="payment">Proceed to Pay</button>
            </form>
        </div>
        
    </body>
    <script>
        // let btn = document.querySelector('.payment_btn');
        // btn.addEventListener('click', (e) => {
        //     e.preventDefault();
        //     alert("Payment Successful!");
        //     window.location.href = "payment_process.php";
        // });
    </script>
</html>