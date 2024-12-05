<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie_id = $_POST['movie_id'];

    $con->begin_transaction();

    try {
       
        $sql_bookings = "DELETE FROM bookings WHERE movie_id = ?";
        $stmt_bookings = $con->prepare($sql_bookings);
        $stmt_bookings->bind_param("i", $movie_id);
        $stmt_bookings->execute();

        
        $sql_showtimes = "DELETE FROM showtimes WHERE movie_id = ?";
        $stmt_showtimes = $con->prepare($sql_showtimes);
        $stmt_showtimes->bind_param("i", $movie_id);
        $stmt_showtimes->execute();

        $sql_movie = "DELETE FROM movie WHERE id = ?";
        $stmt_movie = $con->prepare($sql_movie);
        $stmt_movie->bind_param("i", $movie_id);
        $stmt_movie->execute();

        $con->commit();

        header("Location: admin.php");
        exit();
    } catch (Exception $e) {
    
        $con->rollback();
        echo "Error deleting records: " . $e->getMessage();
    }

    $stmt_bookings->close();
    $stmt_showtimes->close();
    $stmt_movie->close();
}

$con->close();
?>

