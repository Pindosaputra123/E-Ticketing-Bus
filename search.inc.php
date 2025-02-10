<?php
    require("loginheader.php");

    $inputFrom = $_GET["inputFrom"];
    $inputTo = $_GET["inputTo"];
    $inputDepartDate = $_GET["inputDepartDate"];
    if($inputFrom == "" || $inputTo == "" || $inputDepartDate == "" )
    {
      header("location:searchbus.php");
    }
    if(isset($_GET['book_ticket'])){
     //Input Validation
    if($inputFrom != "From" & $inputTo != "To..." & $inputDepartDate != ""){
    $busInfo = mysqli_query($con,"SELECT * FROM bus_schedule INNER JOIN bus ON bus_schedule.BusNo = bus.BusNo WHERE ScheduleDepart = '$inputFrom' AND ScheduleArrive = '$inputTo'");
    }
    else if($inputFrom == "From..."){
      header("location: searchbus.php?error=invalid_from");
    }
    else if($inputTo == "To..."){
      header("location:searchbus.php?error=invalid_to");
    }
    else{
        header("location:searchbus.php?error=invalid_date");
      }
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

    <title>Pindo Transport - Search Bus</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">

    <!-- Aos.js -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  </head>

  <body class="bg-light">

  <!-- HEADER-->
  <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">
          <img src="images/logo_white.png" width="30" height="30" class="d-inline-block align-top" alt="">
    
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="searchbus.php">Reservasi Tiket</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="promotion.php">Promo</a>
            </li>
            <?php if(isset($_SESSION['id']))
            {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="managebooking.php">Tiket Saya</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="setting.php">Akun Saya</a>
            </li>';
            }; ?>
          </ul>
            <?php
            if(isset($_SESSION['id']))
            {
          echo '<form class="form-inline"><div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                echo $myFirstName." ".$myLastName;
              echo '</a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="managebooking.php">Kelola Pemesanan</a>
                <a class="dropdown-item" href="setting.php">Pengaturan</a>
                <a class="dropdown-item" href="logout.php">Keluar</a>
              </div>
            </li>
          </ul>
        </div></form>';
            }
            else
            {
              echo '<form class="form-inline mt-2 mt-md-0" action="login.php">
              <button type="submit" class="btn btn-outline-warning my-2 my-sm-0">Login</button>
              </form>';
            }
            ?>
          
        </div>
        
      </nav>
    </header><?php
    include('assets/header.php');
  ?>
    
    <main role="main" class="container">

    <!-- Search Bus Ticket Start Here-->
      <div data-aos="zoom-out">
       <div class="container p-3 my-3 bg-purple rounded box-shadow">
         <form action="search.inc.php" method="get">
           <div class="form-row  col-md-12">
            <div class="form-group col-md-4 text-left">

             <!-- Select Bus From (Departure)-->
              <label for="inputFrom"  style="color:white;">Pilih Asal</label>
                <span style="color: red !important; display: inline; float: none;">*</span> 
                   <select id="inputFrom" name="inputFrom" placeholder="<?php echo$inputFrom;?>"class="form-control" required>
                      <option selected><?php echo$inputFrom;?></option>
                      <option value="Semarang">Semarang</option>
                      <option value="Karawang">Karawang</option>
                      <option value="Serang">Serang</option>
                   </select>
            </div>

             <!-- Select Bus To (Arrival)-->
            <div class="form-group col-md-4 text-left">
              <label for="inputTo" style="color:white;">Pilih Tujuan</label>
                <span style="color: red !important; display: inline; float: none;">*</span> 
                   <select id="inputTo" name="inputTo" placeholder="" class="form-control" required>
                      <option selected><?php echo$inputTo;?></option>
                      <option value="Semarang">Semarang</option>
                      <option value="Karawang">Karawang</option>
                      <option value="Serang">Serang</option>
                    </select>
             </div>

              <!-- Select Bus Departure Date -->
            <div class="form-group col-md-4 text-left">
               <label for="inputDepartDate" style="color:white;">Tanggal Keberangkatan</label>
                 <span style="color: red !important; display: inline; float: none;">*</span> 
                    <input type="date" class="form-control" id="inputDepartDate" placeholder="<?php echo$inputDepartDate;?>" name="inputDepartDate"  >
             </div>
           </div>

              <!-- Book Ticket -->
               <p class="text-right">
               <button class="btn btn-primary my-2" id="book_ticket" name="book_ticket">Pesan Tiket</button>
               </p>
          </div>
        </form>
       </div>
      </div>
    <!--End of Book Ticket -->

    <!-- Bus Result Table -->
      <div data-aos="fade-left" data-aos-duration="2000">
        <div class="my-3 p-3 bg-white rounded box-shadow">
           <h5 class="border-bottom border-gray pb-2 mb-0">Ini informasi bus Anda </h5>
             <table class="table table-hover">
              <thead>
               <tr>
                 <th scope="col">Tanggal</th>
                 <th scope="col">Waktu</th>
                 <th scope="col">Nama Bus</th>
                 <th scope="col">No Bus</th>
                 <th scope="col">Keberangkatan</th>
                 <th scope="col">Tujuan</th>
                 <th scope="col">Durasi</th>
                 <th scope="col">Harga Tiket</th>
                </tr>
              </thead>
            
          <!--Display Search Bus Ticket Resuly -->
           <tbody>
            <?php  
               while($row = mysqli_fetch_array($busInfo))
               {
               echo "<tr>";
               echo "<td>";
               echo $inputDepartDate;
               echo "</td>";
               echo "<td>";
               echo $row['ScheduleStartTime'];
               echo "</td>";
               echo "<td>";
               echo $row['BusCompany'];
               echo "</td>";
               echo "<td>";
               echo $row['BusNo'];
               echo "</td>";
               echo "<td>";
               echo $row['ScheduleDepart'];
               echo "</td>";
               echo "<td>";
               echo $row['ScheduleArrive'];
               echo "</td>";
               echo "<td>";
               echo $row['ScheduleDuration'];
               echo "</td>";
               echo "<td>";
               echo $row['TicketPrice'];
               echo "</td>";
               echo "<td><a href='select_seat.php?scheduleno=";
               echo $row['ScheduleNo'];
               echo "&inputdate=".$inputDepartDate."&TicketPrice=".$row['TicketPrice'];
               echo "'>Pilih</a></td></tr>";        
              }
            ?>
           </tbody>
        </table>
       </div>
     </div>
     <!-- End of Bus Result Table -->
   </main>
<!--End of the Main -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("inputDepartDate")[0].setAttribute('min', today);
    </script>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/holderjs@2.9.7/holder.min.js"></script>
    <script src="js/offcanvas.js"></script>
    <!-- Aos.js -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
  </body>
</html>
