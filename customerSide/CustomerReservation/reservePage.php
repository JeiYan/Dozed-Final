<?php
require_once '../config.php';

// Start the session
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">


    <title>Customer Reservation </title>
    <style>
        /* Apply background image to the body */
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('../image/bg_2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #F5F5F5; /* Creamy white text */
            display: flex;
            margin: 0;
            justify-content: center; /* Center the container horizontally */
            align-items: center; /* Center the container vertically */
            height: 100vh; /* Ensure the container takes up the full viewport height */
        }
        .reserve-container {
            max-width: auto;
            background-color: #3E2C23; /* Slightly lighter brown */
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        .column {
            padding: 10px;
            text-align: left;
            width: 36.4em;
            flex-basis: 50%; /* Adjust the width of the columns as needed */
           
        } 

        #insert-reservation-into-table {
    opacity: 0;
    max-height: 0;
    overflow: hidden;
    transition: opacity 0.6s ease, max-height 0.6s ease;
}

#insert-reservation-into-table.show {
    opacity: 1;
    max-height: 1000px; /* enough space for the full form */
}


/* Mobile Adjustments */
@media (max-width: 768px) {
    .row {
        flex-direction: column;
        align-items: center;
    }

    .column {
        width: 100%;
    }

    h1 {
        font-size: 2em;
    }
}
    </style>
