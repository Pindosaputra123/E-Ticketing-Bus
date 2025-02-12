<?php
  require("../loginheader.php");
  if($myAccountRole != "Admin") {
    header('Location:../index.php');
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
    <script type="text/javascript" src="validationFunction.js"></script>
    <title>Pindo Transport - Kelola Pemesanan</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    <style>
      .container-fluid {
        padding-top: 30px;
      }
      .sidebar {
        background-color: #f8f9fa;
        padding-top: 20px;
      }
      .sidebar .nav-link {
        font-weight: bold;
      }
      .form-group {
        margin-bottom: 1.5rem;
      }
      table th, table td {
        text-align: center;
      }
      .btn-info, .btn-secondary {
        margin-top: 10px;
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Pindo Transport</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../logout.php">Keluar</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="admin.php">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="manageBooking.php">
                    <span data-feather="bookmark"></span>
                    Ticket
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="managePromo.php">
                    <span data-feather="shopping-cart"></span>
                    Promotion
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="manageUser.php">
                    <span data-feather="users"></span>
                    Customer
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="manageBus.php">
                    <span data-feather="truck"></span>
                    Bus
                  </a>
                </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Manajemen Tiket</h1>
          </div>

          <!-- Start the CRUD -->
          <?php require_once 'functionBooking.php'; ?>

          <?php
            if($showmessage == true):
              echo '<script>alert("Record Updated")</script>';
            endif;
          ?>
          
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <form name="ticketForm" action="functionBooking.php" onsubmit="return manageTicketValidation()" method="POST">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>No Pesanan</label>
                      <input type="text" name="bookNo" class="form-control" value="<?php echo $bkNo; ?>" placeholder="No Pesanan" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label>No Akun</label>
                      <input type="text" name="accNo" class="form-control" value="<?php echo $acctNo; ?>" placeholder="No Akun" readonly>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Kode Promo</label>
                      <input type="text" name="proCode" class="form-control" value="<?php echo $prCode; ?>" placeholder="Kode Promo" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label>No Jadwal</label>
                      <input type="text" name="sNo" class="form-control" value="<?php echo $scNo; ?>" placeholder="No Jadwal" readonly>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Jumlah</label>
                      <input type="text" name="quan" class="form-control" value="<?php echo $quant; ?>" placeholder="Jumlah">
                    </div>
                    <div class="form-group col-md-6">
                      <label>No Kursi</label>
                      <input type="text" name="bSeat" class="form-control" value="<?php echo $buSeat; ?>" placeholder="No Kursi">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Jadwal Keberangkatan</label>
                      <input type="text" name="bDtime" class="form-control" value="<?php echo $buDtime; ?>" placeholder="Jadwal Keberangkatan" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label>No Pembayaran</label>
                      <input type="text" name="pa" class="form-control" value="<?php echo $paym; ?>" placeholder="No Pembayaran" readonly>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Status Pesanan</label>
                      <select name="bStatus" class="form-control">
                        <option value="<?php echo $boStatus; ?>"><?php echo $boStatus; ?></option>
                        <option value="Cancelled">Dibatalkan</option>
                        <option value="Completed">Selesai</option>
                        <option value="Confirmed">Dikonfirmasi</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Waktu Pemesanan</label>
                      <input type="text" name="bTstamp" class="form-control" value="<?php echo $boTstamp; ?>" placeholder="Waktu Pemesanan" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <?php if ($update == true): ?>
                      <button type="submit" name="uBooking" class="btn btn-info">Perbarui</button>
                      <button type="submit" name="cancelUpdate" class="btn btn-secondary">Batal</button>
                    <?php endif; ?>
                  </div>
                </form>
              </div>

              <div class="col-md-6">
                <h3>Daftar Pesanan</h3>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No Pesanan</th>
                      <th>No Akun</th>
                      <th>Tindakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include("../db.php");
                    $result = $con->query("SELECT * FROM booking") or die($con->error());
                    while ($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?php echo $row['BookingNo']; ?></td>
                        <td><?php echo $row['AccountNo']; ?></td>
                        <td>
                          <a href="manageBooking.php?edit=<?php echo $row['BookingNo']; ?>" class="btn btn-info">Edit</a>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
