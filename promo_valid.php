<?php
 require("db.php");

 $seatno = $_GET["seatno"];
 $inputDepartDate = $_GET['inputdate'];
 $scheduleno1 = $_GET['scheduleno'];
 $TicketPrice = $_GET['TicketPrice'];
 
     if(isset($_POST['Reedem'])){
        $PromoCode = $_POST['PromoCode'];
        $promo = mysqli_query($con,"SELECT * FROM promo_code WHERE PromoCode = '$PromoCode' ");
        $rows = mysqli_num_rows($promo);
    	if ($rows==1){
	    while($rs = mysqli_fetch_array($promo)){
            $valid = $rs['PromoCode']; // kode promo
            $ScheduleNo = $rs['ScheduleNo']; // nomor jadwal
            $promopercentage = $rs['PromoPercentage']; // persentase diskon
        }
       }

        // Pastikan $promopercentage adalah angka sebelum digunakan dalam perhitungan
        $promopercentage = floatval($promopercentage);
        $TicketPrice = floatval($TicketPrice);

        // Periksa apakah PromoCode valid dan sesuai dengan ScheduleNo
        if($PromoCode==$valid && $scheduleno1 == $ScheduleNo ){
            // Menghitung harga total setelah diskon
            $TotalPrice = $TicketPrice - ($TicketPrice * $promopercentage / 100);
            header("location: payment.php?seatno=".$seatno."&inputdate=".$inputDepartDate."&scheduleno=".$scheduleno1."&PromoCode=".$PromoCode."&TicketPrice=".$TotalPrice);
        }
        else {
            echo "Invalid Code";
        }
    }
?>
