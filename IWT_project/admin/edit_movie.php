<?php
include 'config.php';

if (isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];

    $sql = "SELECT * FROM movie WHERE id = $movie_id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "Movie not found!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_name = $_POST['movie_name'];
    $duration = $_POST['duration'];
    $genre = $_POST['genre'];
    $relDate = $_POST['relDate'];
    $movieDirector = $_POST['movieDirector'];
    $movieActors = $_POST['movieActors'];
    $seat_price = $_POST['seat_price'];
    
    $img_src = $_POST['img_src'];
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

    // Update movie in the database
    $sql_update = "UPDATE movie SET 
        img_src='$img_src', 
        movie_name='$movie_name', 
        duration='$duration', 
        genre='$genre', 
        relDate='$relDate', 
        movieDirector='$movieDirector', 
        movieActors='$movieActors', 
        seat_price='$seat_price' 
        WHERE id = $movie_id";

    if ($con->query($sql_update) === TRUE) {
        echo "Movie updated successfully!";
        header("Location: admin.php"); 
        exit;
    } else {
        echo "Error updating record: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
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

        input[type="submit"], .edit-show-dates {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px; /* Add some space between buttons */
        }

        input[type="submit"]:hover, .edit-show-dates:hover {
            background-color: #45a049;
        }

        .img-preview {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }

        /* Additional styles for the Edit Show Dates button */
        .edit-show-dates {
            background-color: #007BFF; /* Blue color for the button */
        }

        .edit-show-dates:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <h1>Edit Movie</h1>

    <form method="POST" enctype="multipart/form-data">
        <label for="img_file">Movie Image:</label>
        <input type="file" id="img_file" name="img_file" accept="image/*">
        <img src="<?php echo '../' . $movie['img_src']; ?>" class="img-preview" alt="Current Image">
        <input type="hidden" name="img_src" value="<?php echo $movie['img_src']; ?>">

        <label for="movie_name">Movie Name:</label>
        <input type="text" id="movie_name" name="movie_name" value="<?php echo $movie['movie_name']; ?>" required>

        <label for="duration">Duration (in minutes):</label>
        <input type="number" id="duration" name="duration" value="<?php echo $movie['duration']; ?>" required min=0 max=360>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" value="<?php echo $movie['genre']; ?>" required>

        <label for="relDate">Release Date:</label>
        <input type="date" id="relDate" name="relDate" value="<?php echo $movie['relDate']; ?>" required>

        <label for="movieDirector">Director:</label>
        <input type="text" id="movieDirector" name="movieDirector" value="<?php echo $movie['movieDirector']; ?>" required>

        <label for="movieActors">Actors:</label>
        <input type="text" id="movieActors" name="movieActors" value="<?php echo $movie['movieActors']; ?>" required>

        <label for="seat_price">Seat Price:</label>
        <input type="number" id="seat_price" name="seat_price" value="<?php echo $movie['seat_price']; ?>" required min=0 max=10000>

        <input type="submit" value="Update Movie">
        <button type="button" class="edit-show-dates" onclick="window.location.href='edit_show_dates.php?movie_id=<?php echo $movie_id; ?>'">Edit Show Dates and Time</button>
    </form>
</body>
</html>
