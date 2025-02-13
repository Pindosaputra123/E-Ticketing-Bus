<?php
  require("../loginheader.php");
  if ($myAccountRole != "Admin") {
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
    <script type="text/javascript" src="validationFunction.js"></script>
    <title>Pindo Transport - Manajemen Promo</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="../css/dashboard.css" rel="stylesheet">
    <style>
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
                  <a class="nav-link" href="manageBooking.php">
                    <span data-feather="bookmark"></span>
                    Ticket
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="managePromo.php">
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
            <h1 class="h2">Manajemen Promo</h1>
          </div>

          <!-- Start CRUD Section -->
          <?php require_once 'functionPromo.php'; ?>

          <div class="container">
            <div class="row">
              <div class="col-sm-6"> 
                <div class="row justify-content-center">
                  <form name="promotionForm" action="functionPromo.php" onsubmit="return managePromotionValidation()" method="POST">
                    <div class="form-group">
                      <label for="pCode">Kode Promo</label>
                      <?php if($update == true): ?>
                        <input type="text" name="upCode" id="pCode" class="form-control" value="<?php echo $prCode; ?>" placeholder="Kode Promo" readonly>
                      <?php else: ?>
                        <input type="text" name="pCode" id="pCode" class="form-control" placeholder="Buat Kode Promo">
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="pcDes">Deskripsi</label>
                      <input type="text" name="pcDes" id="pcDes" class="form-control" value="<?php echo $prcDes; ?>" placeholder="Deskripsi Promosi">
                    </div>

                    <div class="form-group">
                      <label for="pcEnd">Tanggal Berakhir Promo</label>
                      <input type="date" name="pcEnd" id="pcEnd" class="form-control" value="<?php echo $prcEnd; ?>" placeholder="Masukkan Tanggal Berakhir">
                    </div>

                    <div class="form-group">
                      <label for="pcStart">Tanggal Mulai Promo</label>
                      <?php if ($update == true): ?>
                        <input type="text" name="upcStart" id="pcStart" class="form-control" value="<?php echo $prcStart; ?>" placeholder="Masukkan Tanggal Mulai">
                      <?php else: ?>
                        <input type="datetime-local" name="pcStart" id="pcStart" class="form-control" placeholder="Masukkan Tanggal Berakhir">
                      <?php endif; ?>
                    </div>

                    <div class="form-group">
                      <label for="pPer">Persentase Promo</label>
                      <input type="text" name="pPer" id="pPer" class="form-control" value="<?php echo $prcPer; ?>" placeholder="Masukkan Persentase Promo">
                    </div>

                    <div class="form-group">
                      <label for="Sch">No Jadwal</label>
                      <select name="Sch" id="Sch" class="form-control">
                        <option value="<?php echo $psch; ?>"><?php echo $psch; ?></option>
                        <?php
                          include("../db.php");
                          $result1 = $con->query("SELECT ScheduleNo FROM bus_schedule") or die($con->error());
                          while ($rows = $result1->fetch_assoc()):
                            $schedule_no = $rows['ScheduleNo'];
                        ?>
                          <option value="<?php echo $schedule_no; ?>"><?php echo $schedule_no; ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <?php if($update == true): ?>
                        <button type="submit" name="updateProm" class="btn btn-info">Perbarui</button>
                        <button type="submit" name="cancelUpdate" class="btn btn-secondary">Batal</button>
                      <?php else: ?>
                        <button type="submit" name="addProm" class="btn btn-primary">Tambah</button>
                      <?php endif; ?>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-sm-6">
                <?php
                  // Display Promotion codes from the database
                  include("../db.php");
                  $result = $con->query("SELECT * FROM promo_code") or die($con->error());
                ?>
                <div class="table-responsive">
                  <table id="promoTable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Kode Promo</th>
                        <th>Tanggal Mulai Promo</th>
                        <th>Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                          <td><?php echo $row['PromoCode']; ?></td>
                          <td><?php echo $row['PromoCodeStartTimestamp']; ?></td>
                          <td>
                            <a href="managePromo.php?edit=<?php echo $row['PromoCode']; ?>" class="btn btn-info">Edit</a>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- End CRUD Section -->

        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- DataTable Script -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#promoTable').DataTable();
      });
    </script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace();
    </script>
  </body>
</html>
