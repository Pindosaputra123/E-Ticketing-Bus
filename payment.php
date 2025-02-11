<?php
    require("loginheader.php");
    if($_GET['seatno']=="" || $_GET['inputdate']=="" || $_GET['TicketPrice']=="" || $_GET['scheduleno']==""){
      header("location:searchbus.php");
    }
    if($_GET['PromoCode']=="none" ){
      $promopercent = 0;
    }
        
        $sql = "SELECT *
        FROM bus_schedule
        LEFT JOIN bus ON bus_schedule.BusNo = bus.BusNo 
        WHERE ScheduleNo =".$_GET['scheduleno'];
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($query);

    if($row)
    {
        $BusCompany = $row['BusCompany'];
        $scheduleno = $row['ScheduleNo'];
        $busno = $row['BusNo'];
        $inputFrom = $row['ScheduleDepart'];
        $inputTo = $row['ScheduleArrive'];
        $inputTime = $row['ScheduleStartTime'];
        $ScheduleDuration = $row['ScheduleDuration'];
        $TicketPrice = $row['TicketPrice'];
    }

    $seatno = $_GET["seatno"];
        $inputDepartDate = $_GET['inputdate'];
        if(isset($_GET['PromoCode']))
        {
          $promocode = $_GET['PromoCode'];

          $sql = "SELECT * FROM promo_code WHERE PromoCode ='".$promocode."'";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($query);

    if($row)
    {
        $promopercent = $row['PromoPercentage'];
    }
    $TotalPrice = $TicketPrice - ($TicketPrice * ($promopercent/100));
  }
        else
        {
          $promocode = "";
          $TotalPrice = $TicketPrice;
        }
          

    
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Pindo Transport - Pembayaran</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
    <link href="css/form-validation.css" rel="stylesheet">

    <!-- Aos.js -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  </head>

  <body class="bg-light">
 <!-- HEADER-->
 <?php
    include('assets/header.php');
  ?>
    <div class="container">
      <div class="py-5 text-center">
        <h2>Hampir Selesai!</h2>
        <p class="lead">Harap baca rincian pemesanan Anda dengan jelas sebelum melakukan pembayaran.</p>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Detail Pemesanan Anda</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed" style="border:0px">
              <div>
                <h6 class="my-0">Nama Bus</h6>
              </div>
              <span class="text-muted"><?php echo"$BusCompany"; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed" style="border:0px">
              <div>
                <h6 class="my-0">No Bus</h6>
              </div>
              <span class="text-muted"><?php echo"$busno"; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed " style="border:0px">
              <div>
                <h6 class="my-0">Keberangkatan</h6>
              </div>
              <span class="text-muted"><?php echo"$inputFrom"; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed" style="border:0px">
              <div>
                <h6 class="my-0">Tujuan</h6>
              </div>
              <span class="text-muted"><?php echo"$inputTo"; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed" style="border:0px">
              <div>
                <h6 class="my-0">Durasi</h6>
              </div>
              <span class="text-muted"><?php echo"$ScheduleDuration"; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed " style="border:0px">
              <div>
                <h6 class="my-0">No Kursi</h6>
              </div>
              <span class="text-muted"><?php echo"$seatno"; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed" >
              <div>
                <h6 class="my-0">Harga Tiket</h6>
              </div>
              <span class="text-muted"><?php echo"$TicketPrice"; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Kode Promo</h6>
              </div>
              <span class="text-success"><?=$promocode?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (Rp)</span>
              <strong><?php echo"$TotalPrice"; ?></strong>
            </li>
          </ul>

          <form class="card p-2" action = "promo_valid.php?seatno=<?=$_GET['seatno']?>&inputdate=<?=$_GET['inputdate']?>&scheduleno=<?=$_GET['scheduleno']?>&TicketPrice=<?=$_GET['TicketPrice']?>" method="POST">
            <div class="input-group">
              <input type="text" class="form-control" name="PromoCode" placeholder="Kode Promo">
              <div class="input-group-append">
                <button type="submit" name="Reedem" class="btn btn-secondary">Tukar</button>
              </div>
            </div>
            </form>
        </div>
        <div class="col-md-8 order-md-1">
        <div class="row">
        
              <div class="col-md-6 mb-3">
              <div class="media text-muted pt-3">
              <img src="images/calendar.png" alt="" class="mr-2 rounded" style="width:10%; max-width:25px;">
                <label for="cc-name">Tanggal</label>
                </div>
                <strong><?php echo"$inputDepartDate";?></strong>
              </div>
              <div class="col-md-6 mb-3">
              <div class="media text-muted pt-3">
              <img src="images/clock.svg" alt="" class="mr-2 rounded" style="width:10%; max-width:25px;">
                <label for="cc-number">Waktu</label>
                </div>
                <strong><?php echo"$inputTime"; ?></strong>
                <div class="invalid-feedback">
                  Nomor kartu kredit diperlukan
                </div>
              </div>
            </div>
          <form  action = "payment.inc.php?promocode=<?=$promocode?>&seatno=<?=$_GET['seatno']?>&inputdate=<?=$_GET['inputdate']?>&scheduleno=<?=$_GET['scheduleno']?>&TicketPrice=<?=$_GET['TicketPrice']?>" method="POST">
            <hr class="mb-4">
            
            <h4 class="mb-3">Pembayaran</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit"  type="radio" name="PaymentType" value="Credit Card" class="custom-control-input" checked required>
                <label class="custom-control-label"  for="credit">Kartu Kredit</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit"  name="PaymentType" value= "Debit Card" type="radio" class="custom-control-input" required>
                <label class="custom-control-label"  for="debit">Kartu Debit</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Nama</label>
                <input type="text" class="form-control" name="CardName" id="cc-name" placeholder="" required>
                <small class="text-muted">Nama lengkap sesuai kartu</small>
                <div class="invalid-feedback">
                  Nama pada kartu diperlukan
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Nomor kartu kredit</label>
                <input type="text" class="form-control" maxlength="16" pattern="[1-9][0-9][0-9][0-9]{13}" name="CardNumber" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Nomor kartu kredit diperlukan
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Bulan Kedaluwarsa</label>
                <input type="text" class="form-control"  maxlength="2" pattern="[0-1][0-9]{1}" name="ExpireMonth" id="cc-expiration" placeholder="MM" required>
                <div class="invalid-feedback">
                  Diperlukan tanggal kedaluwarsa
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Tahun</label>
                <input type="text" class="form-control"  maxlength="4" pattern="[2-3][0][2-5][0-9]{1}" name="ExpireYear" id="cc-expiration" placeholder="YYYY" required>
                <div class="invalid-feedback">
                  Diperlukan tanggal kedaluwarsa
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" maxlength="3" pattern="\d{3}" class="form-control" name="CVV" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Kode keamanan diperlukan
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" name="checkout" type="submit">Lanjutkan ke pembayaran</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2025 Pindo Transport</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/vendor/holder.min.js"></script>
   <!-- Placed  <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>-->
  </body>
</html>