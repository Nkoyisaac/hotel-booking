<?php 
include("function.php");
?>
<?php

$servername = "localhost";
$username = "Isaac";
$password = "Nkoy1995";
$database = "hotelbooking";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

// creating the table
$table = "CREATE TABLE IF NOT EXISTS booking(
    id INT(4)UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(64),
    lastName VARCHAR(64),
    hotel VARCHAR(64),
    checkin TIMESTAMP(6),
    checkout TIMESTAMP(6),
    numberofdays VARCHAR(64),
    totalprice VARCHAR(64))";

if (!mysqli_query($conn, $table)) {
    echo "Error creating table: " . mysqli_error($conn);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- bootsrap link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--  css/link  -->
    <link rel="stylesheet" href="css/style.css">
    
    <title>Hotel booking form</title>

</head>
<body >
<h1>Book hotel in affordable prices</h1>
<section>
<div class="box1">
    
    <form class="form-group formula" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <!-- input for the first name -->
        <label for="inputName">
            First Name: <br>
            <input  class="form-control" type="text" name="firstName" size="60" >
        </label><br>
        <!-- input for the last name -->
        <label for="lastName">
            Last Name: <br>
            <input class="form-control" type="text" name="lastName" size="60">
        </label><br>
        <!-- select option for hotel -->
        <label for="select">
        Choose the Hotel: <br>
        <select name="hotels" id="" class="custom-select">        
            <option value="CAPE GRACE, CAPE TOWN">CAPE GRACE, CAPE TOWN.   R1200/day</option>
            <option value="FOUR SEASONS HOTEL THE WESTCLIFF, JOHANNESBURG">FOUR SEASONS HOTEL THE WESTCLIFF, JOHANNESBURG   R1500/day</option>
            <option value="KAPAMA KARULA, HOEDSPRUIT">KAPAMA KARULA, HOEDSPRUIT   R1600/day</option>
            <option value="MONT ROCHELLE, FRANSCHHOEK">MONT ROCHELLE, FRANSCHHOEK    R1700/day</option>
        </select>
        </label><br>
        
        <!-- input for the date -->
        <label for="date">
            Starting date: <br>
            <input class="form-control" type="date" name="start" id="" ><br>
            Last Date: <br>
            <input class="form-control" type="date" name="end" id="" >
        </label><br>
        <!-- submit button -->
        <button class='btn btn-primary' type="submit" name="submit-booking" >submit</button>
     </form>
</div>
    <div class="box2">
    <?php

    if(isset($_POST['submit-booking'])){
        if (!isset($_POST['booking'])) {
            $firstName = $_POST['firstName'];
            //echo $firstName;
            $lastName = $_POST['lastName'];
            //echo $lastName;
            $hotel = $_POST['hotels'];
            //echo $hotel;
            $checkin = $_POST['start'] !== '' ? date('Y-m-d', strtotime($_POST['start'])) : 'Not selected';
            //echo $checkin;
            $checkout = $_POST['end'] !== '' ? date('Y-m-d', strtotime($_POST['end'])) : 'Not selected';
            //echo $checkout;
            $numberOfdays = dateDiff($checkin, $checkout);
            // echo $numberOfdays; 
            $totalprice = calculatePrice($hotel,$numberOfdays);           
    ?>
    <!-- the form bellow will display the information and send it to the database -->
        <form class='form-group' style='display: block;padding: 15px;' method='POST'>
            <p>
                Firstname: <?php echo $firstName; ?>
                <input type="hidden" value='<?php echo $firstName; ?>' name='first-name'>
            </p>
            <p>
                Lastname: <?php echo $lastName; ?>
                <input type="hidden" value='<?php echo $lastName; ?>' name='last-name'>
            </p>
            <p>
                Hotel: <?php echo $hotel; ?>
                <input type="hidden" value='<?php echo $hotel; ?>' name='hotel'>
            </p>
            <p>
                CheckIn at: <?php echo $checkin; ?>
                <input type="hidden" value='<?php echo $checkin; ?>' name='checkin'>
            </p>
            <p>
                CheckOut at: <?php echo $checkout; ?>
                <input type="hidden" value='<?php echo $checkout; ?>' name='checkout'>
            </p>
            <p>
                Number of days: <?php echo $numberOfdays; ?>
                <input type="hidden" value='<?php echo $numberOfdays; ?>' name='days'>
            </p>
            <p>
                Total price: <?php echo $totalprice; ?>
                <input type="hidden" value='<?php echo $totalprice; ?>' name='total'>
            </p>
            <input type='hidden' value='' name='submit-booking'>
            <input type="hidden" name='booking'>
            <button type='submit' class='btn btn-primary' name='booking'>
                confirm booking
            </button>
        </form>
    <?php
        }else{
        // Run mysql query in here to save the information into the database/.
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $days = $_POST['days'];
        $total = $_POST['total'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $hotel = $_POST['hotel'];

        // checking for duplicate
        $duplicates = "SELECT * FROM bookings WHERE firstName = '$firstName' AND lastName = '$lastName' AND hotel = '$hotel' AND checkin = '$checkin' AND checkout = '$checkout'";
        $results = $conn -> query($duplicates);
        if(isset($_POST['booking'])){
            if ($results->num_rows > 0) {
                $row = mysqli_fetch_assoc($results);
                $row_firstName = $row['firstName'];
                $row_hotel = $row['hotel'];
                $row_checkin = $row['checkin'];
                $row_checkout = $row['checkout'];

                ?>
                    <div class="box3">
                        <h1>
                            A duplicate booking was found.
                        </h1>
                        <?php
                        echo "<p> dear $row_firstName you have already booked at:</p> 
                        <ul class=\"box3\">
                            <li>Hotel:$row_hotel</li>
                            <li>from:$row_checkin</li>
                            <li>To:$row_checkout</li>
                        </ul>";
                        ?>
                    </div>
                <?php
                return;
              }
            } 


        // inserting values in the database table
        $query = "INSERT INTO bookings (firstName, lastName, hotel, checkin, checkout, numberofdays, totalprice) 
        VALUES ('$firstName', '$lastName', '$hotel', '$checkin', '$checkout', '$days', '$total')";

        if (!mysqli_query($conn, $query)) {
            echo mysqli_error($conn);
            exit('UNable to create booking.');
        }

        header("Location: ?action=successful");

       
       
           
       
       
    ?>
      
    <?php
            }
        }
        if (isset($_GET['action'])) {
            echo "<h1> Booking Confirmed</h1>";
      
        }
    ?>
    <?php 
     

     
    
    
    ?>

    </div>
    </section>
</body>
</html>