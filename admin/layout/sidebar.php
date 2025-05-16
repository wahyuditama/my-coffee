<?php include 'encryp.php'; ?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="d-flex">
            <span class="app-brand-logo demo">
                <img src="../assets/img/backgrounds/side-logo-coffee.png" width="60" height="auto" alt="">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-wrap fs-4 mt-3" style="font-family:Playwrite AU SA, serif;">MY-Coffee</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <!-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Layouts</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="layouts-without-menu.html" class="menu-link">
                        <div data-i18n="Without menu">Without menu</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-without-navbar.html" class="menu-link">
                        <div data-i18n="Without navbar">Without navbar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-container.html" class="menu-link">
                        <div data-i18n="Container">Container</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-fluid.html" class="menu-link">
                        <div data-i18n="Fluid">Fluid</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-blank.html" class="menu-link">
                        <div data-i18n="Blank">Blank</div>
                    </a>
                </li>
            </ul>
        </li> -->

        <?php if ($_SESSION['level_id'] == 1): ?>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Admin</span>
            </li>
            <li class="menu-item">
                <a href="../content/level.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Data Level</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="../content/category.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Data Kategori Barang</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="../content/product.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                    <div data-i18n="Misc">Data Barang</div>
                </a>
            </li>
        <?php endif ?>
        <!-- Components -->

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="../content/order.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Order Product</div>
            </a>
        </li>
        <!-- User interface -->
        <?php if ($_SESSION['level_id'] == 1) : ?>
            <li class="menu-item">
                <a href="../content/user.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic"> Customer</div>
                </a>
            </li>
        <?php else : $encrypt = encryptId($_SESSION['user_id'], $key) ?>
            <li class="menu-item">
                <a href="../content/user.php?edit=<?php echo urlencode($encrypt)  ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic"> Profile</div>
                </a>
            </li>
        <?php endif ?>

        <!-- Extended components -->
        <li class="menu-item">
            <a href="../content/section-about.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">According a Guest</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="brand.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="">Brand Pathner</div>
            </a>
        </li>

        <?php if ($_SESSION['level_id'] == 1) : ?>
            <!-- Forms & Tables -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Data &amp; Penjualan</span></li>
            <!-- Forms -->
            <li class="menu-item">
                <a href="product_pay.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-detail"></i>
                    <div data-i18n="Form Elements">customer purchases</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="services.php" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-detail"></i>
                    <div data-i18n="Form Layouts">Services</div>
                </a>

            </li>
        <?php endif ?>
        <!-- Tables -->
        <li class="menu-item">
            <a href="aksesoris.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">accessories</div>
            </a>
        </li>
        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
        <li class="menu-item">
            <?php if ($_SESSION['level_id'] == 2): ?>
                <a
                    href="product_pay.php?SalesDetail=<?php echo $_SESSION['user_id'] ?>"
                    target=""
                    class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cart"></i>
                    <div data-i18n="Support">Your Purchases</div>
                </a>
            <?php endif ?>
        </li>
        <li class="menu-item">
            <a
                href="environment.php"
                target=""
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-buoy"></i>
                <div data-i18n="Support">Environment</div>
            </a>
        </li>
        <li class="menu-item">
            <a
                href="https://getbootstrap.com/"
                target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
            </a>
        </li>
    </ul>
</aside>