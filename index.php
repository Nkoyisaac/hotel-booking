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
<div class="box1" >
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <!-- input for the first name -->
        <label for="inputName">
            First Name: <br>
            <input width="100px" type="text" name="firstName" size="70" >
        </label><br>
        <!-- input for the last name -->
        <label for="lastName">
            Last Name: <br>
            <input type="text" name="lastName" size="70">
        </label><br>
        <!-- select option for hotel -->
        <label for="select">
        Choose the Hotel: <br>
        <select name="hotels" id="">
        
            <option value="">CAPE GRACE, CAPE TOWN.</option>
            <option value="">FOUR SEASONS HOTEL THE WESTCLIFF, JOHANNESBURG</option>
            <option value="">KAPAMA KARULA, HOEDSPRUIT</option>
            <option value="">MONT ROCHELLE, FRANSCHHOEK</option>
        </select>
        </label><br>
        
        <!-- input for the date -->
        <label for="date">
            Starting date: <br>
            <input type="date" name="start" id="" ><br>
            Last Date: <br>
            <input type="date" name="end" id="" >
        </label><br>
        <!-- submit button -->
        <button type="submit" name="submit" >submit</button>
    </form>
    </div>
    <div class="box2">
    <?php
    if(isset($_POST['submit'])){
        $firstName = $_POST['firstName'];
        //echo $firstName;
        $lastName = $_POST['lastName'];
        //echo $lastName;
        $hotel = $_POST['hotels'];
        //echo $hotel;
        $checkin = $_POST['start'];
        //echo $checkin;
        $checkout = $_POST['end'];
        //echo $checkout;
    } 
    
    
    
    
    
    
    ?>
    </div>
    </section>
</body>
</html>