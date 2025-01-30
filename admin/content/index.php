<?php
session_start();
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <?php include '../layout/head.php' ?>
</head>
<style>
    @media (max-width: 1500px) {
        .title-paragraf {
            display: flex;
            width: 400px;
        }

        .col-md-6 img {
            width: 400px;
        }

    }

    @media (max-width:992px) {
        .title-paragraf {
            display: flex;
            width: 600px;
        }

        .col-md-6 img {
            width: 400px;
        }
    }
</style>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include '../layout/sidebar.php' ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include '../layout/navbar.php' ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card p-3">
                            <div class="card-header border-bottom border-2 mb-3" style="font-family:Playwrite AU SA, serif;">
                                <h4 class="text-warning">Welcome to Dashboard My-Coffee</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <img src="../../front-end/assets/img/Image-uploaded-from-iOS-2-1.jpg" width="500" alt="">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">The Best Equipment</h5>
                                    <div class="card-text title-paragraf" style="text-align: justify;">
                                        <p>
                                            Our position remains unchanged. My-coffee upholds humanity. We condemn violence, the loss of innocent lives, and all hate speech and weapons.
                                            Despite false statements spread on social media, we have no political agenda. We do not use our profits to fund government or military operations anywhere – and never have.
                                        </p>
                                        <p>
                                            To craft the perfect cup, our baristas need the best equipment. None is more important than our custom-designed espresso machines. With unerring accuracy, they grind and pour shots to the precise time required for the peak flavor. This allows our baristas to concentrate on crafting your drink exactly the way you like it.

                                            We’ve also launched new innovative milk pitchers, specially designed by us. It helps our baristas turn cold milk into sweet, creamy steamed milk with the thick, velvety foam that just tastes best.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card my-3 p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Who Makes It</h5>
                                    <div class="card-text title-paragraf" style="text-align: justify;">
                                        <p>
                                            It’s the passion and dedication of our extensively trained baristas that determines whether your coffee is just good, or if it is perfect. It’s a sentiment instilled from the very beginning of their training under the mantra “the last 10 feet is in our hands.” This reminds us that no matter how good our beans, how dark the roast, or how great the tools, it’s up to us to make sure your cup is made just the way you like it. And please don’t be shy, just let us know if it’s not and we’ll make it again for you.
                                        </p>
                                        <p>
                                            The perfect espresso drink always starts with the highest-quality Arabica beans perfectly roasted to our specifications. Since we developed our Espresso Roast more than 30 years ago, we’ve continued to perfect the roasting and blending to ensure this darker roast delivers a caramelly sweetness, soft acidity, and depth.

                                            To keep that flavor, we freshly grind beans for each shot.And our espresso beans are always ethically sourced and 100% Fairtrade. So they don’t just taste good – they do good too.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center">
                                    <img src="../../front-end/assets/img/613ede55094fb.jpg" width="500" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include '../layout/footer.php' ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now mt-5">
        <a
            href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
            target="_blank"
            class="btn btn-danger btn-buy-now">Welcome to MY-Coffee</a>
    </div> -->

    <?php include '../layout/js.php' ?>
</body>

</html>