<?php
include 'admin/database/koneksi.php';

$queryImages = mysqli_query($koneksi, "SELECT * FROM product");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - PhotoFolio Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="front-end/assets/img/favicon.png" rel="icon">
  <link href="front-end/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Cardo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playwrite+AU+SA:wght@100..400&family=Playwrite+IE+Guides&display=swap" rel="stylesheet">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- Vendor CSS Files -->
  <link href="front-end/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="front-end/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="front-end/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="front-end/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="front-end/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="front-end/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="front-end/assets/img/logo.png" alt=""> -->
        <i class='bx bx-coffee'></i>
        <h5 class="sitename" style="font-family:Playwrite AU SA, serif;">My-Coffee</h5>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="front-end/app/about.php" class="active">Home<br></a></li>
          <li><a href="front-end/app/about.php">About</a></li>
          <li><a href="front-end/app/services.php">Services</a></li>
          <li><a href="front-end/app/contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        <a href="admin/content/login.php" class="">Login</i></a>
      </div>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center" data-aos="fade-up" data-aos-delay="100">
            <h2><span>Welcome to My-Coffee, and enjoy our dishes</span></h2>
            <p>Blanditiis praesentium aliquam illum tempore incidunt debitis dolorem magni est deserunt sed qui libero. Qui voluptas amet.</p>
            <a href="contact.html" class="btn-get-started">Available for Hire<br></a>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 justify-content-center">

          <?php
          $no = 1;
          while ($rowImages = mysqli_fetch_assoc($queryImages)) { ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="gallery-item h-100">
                <img src="admin/upload/<?php echo $rowImages['image'] ?>" class="img-fluid" alt="">
                <div class="gallery-links d-flex align-items-center justify-content-center">
                  <a href="front-end/front-end/assets/img/gallery/gallery-1.jpg" title="Gallery 1" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>
                  <a href="gallery-single.html" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div>
          <?php } ?>
          <!-- End Gallery Item -->

        </div>

      </div>

    </section><!-- /Gallery Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">PhotoFolio</strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
      </div>
    </div>

  </footer>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="front-end/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="front-end/assets/vendor/php-email-form/validate.js"></script>
  <script src="front-end/assets/vendor/aos/aos.js"></script>
  <script src="front-end/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="front-end/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="front-end/assets/js/main.js"></script>
</body>

</html>