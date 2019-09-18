<?php 
// this function render the number of days between two date
function dateDiff ($d1, $d2) {

    // Return the number of days between the two dates:    
    return round(abs(strtotime($d1) - strtotime($d2))/86400);
    
    }

// this function will calculate the price according to the choosen hotel
function calculatePrice($hotel,$numberOfdays){
    $price1 = 1200;
    $price2 = 1500;
    $price3 = 1600;
    $price4 = 1700;

    switch($hotel){
        case "CAPE GRACE, CAPE TOWN";
        return "R" .$price1 * $numberOfdays ;
        break;

        case "FOUR SEASONS HOTEL THE WESTCLIFF, JOHANNESBURG";
        return "R" .$price2 * $numberOfdays  ;
        break;

        case "KAPAMA KARULA, HOEDSPRUIT";
        return "R".$price3 * $numberOfdays ;
        break;

        case "MONT ROCHELLE, FRANSCHHOEK";
        return "R" .$price4 * $numberOfdays ;
        break;

        default :
        echo "no hotel selected";

    }
}
function checkforduplicates(){
    // if(isset($_POST['booking'])){
    //     $row = mysqli_fetch_assoc($result);
    //     if ($result->num_rows > 0) {
    //         $row['id'];
    //         $row['firstName'];
    //         $row['lastName'];
    //         $row['checkin'];
    //         $row['checkout'];
    //         $row['numberofdays'];
    //         $row['totalprice'];
    //       }
    //     } 
    }

?>
