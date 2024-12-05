<?php
include 'connections.php';  


if (isset($_POST['selected_date']) && isset($_POST['movie_id'])) {
    $selectedDate = $_POST['selected_date'];
    $movieId = $_POST['movie_id'];
    
   
    $date = DateTime::createFromFormat('d-m-Y', $selectedDate)->format('Y-m-d');

   
    $query = "SELECT DATE_FORMAT(show_time, '%H:%i') AS time 
              FROM showtimes 
              WHERE movie_id = ? AND show_date = ? order by show_time";
    
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('is', $movieId, $date);
        $stmt->execute();
        $result = $stmt->get_result();

        $times = [];
        while ($row = $result->fetch_assoc()) {
            $times[] = $row['time'];
        }

        header('Content-Type: application/json');
        echo json_encode($times);
    } else {
        echo json_encode(['error' => 'Failed to prepare the SQL query.']);
    }
} else {
    echo json_encode(['error' => 'Invalid input.']);
}
?>
