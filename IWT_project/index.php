<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container">
        <h1 class="logo">Movie Booking</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#movies_section" class="scroll-link">Movies</a></li>
                <li><a href="#">Booking</a></li>
            </ul>
            <div class="user-auth">
                <?php if (isset($_SESSION['username'])): ?>
                    <p> Welcome, <?php echo $_SESSION['username']; ?> </p>
                    <button onclick="signOut()" class="user-btn">Sign Out</button>
                <?php else: ?>
                    <a href="login.html" class="sign-in-btn">Sign In</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>


<section class="hero">
    <div class="container">
        <h2>Book Your Favorite Movie Tickets Now!</h2>
        <p>Experience the best movie watching experience in theaters near you.</p>
    </div>
</section>

<section class="movies-section" id="movies_section">
    <div class="container">
        <h2>Now Showing</h2>
        <div class="movies-wrapper">
            <div class="movies-container">
                
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "sanskar";
                $db = "iwt_project";
                $conn = new mysqli($servername, $username, $password, $db);
                if ($conn->connect_error) {
                    die("Connection failed: ". $conn->connect_error);
                }
                $sql = "SELECT * FROM movie";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo '<div class="movie-box">';
                    echo '<img src="'.$row['img_src'].'" alt="'.$row['movie_name'].'" >';
                    echo '<div class="movie-info ">';
                    echo '<a href="bookings.php?id='.$row['id'].'" class="book-btn">Book Ticket</a>';
                    echo '<h3>'.$row['movie_name'].'</h3>';

                    $Duration =  $row['duration'];
                    $hours = floor($Duration / 60); 
                    $minutes = $Duration % 60; 
                    if ($minutes == 0){
                        $duration = $hours.'h';
                    }
                    else {
                        $duration = $hours.'h '.$minutes.'min';
                    }
                    echo '<p>'.$row['genre'].' | '.$duration.'</p>';
                    echo '</div>';
                    echo '</div>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <p>&copy;Movie Booking | By Sanskar</p>
    </div>
</footer>

</body>
<script>
    document.querySelectorAll('.scroll-link').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault(); 
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            targetElement.scrollIntoView({
                behavior: 'smooth'  // Smooth scroll effect
            });
        });
    });

    function signOut() {
    if (confirm("Are you sure you want to sign out?")) {
        window.location.href = "logout.php"; 
    }
    }

</script>
</html>
