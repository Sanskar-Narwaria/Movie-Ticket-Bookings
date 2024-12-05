<!DOCTYPE html>
<html lang="en">
<?php
$id = $_GET['id'];

if ((!$_GET['id'])) {
    echo "<script>alert('You are Not Suppose to come Here Directly');window.location.href='index.php';</script>";
}
include "connections.php";
$movieQuery = "SELECT * FROM movie WHERE id = $id";
$movieDetailsById = mysqli_query($con, $movieQuery);
$row = mysqli_fetch_array($movieDetailsById);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style_bookings.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Book
        <?php echo $row['movie_name']; ?> Now
    </title>

</head>

<body style="background-color:#4B527E;">
    <div class="booking-panel">
        <div class="booking-panel-section booking-panel-section1">
            <h1>RESERVE YOUR TICKET</h1>
        </div>
        <div class="booking-panel-section booking-panel-section2" onclick="window.history.go(-1); return false;">
            <i class="fas fa-2x fa-times"></i>
        </div>
        <div class="booking-panel-section booking-panel-section3">
            <div class="movie-box">
                <?php
                echo '<img src="' . $row['img_src'] . '" alt="'.$row['movie_name'].'">';
                
                ?>
            </div>
        </div>
        <div class="booking-panel-section booking-panel-section4">
            <div class="title">
                <?php echo $row['movie_name']; ?>
            </div>
            <div class="movie-information">
                <table>
                    <tr>
                        <td>GENRE</td>
                        <td>
                            <?php echo $row['genre']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>DURATION</td>
                        <td>
                            <?php                   
                            $Duration =  $row['duration'];
                            $hours = floor($Duration / 60); 
                            $minutes = $Duration % 60; 
                            if ($minutes == 0){
                                $duration = $hours.'h';
                            }
                            else {
                                $duration = $hours.'h '.$minutes.'min';
                            }
                            echo $duration;
                                 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>RELEASE DATE</td>
                        <?php
                        $date = new DateTime($row['relDate']);
                        $year = $date->format('Y');
                        $month = $date->format('F');
                        $day = $date->format('d');
                        $fullDate = $day.'-'.$month.'-'.$year;
                        ?>
                        <td>
                            <?php echo $fullDate;?>
                        </td>
                    </tr>
                    <tr>
                        <td>DIRECTOR</td>
                        <td>
                            <?php echo $row['movieDirector']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ACTORS</td>
                        <td>
                            <?php echo $row['movieActors']; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="booking-form-container">
                <form action="seat_selection.php" method="POST" onsubmit="return validateForm();">
                    <select name="date" id="date_select" required>
                        <option value="" disabled selected>DATE</option>
                        <!--<option value="12-03-2019">12-March-2019</option>
                        <option value="13-03-2019">13-March-2019</option>
                        <option value="14-03-2019">14-March-2019</option>
                        <option value="15-03-2019">15-March-2019</option>
                        <option value="16-03-2019">16-March-2019</option> -->
                        <?php
                        $dateQuery = "SELECT DISTINCT DATE_FORMAT(show_date, '%d-%m-%Y') AS date FROM showtimes WHERE movie_id = $id order by show_date";
                        $result = $con->query($dateQuery);
                        while ($row_new = $result->fetch_assoc()) {

                            echo '<option value="'.$row_new['date'].'">'.$row_new['date'].'</option>';
                        }
                        
                        ?>

                    </select>

                    <select name="time" id="time_select" required>
                        <option value="" disabled selected>TIME</option>
                        <!-- <option value="09-00">09:00 AM</option>
                        <option value="12-00">12:00 AM</option>
                        <option value="15-00">03:00 PM</option>
                        <option value="18-00">06:00 PM</option>
                        <option value="21-00">09:00 PM</option>
                        <option value="24-00">12:00 PM</option> -->

                    </select>

                    <input placeholder="First Name" type="text" name="fName" required>
                    <input placeholder="Last Name" type="text" name="lName">
                    <input placeholder="Phone Number" type="text" name="pNumber" required>
                    <input placeholder="Email" type="email" name="email" required>

                    <input type="hidden" name="movie_id" id="movie_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="movie_name" value="<?php echo $row['movie_name']; ?>">
                    <input type="hidden" name="movie_price" value="<?php echo $row['seat_price']; ?>">


                    <button type="submit" value="save" name="submit" class="form-btn">Book a seat</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function validateEmail() {
        const email = document.querySelector('input[name="email"]').value;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }
        return true;
    }

    function validatePhoneNumber() {
        const phone = document.querySelector('input[name="pNumber"]').value;
        const phonePattern = /^[0-9]{10}$/;
        if (!phonePattern.test(phone)) {
            alert("Please enter a valid 10-digit phone number.");
            return false;
        }
        return true;
    }

    function validateForm() {
        return validateEmail() && validatePhoneNumber();
    }
    let movieId = document.getElementById('movie_id').value;
   


    document.getElementById('date_select').addEventListener('change', function () {
        let selectedDate = this.value;

        let formData = new FormData();
        formData.append('selected_date', selectedDate);
        formData.append('movie_id', movieId);

        fetch('get_times.php', {
            method: 'POST',
            body: new URLSearchParams(formData),
        })
            .then(response => response.text())  // Get raw response as text
            .then(data => {
                console.log('Raw response:', data);  // Log the raw response
                try {
                    let parsedData = JSON.parse(data);  // Attempt to parse JSON
                    let timeSelect = document.getElementById('time_select');
                    timeSelect.innerHTML = '<option value="" disabled selected>TIME</option>';

                    parsedData.forEach(time => {
                        let option = document.createElement('option');
                        option.value = time;
                        option.textContent = time;
                        timeSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            })
            .catch(error => console.error('Fetch error:', error));
    });







</script>

</html>