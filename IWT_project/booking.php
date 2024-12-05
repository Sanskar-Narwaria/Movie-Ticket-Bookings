<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking</title>
    <link rel="stylesheet" href="style_booking.css">

</head>

<body>

    <div class="container">
        <div class="movie-info">
            <h2>Selected Movie: <span id="movie-name">Animal</span></h2>
        </div>

        <div class="booking-form">
            <h3>Select Date and Time</h3>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date">
            </div>

            <div class="form-group">
                <label for="time">Time</label>
                <select id="time" name="time">
                    <option value="10:00 AM">10:00 AM</option>
                    <option value="1:00 PM">1:00 PM</option>
                    <option value="4:00 PM">4:00 PM</option>
                    <option value="7:00 PM">7:00 PM</option>
                    <option value="10:00 PM">10:00 PM</option>
                </select>
            </div>

            <div class="seat-selection">
                <h3>Select Seats</h3>
            <div class="screen">Screen</div>
            </div>
        </div>

        <a href="#" class="btn">Proceed to Payment</a>
    </div>

    <script>
        window.onload = () => {
            let frame = document.querySelector('.seat-selection');
            let index = 1;

            
            for (let i = 0; i < 6; i++) {
                let outerDiv = document.createElement('div');
                outerDiv.className = 'seats-row';

                for (let j = 0; j < 22; j++) {
                    let seat = document.createElement('div');
                    seat.className = 'seat';
                    seat.textContent = index;

                    
                    seat.addEventListener('click', () => {
                        seat.classList.toggle('selected');
                    });

                    outerDiv.appendChild(seat);
                    index++;
                }

                frame.appendChild(outerDiv);
            }
        };
        let date = document.getElementById('date');
        let time = document.getElementById('time');
        time.addEventListener('change', () => {
            console.log(time.value);
        }
        )



    </script>

</body>

</html>