</head>
<body>
    <?php
        $reservationStatus = $_GET['reservation'] ?? null;
        $message = '';
        if ($reservationStatus === 'success') {
            $message = "Reservation successful";
            $reservation_id = $_GET['reservation_id'] ?? null;
            echo '<a class="nav-link" href="../home/home.php#hero">' .
            '<h1 class="text-center" style="font-family: Copperplate; color: whitesmoke;">DOZED\'S</h1>' .
            '<span class="sr-only"></span></a>';
            
            echo '<script>
                alert("Table Successfully Reserved. Click OK to view your reservation receipt. You will be redirected back to home after 5 seconds.");
            window.location.href = "reservationReceipt.php?reservation_id=' . $reservation_id . '";
            
            // Set a timeout for redirection after 10 seconds
            setTimeout(function() {
                window.location.href = "../home/home.php#hero";
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>';
    }
        $head_count = $_GET['head_count'] ?? 1;
    ?>
    <div class="member-info"></div>
    <div class="reserve-container">
        <a class="nav-link" href="../home/home.php#hero">
        <h1 style="display: flex; align-items: center; justify-content: flex-start; font-family: Copperplate; color: #6B4F32; background-color: #F4E1D2; padding: 20px; border-radius: 10px; box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);">
    <a href="../home/home.php#hero" style="text-decoration: none; color: #6B4F32; font-size: 24px; margin-right: 15px;">
        &#8592;
    </a>
    <span style="flex-grow: 1; text-align: center;">Dozed: Booking Dashboard</span>
</h1><br>

            <span class="sr-only"></span>
        </a>

        <div class="row">
            <div class="column">
                <div id="Search Table">
                    <h2 style=" color:white;">Search for Time</h2>
                 
                    <form id="reservation-form" method="GET" action="availability.php"><br>
                        <div class="form-group">
                        <label for="reservation_date" style="">Select Date</label><br>
                        <input class="form-control" type="date" id="reservation_date" name="reservation_date" min="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="form-group">
                        <label for="reservation_time" style="">Available Reservation Times</label>
                        <div id="availability-table">
                            <?php
                            $availableTimes = array();
                            for ($hour = 9; $hour <= 20; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 60) {
                                    $time = sprintf('%02d:%02d:00', $hour, $minute);
                                    $dateTime = DateTime::createFromFormat('H:i:s', $time);
                                    $formattedTime = $dateTime->format('g:i A'); // 12-hour format with AM/PM
                                    $availableTimes[] = $formattedTime;
                                }
                            }
                            echo '<select name="reservation_time" id="reservation_time" style="width:10em;" class="form-control" >';
                            echo '<option value="" selected disabled>Select a Time</option>';
                            foreach ($availableTimes as $time) {
                                echo "<option  value='$time'>$time</option>";
                            }
                            echo '</select>';
                            if (isset($_GET['message'])) {
                                $message = $_GET['message'];
                                echo "<p>$message</p>";
                            }
                            ?>
                        </div>
                        </div>
              
                        <input type="number" id="head_count" name="head_count" value=1 hidden required>
                        <button type="submit" style="background-color: black; color: rgb(234, 234, 234); " class="btn" name="submit" >Search</button>
                    </form>
                </div>
            </div>

            <div class="column right-column">
            <div id="insert-reservation-into-table">
                    <h2 style=" color:white;">Make Reservation</h2>
                    <form id="reservation-form" method="POST" action="insertReservation.php">
                        <br>
                        <div class="form-group">
                            <label for="customer_name" style="">Customer Name</label><br>
                            <input class="form-control" type="text" id="customer_name" name="customer_name" required>
                        </div>
                        <?php
                            $defaultReservationDate = $_GET['reservation_date'] ?? date("Y-m-d");
                            // Convert the 12-hour format time to 24-hour format for the hidden input
                            $defaultReservationTime = "13:00:00"; // default value
                            if (isset($_GET['reservation_time'])) {
                                $time12 = $_GET['reservation_time'];
                                $time24 = date("H:i:s", strtotime($time12));
                                $defaultReservationTime = $time24;
                            }
                            ?>
                   
                        <div class="form-group " >
                            <label for="reservation_date" style="">Reservation Date</label><br>
                            <input type="date" id="reservation_date" name="reservation_date"
                                   value="<?= $defaultReservationDate ?>" readonly required>
                            <input type="time" id="reservation_time" name="reservation_time"
                                   value="<?= $defaultReservationTime ?>" readonly required>
                        </div>
                 
                        <div class="form-group">
                            <label for="table_id_reserve" style="">Available Tables</label>
                            <select class="form-control" name="table_id" id="table_id_reserve" style="width:10em;" required>
                                <option value="" selected disabled>Select a Table</option>
                                <?php
                                $table_id_list = $_GET['reserved_table_id'];
                                $head_count = $_GET['head_count'] ?? 1;
                                $reserved_table_ids = explode(',', $table_id_list);
                                $select_query_tables = "SELECT * FROM restaurant_tables WHERE capacity >= '$head_count'";
                                if (!empty($reserved_table_ids)) {
                                    $reserved_table_ids_string = implode(',', $reserved_table_ids);
                                    $select_query_tables .= " AND table_id NOT IN ($reserved_table_ids_string)";
                                }
                                $result_tables = mysqli_query($link, $select_query_tables);
                                $resultCheckTables = mysqli_num_rows($result_tables);
                                if ($resultCheckTables > 0) {
                                    while ($row = mysqli_fetch_assoc($result_tables)) {
                                        echo '<option value="' . $row['table_id'] . '">For ' . $row['capacity'] . ' people. (Table #' . $row['table_id'] . ')</option>';
                                    }
                                }  else {
                                    echo '<option disabled>No tables available, please choose another time.</option>';
                                    echo '<script>alert("No reservation tables found for the selected time. Please choose another time.");</script>';
                                }
                                ?>
                            </select>
                            <input type="number" id="head_count" name="head_count" value="<?= $head_count ?>" required hidden>
                        </div>
                 
                        <div class="form-group mb-3">
                            <label for="special_request">Special request</label><br>
                            <textarea class="form-control"  id="special_request" name="special_request"> </textarea><br>
                            <button type="submit" style="background-color: black; color: rgb(234, 234, 234); " class="btn" type="submit" name="submit">Make Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
window.onload = function () {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const minDate = `${yyyy}-${mm}-${dd}`;

    const viewDateInput = document.getElementById("reservation_date");
    const makeDateInput = document.querySelector("#insert-reservation-into-table input[name='reservation_date']");

    viewDateInput.setAttribute("min", minDate);

    // Check if URL has parameters and update the reservation form
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('reservation_date') || urlParams.has('reservation_time')) {
        const reservationSection = document.getElementById('insert-reservation-into-table');
        reservationSection.classList.add('show');
        
        if (urlParams.has('reservation_date')) {
            makeDateInput.value = urlParams.get('reservation_date');
        }
        
        if (urlParams.has('reservation_time')) {
            const timeInput = document.querySelector("#insert-reservation-into-table input[name='reservation_time']");
            // Convert 12-hour format to 24-hour format for the hidden input
            const time12 = urlParams.get('reservation_time');
            const [time, modifier] = time12.split(' ');
            let [hours, minutes] = time.split(':');
            if (modifier === 'PM' && hours !== '12') {
                hours = parseInt(hours, 10) + 12;
            }
            if (modifier === 'AM' && hours === '12') {
                hours = '00';
            }
            timeInput.value = `${hours}:${minutes}:00`;
        }
    }
};

// Show the reservation form when coming back from availability.php
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('reservation_date') || urlParams.has('reservation_time')) {
        const reservationSection = document.getElementById('insert-reservation-into-table');
        reservationSection.classList.add('show');
    }
});
</script>
</body>

</html>
