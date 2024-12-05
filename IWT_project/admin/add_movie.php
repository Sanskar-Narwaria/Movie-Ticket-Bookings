<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_name = $_POST['movie_name'];
    $duration = $_POST['duration'];
    $genre = $_POST['genre'];
    $relDate = $_POST['relDate'];
    $movieDirector = $_POST['movieDirector'];
    $movieActors = $_POST['movieActors'];
    $seat_price = $_POST['seat_price'];

    $img_src = '';
    if ($_FILES['img_file']['name']) {
        $target_dir = "../movies_imgs/"; 
        $target_file = $target_dir . basename($_FILES["img_file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["img_file"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["img_file"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["img_file"]["tmp_name"], $target_file)) {
                $img_src = str_replace('../', '', $target_file);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Insert movie into the database
    $sql_insert = "INSERT INTO movie (img_src, movie_name, duration, genre, relDate, movieDirector, movieActors, seat_price) VALUES (
        '$img_src', 
        '$movie_name', 
        '$duration', 
        '$genre', 
        '$relDate', 
        '$movieDirector', 
        '$movieActors', 
        '$seat_price')";

    if ($con->query($sql_insert) === TRUE) {
        echo "Movie added successfully!";
        header("Location: admin.php"); 
        exit;
    } else {
        echo "Error adding record: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
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

        input[type="text"], input[type="date"], input[type="file"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .img-preview {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Add Movie</h1>

    <form method="POST" enctype="multipart/form-data">
        <label for="img_file">Movie Image:</label>
        <input type="file" id="img_file" name="img_file" accept="image/*">

        <label for="movie_name">Movie Name:</label>
        <input type="text" id="movie_name" name="movie_name" required>

        <label for="duration">Duration (in minutes):</label>
        <input type="number" id="duration" name="duration" required min=0 max=360>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>

        <label for="relDate">Release Date:</label>
        <input type="date" id="relDate" name="relDate" required>

        <label for="movieDirector">Director:</label>
        <input type="text" id="movieDirector" name="movieDirector" required>

        <label for="movieActors">Actors:</label>
        <input type="text" id="movieActors" name="movieActors" required>

        <label for="seat_price">Seat Price:</label>
        <input type="number" id="seat_price" name="seat_price" required min=0 max=10000>

        <input type="submit" value="Add Movie">
    </form>
</body>
</html>
