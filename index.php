<?php
    require("loginheader.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Pindo Transport - Home</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Aos.js -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  </head>
  <body>

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
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
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
                <a class="dropdown-item" href="setting.php">Pengaturan</a>';
                if($myAccountRole == "Admin")
                {
                  echo '<a class="dropdown-item" href="AdminPage/admin.php">Halaman Admin</a>';
                }
                echo '<a class="dropdown-item" href="logout.php">Keluar</a>
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
    </header>
 
    <main role="main">
    <section class="jumbotron text-center" style="background-image: url('images/indonesia.jpg');" >
        <div class="container"  data-aos="fade-up" data-aos-duration="3000">
          <h1 class="jumbotron-heading" style="color:white;">Rasakan Kenyamanan di Setiap Perjalanan</h1>
          <p class="lead text-muted" style="color:#f8f9fa!important">Bersama Pindo Transport</p>
    
    <!-- Book  Ticket Start Here-->
    <form action="search.inc.php" method="get">
    <div class="form-row  col-md-12">
       <div class="form-group col-md-4 text-left">
          <label for="inputFrom"  style="color:white;">Pilih Asal</label>
             <span style="color: red !important; display: inline; float: none;">*</span> 
               <select id="inputFrom" name="inputFrom" class="form-control" required>
                <option value="From...">Dari...</option>
                <option value="Semarang">Semarang</option>
                <option value="Karawang">Karawang</option>
                <option value="Serang">Serang</option>
               </select>
         </div>

        <div class="form-group col-md-4 text-left">
          <label for="inputTo" style="color:white;">Pilih Tujuan</label>
            <span style="color: red !important; display: inline; float: none;">*</span> 
              <select id="inputTo" name="inputTo" class="form-control" required>
                <option value="To...">Ke...</option>
                <option value="Semarang">Semarang</option>
                <option value="Karawang">Karawang</option>
                <option value="Serang">Serang</option>
             </select>
         </div>

    
    <div class="form-group col-md-4 text-left">
    <label for="inputDepartDate" style="color:white;">Tanggal Keberangkatan</label>
      <span style="color: red !important; display: inline; float: none;">*</span> 

      <input type="date" class="form-control" id="inputDepartDate" name="inputDepartDate"  >
    </div>
   
  </div>
          <p class="text-right">
            <button class="btn btn-primary my-2" id="book_ticket" name="book_ticket">Pesan Tiket</button>
          </p>
        </div>
        </form>
      </section>
   
      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">
        <div class="row" data-aos="fade" data-aos-duration="2000">
      <div class="alert alert-danger col-md-10 offset-md-1">
       <strong>Perhatian!</strong> Kami tidak bertanggung jawab atas kehilangan barang selama perjalanan. Harap selalu menjaga barang bawaan Anda.
    </div>
    </div>
        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4" data-aos="fade" data-aos-duration="3000">
            <img class="rounded-circle" src="images/semarang.jpg" alt="Legoland image" width="140" height="140">
            <h2>SEMARANG</h2>
            <p>Jawa Tengah, Indonesia</p>
            <p>Kota pesisir di Jawa Tengah, terkenal dengan Kota Lama bersejarah dan kuliner khas seperti lumpia.</p>
           
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4" data-aos="fade" data-aos-duration="3000">
            <img class="rounded-circle" src="images/karawang.jpg" alt="Theme Park image" width="140" height="140">
            <h2>KARAWANG</h2>
            <p>Jawa Barat, Indonesia</p>
            <p>Kabupaten di Jawa Barat, dikenal sebagai kawasan industri dan pertanian padi, serta situs sejarah seperti Candi Jiwa.</p>
          </div><!-- /.col-lg-4 -->

          <div class="col-lg-4" data-aos="fade" data-aos-duration="3000">
            <img class="rounded-circle" src="images/serang.jpg" alt="Lost World image" width="140" height="140">
            <h2>SERANG</h2>
            <p>Banten, Indonesia</p>
            <p>Ibu kota Banten, memiliki sejarah kerajaan Banten, dengan tempat menarik seperti Masjid Agung Banten dan pantai Anyer.</p>
          </div><!-- /.col-lg-4 -->
          
        </div><!-- /.row -->
        <p class="text-right"><a class="btn btn-secondary" href="promotion.php" role="button">Lihat Detail &raquo;</a></p>
      </div><!-- /.container -->


      <!-- FOOTER -->
      <footer class="container">
        <p>&copy; 2025 Pindo Transport.</p>
      </footer>
    </main>

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
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="https://cdn.jsdelivr.net/npm/holderjs@2.9.7/holder.min.js"></script>
    <!-- Aos.js -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
  </body>
</html>
