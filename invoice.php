<?php
    if(isset($_GET['bookingno']))
    {
        $sql = "SELECT *, DATE(BusDateTime) AS ScheduleDate FROM s900_database.booking
        RIGHT JOIN s900_database.bus_schedule ON s900_database.booking.ScheduleNo = s900_database.bus_schedule.ScheduleNo 
        RIGHT JOIN s900_database.account ON s900_database.booking.AccountNo = s900_database.account.AccountNo 
        WHERE BookingNo = ".$_GET['bookingno'];
        $query = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($query);

        if($row)
        {
            $bookingNo = $row['BookingNo'];
            $purchasedDate = $row['BookingTimestamp'];
            $bookingDate = $row['BusDateTime'];
            $firstName = $row['FirstName'];
            $lastName = $row['LastName'];
            $email = $row['Email'];
            $quantity = $row['Quantity'];
            $ticketPrice = $row['TicketPrice'];
            $depart = $row['ScheduleDepart'];
            $arrive = $row['ScheduleArrive'];
            $seatNo = $row['BusSeat'];
            $bookingStatus = $row['BookingStatus'];
            $totalamount = number_format((float)$quantity*$ticketPrice, 2, '.', '');
        }
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="css/invoice.css" rel="stylesheet">
</head>

<body>
    <div class="invoice-box" id="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="images/logo_black.png" style="width:20%; max-width:300px;">
                            </td>
                            
                            <td><?php
      if($bookingStatus == "Completed")
            echo '
            <h3 style="color: #588da8">Completed</h3>
        ';
        else if($bookingStatus == "Cancelled")
        echo '
        <h3 style="color: #d8345f">Cancelled</h3>
    ';
    ?>
                                <p><small>Butuh Bantuan? Hubungi: +62-8123456789<br>Email: support@PindoTransport.com</small></p>
                            </td>
                            
                        </tr>
                        
                    </table>
                </td>
            </tr>
            
            <!-- Trip Details -->
            <tr class="heading">
                <td>
                    DETAIL PERJALANAN
                </td>
                
                <td>
                    
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Pindo Transport
                </td>
                <td>
                    <?=$depart." > ".$arrive?>
                    <br>
                    <?=$bookingDate?>
                </td>
            </tr>

            <!-- Boarding Dropping -->
            <tr class="heading">
                <td>
                    DETAIL PENUMPANG
                </td>
                
                <td>
                    
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    <?=$firstName." ".$lastName?>
                    <p><small>Data Penumpang</small></p>
                </td>
                <td>
                    <?=$seatNo?>
                    <p><small>No Kursi</small></p>
                </td>
            </tr>
            <tr class="item">
                <td>
                    <?=$bookingNo?>
                    <br>
                    <p><small>No Pesanan</small></p>
                </td>
                <td>
                    <?=$bookingDate?>
                    <br>
                    <p><small>Waktu Keberangkatan</small></p>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    DETAIL KONTAK
                </td>
                <td>
                    
                </td>
            </tr>
            
            <tr class="item">
                <td>
                <?=$email?>
                    <p><small>Email</small></p>
                </td>
                
                <td>
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                <td>
                Total Harga: Rp<?=$totalamount?>
                </td>
            </tr>
        </table>
        <?php
            if($bookingStatus != "Confirmed")
            {
                echo '<br>';
                echo '<p style="text-align:center;">Thank you for choosing <strong>blueBus</strong>!</p>';
            }
            else
            {
                echo '<p style="text-align:center;"><img src="https://api.qrserver.com/v1/create-qr-code/?data='.$bookingNo.'&amp;size=100x100" alt="'.$bookingNo.'" title="" /></p>';
                echo '<p><strong>Peringatan:</strong> <small>Pelanggan disarankan untuk menunjukkan cetakan tiket ini beserta bukti identitas untuk menukarkan boarding pass.</small></p>';
            }
        ?>
        
    </div>
</body>
</html>
