<?php
  require("../loginheader.php");

  // Memeriksa apakah pengguna adalah Admin
  if ($myAccountRole != "Admin") {
    header('Location:../index.php');
    exit;
  }

  // Inisialisasi variabel
  $account = '';
  $date = '';
  $Jan = $Feb = $Mar = $Apr = $May = $Jun = $Jul = $Aug = $Sept = $Oct = $Nov = $Dec = 0;

  // Menyiapkan query untuk mendapatkan total pendapatan per bulan
  $sql = "SELECT MONTH(BookingTimestamp) AS Month, SUM(TicketPrice) AS Earn 
          FROM booking 
          RIGHT JOIN bus_schedule ON booking.ScheduleNo = bus_schedule.ScheduleNo 
          GROUP BY Month";
  $query = mysqli_query($con, $sql);

  // Memproses hasil query
  while ($row = mysqli_fetch_array($query)) {
    $Account = $row['Earn'];
    $Month = $row['Month'];
    switch ($Month) {
      case "1": $Jan = $Account; break;
      case "2": $Feb = $Account; break;
      case "3": $Mar = $Account; break;
      case "4": $Apr = $Account; break;
      case "5": $May = $Account; break;
      case "6": $Jun = $Account; break;
      case "7": $Jul = $Account; break;
      case "8": $Aug = $Account; break;
      case "9": $Sept = $Account; break;
      case "10": $Oct = $Account; break;
      case "11": $Nov = $Account; break;
      case "12": $Dec = $Account; break;
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

  <title>Pindo Transport - Admin</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="../css/dashboard.css" rel="stylesheet">
  <style>
    .sidebar {
        background-color: #f8f9fa;
        padding-top: 20px;
    }
    .sidebar .nav-link {
      font-weight: bold;
    }
  </style>
  
</head>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">Pindo Transport</a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="../logout.php">Keluar</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <span data-feather="home"></span> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manageBooking.php">
                <span data-feather="bookmark"></span> Ticket
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="managePromo.php">
                <span data-feather="shopping-cart"></span> Promotion
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manageUser.php">
                <span data-feather="users"></span> Customer
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manageBus.php">
                <span data-feather="truck"></span> Bus
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Total Pendapatan</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-sm btn-outline-secondary">
              <span data-feather="calendar"></span> Tahun Ini
            </button>
          </div>
        </div>

        <!-- Chart -->
        <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
      </main>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace();
  </script>

  <!-- Chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
        datasets: [{
          data: [<?=$Jan?>, <?=$Feb?>, <?=$Mar?>, <?=$Apr?>, <?=$May?>, <?=$Jun?>, <?=$Jul?>, <?=$Aug?>, <?=$Sept?>, <?=$Oct?>, <?=$Nov?>, <?=$Dec?>],
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 4,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: false
            }
          }]
        },
        legend: {
          display: false
        }
      }
    });
  </script>
</body>
</html>
