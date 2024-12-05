<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking</title>
    <link rel="stylesheet" href="style_seat_selection.css">
</head>

<body>

    <div class="container">
        <form action="payment.php" method="POST" id="bookingForm">
            <div class="movie-info">
                <?php
                if (isset($_POST['submit'])) {
                    $movie_name = $_POST['movie_name'];
                    $email = $_POST['email'];
                    $fname = $_POST['fName'];
                    $lname = $_POST['lName'];
                    $cust_name = $fname . ' ' . $lname;
                    $phone_number = $_POST['pNumber'];
                    $movie_date = $_POST['date'];
                    $movie_time = $_POST['time'];
                    $movie_id = $_POST['movie_id'];
                    $movie_price = $_POST['movie_price'];
                }
                ?>
                <h2>Selected Movie: <span id="movie-name"><?php echo $movie_name ?></span></h2>
                <p>Customer Name: <span id="customer-name"><?php echo $cust_name ?></span></p>
                <p>Email: <span id="email"><?php echo $email ?></span></p>
                <p>Phone Number: <span id="phone-number"><?php echo $phone_number ?></span></p>
                <p>Movie Date: <span id="movie-date"><?php echo $movie_date ?></span></p>
                <p>Movie Time: <span id="movie-time"><?php echo $movie_time ?></span></p>
                <p>Seat Price: <span id="movie-price"><?php echo $movie_price ?></span></p>
                <p>Total Price: <span id="total-price">0</span></p>

                <input type="hidden" name="movie_name" value="<?php echo $movie_name ?>">
                <input type="hidden" name="customer_name" value="<?php echo $cust_name ?>">
                <input type="hidden" name="email" value="<?php echo $email ?>">
                <input type="hidden" name="phone_number" value="<?php echo $phone_number ?>">
                <input type="hidden" name="movie_date" value="<?php echo $movie_date ?>">
                <input type="hidden" name="movie_time" value="<?php echo $movie_time ?>">
                <input type="hidden" name="movie_id" value="<?php echo $movie_id ?>">
                <input type="hidden" name="movie_price" value="<?php echo $movie_price ?>">
                <input type="hidden" name="total_amount" id="tol_amt">
            </div>

            <?php
            include "connections.php";
            $date = explode("-", $_POST['date']);
            $time = explode(":", $_POST['time']);
        
            $show_time = $date[2] . '-' . $date[1] . '-' . $date[0] . ' ' . $time[0] . ':' . $time[1] . ':00';

            // Fetch the reserved seats from the database
            $sql = 'SELECT seats FROM bookings WHERE show_time = "' . $show_time . '" AND movie_name = "' . $movie_name . '"';
            $result = $con->query($sql);
            $seat_numbers = [];
            while ($row = $result->fetch_assoc()) {
                $seat_numbers = array_merge($seat_numbers, explode(',', $row['seats']));
            }
            // Convert PHP array to a JavaScript array
            $con->close();
            ?>

            <div class="seat-selection">
                <h3>Select Seats</h3>
                <div class="screen">Screen</div>
            </div>

            <div class="seat-legend">
                <span class="seat available"></span> Available
                <span class="seat reserved"></span> Reserved
            </div>

            <input type="hidden" name="selected_seats" id="selectedSeatsInput">

            <button type="submit" class="booking_btn" name="confirm_booking">Confirm Booking</button>

        </form>
    </div>

    <script>
        window.onload = () => {
            let frame = document.querySelector('.seat-selection');
            let index = 1;
            let totalPrice = 0;
            let seatPrice = <?php echo $movie_price; ?>;
            let totalPriceElement = document.getElementById('total-price');
            let total_amount = document.getElementById('tol_amt');

            // Reserved seats passed from PHP to JavaScript
            let reservedSeats = <?php echo json_encode($seat_numbers); ?>;

            for (let i = 0; i < 6; i++) {
                let outerDiv = document.createElement('div');
                outerDiv.className = 'seats-row';

                for (let j = 0; j < 22; j++) {
                    let seat = document.createElement('div');
                    seat.className = 'seat';
                    seat.textContent = index;

                    // Check if the seat is in the reservedSeats array
                    if (reservedSeats.includes(seat.textContent)) {
                        seat.classList.add('reserved');
                        seat.style.backgroundColor = 'red'; // Mark reserved seat as red
                        seat.setAttribute('disabled', 'true'); // Disable click event
                    } else {
                        // Handle click event for available seats
                        seat.addEventListener('click', () => {
                            seat.classList.toggle('selected');

                            if (seat.classList.contains('selected')) {
                                totalPrice += seatPrice;
                            } else {
                                totalPrice -= seatPrice;
                            }

                            totalPriceElement.textContent = totalPrice.toFixed(2);
                            total_amount.value = totalPrice.toFixed(2);
                        });
                    }

                    outerDiv.appendChild(seat);
                    index++;
                }

                frame.appendChild(outerDiv);
            }
        };

        let form = document.getElementById('bookingForm');
        form.addEventListener('submit', (event) => {
            let selectedSeats = document.querySelectorAll('.seat.selected');
            let selectedSeatNumbers = Array.from(selectedSeats).map(seat => seat.textContent);

            document.getElementById('selectedSeatsInput').value = selectedSeatNumbers.join(',');
        });
    </script>

</body>

</html>
