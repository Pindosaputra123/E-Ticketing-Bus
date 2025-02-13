<?php
  require("../loginheader.php");
  if($myAccountRole != "Admin")
  {
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
    <title>Pindo Transport - Manajemen Penumpang</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                    Dashboard <span class="sr-only"></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="manageBooking.php">
                    <span data-feather="bookmark"></span>
                    Ticket
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="managePromo.php">
                    <span data-feather="shopping-cart">(current)</span>
                    Promotion
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="manageUser.php">
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
            <h1 class="h2">Manajemen Pengguna</h1>
          </div>

          <?php require_once 'functionUser.php'; ?>

          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Edit Data Pengguna</h5>
                  </div>
                  <div class="card-body">
                    <form action="functionUser.php" method="POST" onsubmit="return manageUserValidation()" name="UserFormManagement">
                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label>No Akun</label>
                          <input type="text" name="an" class="form-control" value="<?php echo $accNo; ?>" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Peran Pengguna</label>
                          <input type="text" name="ar" class="form-control" value="<?php echo $accRole; ?>" readonly>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label>Nama Depan</label>
                          <input type="text" name="fn" class="form-control" value="<?php echo $fName; ?>" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Nama Belakang</label>
                          <input type="text" name="ln" class="form-control" value="<?php echo $lName; ?>" readonly>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label>Email</label>
                          <input type="email" name="em" class="form-control" value="<?php echo $ema; ?>">
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Password</label>
                          <input type="text" name="pw" class="form-control" value="<?php echo $passw; ?>">
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label>Jenis Kelamin</label>
                          <input type="text" name="gd" class="form-control" value="<?php echo $gen; ?>" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>Tanggal Lahir</label>
                          <input type="date" name="dob" class="form-control" value="<?php echo $dobrith; ?>" readonly>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label>Kebangsaan</label>
                          <input type="text" name="na" class="form-control" value="<?php echo $nati; ?>" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                          <label>No Handphone</label>
                          <input type="text" name="pn" class="form-control" value="<?php echo $pnum; ?>">
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label>Waktu Masuk</label>
                          <input type="text" name="ats" class="form-control" value="<?php echo $atstamp; ?>" readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <?php if ($update == true): ?>
                          <button type="submit" name="uUser" class="btn btn-info">Perbarui</button>
                          <button type="submit" name="cUpate" class="btn btn-secondary">Batal</button>
                        <?php endif; ?>
                      </div>
                    </form> 
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <?php 
                  include("../db.php");
                  $result = $con->query("SELECT * FROM account WHERE AccountRole !='admin'") or die($con->error());
                ?>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No Akun</th>
                        <th>Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>Alamat Email</th>
                        <th>No Handphone</th>
                        <th>Waktu Masuk</th>
                        <th>Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                          <td><?php echo $row['AccountNo']; ?></td>
                          <td><?php echo $row['FirstName']; ?></td>
                          <td><?php echo $row['LastName']; ?></td>
                          <td><?php echo $row['Email']; ?></td>
                          <td><?php echo $row['PhoneNumber']; ?></td>
                          <td><?php echo $row['AccountTimestamp']; ?></td>
                          <td>
                            <a href="manageUser.php?edit=<?php echo $row['AccountNo']; ?>" class="btn btn-info btn-sm">Edit</a>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
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
