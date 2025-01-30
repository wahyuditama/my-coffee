<?php

include '../inc/query.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include '../inc/head.php' ?>
</head>

<body class="services-page">

    <?php include '../inc/navbar.php' ?>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Services</h1>
                            <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
                            <a href="contact.php" class="cta-btn">Available for Hire<br></a>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="../../index.php">Home</a></li>
                        <li class="current">Services</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <div class="container">

                <div class="row gy-4">

                    <?php foreach ($rowServices as $display) : ?>
                        <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item position-relative">
                                <div class="icon">
                                    <img src="../../admin/upload/<?php echo $display['images'] ?>" width="50" class=img-fluid alt="">
                                    </i>
                                </div>
                                <!-- <div class="icon"><i class="bi bi-activity icon"></i></div> -->
                                <div class="card-title" style="text-align:justify;">
                                    <h4><a href="" class="stretched-link"><?php echo $rowServices[0]['title'] ?></a></h4>
                                    <p><?php echo $rowServices[0]['sub_title'] ?></p>
                                </div>
                            </div>
                        </div><!-- End Service Item -->
                    <?php endforeach ?>

                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Pricing Section -->
        <section id="pricing" class="pricing section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Pricing</h2>
                <p>Check my adorable pricing</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 gx-lg-5">

                    <?php foreach ($rowImages as $pricing) : ?>
                        <div class="col-lg-6">
                            <div class="pricing-item d-flex justify-content-between">
                                <h3><?php echo $pricing['product_name'] ?></h3>
                                <h4>$<?php echo $pricing['price'] ?></h4>
                            </div>
                        </div><!-- End Pricing Item -->
                    <?php endforeach; ?>

                </div>

            </div>

        </section><!-- /Pricing Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimonials</h2>
                <p>What they are saying</p>
            </div><!-- End Section Title -->

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 1,
                                "spaceBetween": 40
                            },
                            "1200": {
                                "slidesPerView": 3,
                                "spaceBetween": 1
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper">

                    <?php
                    foreach ($rowSuggest as $content) : ?>
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                                <p>
                                    <?php echo $content['suggestion'] ?>
                                </p>
                                <div class="profile mt-auto">
                                    <img src="../../admin/upload/<?php echo $content['foto'] ?>" class="testimonial-img" alt="">
                                    <h3><?php echo $content['username'] ?></h3>
                                    <h4><?php echo $content['title'] ?></h4>
                                </div>
                            </div>

                            <div class="swiper-pagination"></div>
                        </div>
                    <?php endforeach ?>

                </div>


        </section><!-- /Testimonials Section -->

    </main>

    <?php include '../inc/footer.php' ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader">
        <div class="line"></div>
    </div>

    <?php include '../inc/js.php' ?>
</body>

</html>