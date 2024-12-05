<?php

include 'config.php';

$sql = "SELECT * FROM movie";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td img {
            width: 100px;
            height: 150px;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .edit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .edit-btn:hover {
            background-color: #45a049;
        }

        .container-flex {
            display: flex;
            justify-content: center;
        }



        .add-btn {
            background-color: #D91656;
            color: white;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 5px;
            height: 26px;
            text-align: center;
        }

        .add-btn:hover {
            background-color: #3A6D8C;
        }

        .delete-btn {
            background-color: #E4003A;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            width:75px;
            border-radius: 5px;
            border:none;
            height: 30px;
            font-size: 16px;
        }

        .delete-btn:hover {
            background-color: #B8001F;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        footer p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <h1>Movie List</h1>
    <table>
        <thead>
            <tr>
                <th>Movie Image</th>
                <th>Movie Name</th>
                <th>Duration</th>
                <th>Genre</th>
                <th>Release Date</th>
                <th>Director</th>
                <th>Actor</th>
                <th>Seat Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='../" . $row['img_src'] . "' alt='" . $row['movie_name'] . "'></td>";
            echo "<td>" . $row['movie_name'] . "</td>";
            echo "<td>" . $row['duration'] . "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['relDate'] . "</td>";
            echo "<td>" . $row['movieDirector'] . "</td>";
            echo "<td>" . $row['movieActors'] . "</td>";
            echo "<td>$" . $row['seat_price'] . "</td>";
            
            
            echo "<td><a href='edit_movie.php?movie_id=" . $row['id'] . "' class='edit-btn'>Edit</a></td>";
            
          
            echo "<td>
                    <form action='delete_movie.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='movie_id' value='" . $row['id'] . "'>
                        <button type='submit' class='delete-btn' >Delete</button>
                    </form>
                  </td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No movies found</td></tr>"; 
    }
    ?>
        </tbody>


    </table>
    <?php
    echo "<div class='container-flex'>";
    echo "<a href='add_movie.php' class='add-btn'>Add New Movie</a>";
    echo "</div>";
    ?>
    <footer>
        <div class="container">
            <p>&copy;Movie Booking | By Sanskar</p>
        </div>
    </footer>

</body>

</html>