<?php

 require("loginheader.php");
 $accountno = $_SESSION['id'];
        $PaymentType = $_POST['PaymentType'];
        $CardName = $_POST['CardName'];
        $CardNumber = $_POST['CardNumber'];
        $CardExpiration = $_POST['ExpireMonth'].$_POST['ExpireYear'];
        $cvv = $_POST['CVV'];

        $bookingno = rand();
        if($_GET['PromoCode'])
        $promocode = $_GET['PromoCode'];
        else
        $promocode = "none";
        $scheduleno = $_GET['scheduleno'];
        $quantity = 1;
        $seatno = $_GET['seatno'];
        $busdatetime = $_GET['inputdate'];
        $bookingstate = "Confirmed";
    
        $insertPayment =  mysqli_query($con,"INSERT INTO payment (PaymentType,CardName,CardNumber,CardExpiration,CVV,AccountNo)
        VALUES('$PaymentType', '$CardName', $CardNumber, '$CardExpiration',$cvv,$accountno)");

        
        $sql = "SELECT PaymentNo FROM payment WHERE AccountNo =".$accountno." ORDER BY PaymentNo DESC LIMIT 1";
        $query = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($query);
        if($row)
        {
            $PaymentNo = $row['PaymentNo'];
        }
        
        echo "INSERT INTO booking (BookingNo,AccountNo,PromoCode,ScheduleNo,Quantity,BusSeat,BusDateTime,BookingStatus,PaymentNo)
        VALUES('$bookingno','$accountno','$promocode', '$scheduleno', '$quantity', '$seatno', '$busdatetime', '$bookingstate', '$PaymentNo')";
        $insertBooking =  mysqli_query($con,"INSERT INTO booking (BookingNo,AccountNo,ScheduleNo,Quantity,BusSeat,BusDateTime,BookingStatus,PaymentNo)
        VALUES('$bookingno','$accountno', '$scheduleno', '$quantity', '$seatno', '$busdatetime', '$bookingstate', '$PaymentNo')");

        header('Location: managebooking.php');
?>