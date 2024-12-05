<?php
include 'config.php';

if (isset($_GET['delete_date']) && isset($_GET['delete_time'])) {
    $delete_date = $_GET['delete_date'];
    $delete_time = $_GET['delete_time'];
    $movie_id = $_GET['movie_id'];
    
    
    $sql_delete_showtime = $con->prepare("DELETE FROM showtimes WHERE show_date = ? AND show_time = ?");
    $sql_delete_showtime->bind_param("ss", $delete_date, $delete_time);
    
    if ($sql_delete_showtime->execute()) {
    
        
        $sql_delete_bookings = $con->prepare("DELETE FROM bookings WHERE movie_id = ? AND show_time = CONCAT(?, ' ', ?)");
        $sql_delete_bookings->bind_param("iss", $movie_id, $delete_date, $delete_time);
    
        if ($sql_delete_bookings->execute()) {
            header("Location: {$_SERVER['PHP_SELF']}?movie_id=$movie_id");
            exit;
        } else {
            echo "Error deleting bookings: " . $con->error;
        }
    
    } else {
        echo "Error deleting record from showtimes: " . $con->error;
    }

    

}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];
    $movie_name = $_POST['movie_name'];

    $sql_insert = "INSERT INTO showtimes (movie_id, movie_name, show_date, show_time) VALUES ('$movie_id','$movie_name' ,'$show_date', '$show_time')";
    if ($con->query($sql_insert) === TRUE) {
        
        header("Location: {$_SERVER['PHP_SELF']}?movie_id=$movie_id");
        exit;
    } else {
        echo "Error adding show time: " . $con->error;
    }
}

// Fetch current show times for the specific movie
$movie_id = isset($_GET['movie_id']) ? $_GET['movie_id'] : 0;
$sql_show_times = "SELECT * FROM showtimes WHERE movie_id = $movie_id ORDER BY show_date ASC , show_time ASC";
$sql_show_name = "SELECT movie_name FROM movie WHERE id = $movie_id";

$result_show_name = $con->query($sql_show_name);
$row_show_name = $result_show_name->fetch_assoc();
$movie_name = $row_show_name['movie_name'];

$result_show_times = $con->query($sql_show_times);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Dates and Times</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        form {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="date"], input[type="time"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"], .delete-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
            margin: 0 5px;
        }
        .delete-btn {
            background-color: #f44336;
        }
        input[type="submit"]:hover, .delete-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h1>Show Dates and Times</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Movie Name</th>
            <th>Show Date</th>
            <th>Show Time</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result_show_times->num_rows > 0) {
            while ($row = $result_show_times->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['movie_id']}</td>
                        <td>{$row['movie_name']}</td>
                        <td>{$row['show_date']}</td>
                        <td>{$row['show_time']}</td>
                        <td>
                            <a href='?movie_id=$movie_id&delete_date={$row['show_date']}&delete_time={$row['show_time']}' class='delete-btn'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No show times available.</td></tr>";
        }
        ?>
    </table>

    <form method="POST">
        <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
        <input type="hidden" name="movie_name" value="<?php echo $movie_name; ?>">
        <label for="show_date">Show Date:</label>
        <input type="date" id="show_date" name="show_date" required>

        <label for="show_time">Show Time:</label>
        <input type="time" id="show_time" name="show_time" required>

        <input type="submit" value="Add Show Time">
    </form>
</body>
</html>
