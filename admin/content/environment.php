<?php
include '../database/koneksi.php';
session_start();

if (isset($_POST['tambah'])) {
    $judul = $_POST['title'];
    $paragraf = mysqli_real_escape_string($koneksi, $_POST['paraf']);
    $menu = $_POST['menu'];

    $insert = mysqli_query($koneksi, "INSERT INTO environment (title, paragraf, menu) values ('$judul','$paragraf', '$menu')");
    header("location: environment.php?input=berhasil");
}
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$edit = mysqli_query($koneksi, "SELECT * FROM environment WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($edit);

if (isset($_POST['edit'])) {
    $judul = $_POST['title'];
    $paragraf = $_POST['paraf'];
    $menu = $_POST['menu'];
    $update = mysqli_query($koneksi, "UPDATE environment SET title='$judul', paragraf='$paragraf', menu='$menu' WHERE id='$id'");
    // print_r($update);
    // die();
    header("location: environment.php?replace=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM environment WHERE id='$id'");
    header("location: environment.php?hapus=berhasil");
}

$query = mysqli_query($koneksi, "SELECT * FROM environment ORDER BY id DESC");

$resultEnv = [];
while ($row = mysqli_fetch_assoc($query)) {
    $resultEnv[] = $row;
}
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
    <style>
        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }
    </style>
</head>

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
                        <div class="row">
                            <div class="card">
                                <div class="card-title border-bottom p-2 d-flex justify-content-between">
                                    <h5 class="pt-2">Environment</h5>
                                    <?php if (isset($_GET['tambah']) || isset($_GET['edit'])) :  ?>
                                        <a href="?" class="btn-sm btn-outline-secondary pt-2">Kembali</a>
                                    <?php else : ?>
                                        <?php if ($_SESSION['level_id'] == 1) : ?>
                                            <a href="?tambah" class="btn-sm btn-outline-primary pt-2">Tambah Data</a>
                                        <?php endif ?>
                                    <?php endif ?>
                                </div>
                                <?php if (isset($_GET['tambah']) || isset($_GET['edit'])) : ?>
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="text" class="my-2">Masukan Deskripsi Judul Disini</label>
                                                <textarea name="title" class="form-control" id=""><?php echo isset($_GET['edit']) ? $rowEdit['title'] : '' ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="text" class="my-2">Masukan Deskripsi Paragraf Disini</label>
                                                <textarea name="paraf" class="form-control" id=""><?php echo isset($_GET['edit']) ? $rowEdit['paragraf'] : '' ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="text" class="my-2">Masukan Menu Untuk Navbar</label>
                                                <input type="text" name="menu" class="form-control" value="<?php echo isset($_GET['edit']) ? $rowEdit['menu'] : '' ?>" id="">
                                            </div>
                                        </div>
                                        <button type="submit" class="border-top my-3 btn-sm btn-primary" name="<?php echo isset($_GET['tambah']) ? 'tambah' : 'edit' ?>"><?php echo isset($_GET['tambah']) ? 'Tambah' : 'Edit' ?></button>
                                    </form>

                                <?php else: ?>
                                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                                        <div class="container-fluid">
                                            <!-- <a class="navbar-brand" href="javascript:void(0)">Navbar</a> -->
                                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                                <span class="navbar-toggler-icon"></span>
                                            </button>
                                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                    <?php foreach ($resultEnv as $val) : ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="javascript:void(0)"
                                                                onclick="showContent('<?php echo $val['menu'] ?>')"><?php echo $val['menu'] ?></a>
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </nav>

                                    <div class="content-container">
                                        <div class="row">
                                            <div class="col-md-8" style="text-align: justify;">
                                                <?php foreach ($resultEnv as $key): ?>
                                                    <div id="<?php echo $key['menu'] ?>" class="content-section">
                                                        <div class="card border p-3 mb-3">
                                                            <div class="card-title pt-2">
                                                                <h5><?php echo $key['title'] ?></h5>
                                                            </div>
                                                            <p class="border-top pt-4"><?php echo $key['paragraf'] ?></p>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php if ($_SESSION['level_id'] == 1) : ?>
                                                    <div class="mb-3">
                                                        <select id="paramSelect" class="form-control mb-3">
                                                            <option value="">Pilih Menu</option>
                                                            <?php foreach ($resultEnv as $param) : ?>
                                                                <option value="<?php echo $param['id'] ?>"><?php echo $param['menu'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <a id="editLink" href="#" class="btn-sm btn-primary mt-3">Edit</a>
                                                    </div>
                                                    <div class="mb-3" action="" method="post">
                                                        <select id="paramSDelete" class="form-control mb-3">
                                                            <option value="">Pilih Delete item</option>
                                                            <?php foreach ($resultEnv as $del) : ?>
                                                                <option value="<?php echo $del['id'] ?>"><?php echo $del['menu'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                                            href="environment.php?delete=<?php echo $resultEnv['0']['id'] ?>" class="btn btn-danger btn-sm tf-icon bx bx-trash bx-18px mt-1" id="link-delete">
                                                            Hapus Data
                                                        </a>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="justify-content-center d-flex">
                                                        <img src="../assets/img/backgrounds/side-logo-coffee.png" width="200" alt="">
                                                    </div>
                                                <?php endif  ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Order Statistics -->

                            <!--/ Order Statistics -->

                            <!-- Expense Overview -->

                            <!--/ Expense Overview -->

                            <!-- Transactions -->

                            <!--/ Transactions -->
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

    <div class="buy-now">
        <a
            href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
            target="_blank"
            class="btn btn-danger btn-buy-now">Welcome to MY-Coffee</a>
    </div>

    <script>
        // untuk menampilkan konten yang dipilih
        function showContent(menuId) {
            // Sembunyikan semua konten
            const allContent = document.getElementsByClassName('content-section');
            for (let content of allContent) {
                content.classList.remove('active');
            }

            // Tampilkan konten yang dipilih
            const selectedContent = document.getElementById(menuId);
            if (selectedContent) {
                selectedContent.classList.add('active');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const firstMenu = document.querySelector('.content-section');
            if (firstMenu) {
                firstMenu.classList.add('active');
            } else {
                firstMenu.classList.remove('active');
            }
        });

        const select = document.getElementById('paramSelect');
        const editLink = document.getElementById('editLink');
        const selectDel = document.getElementById('paramDelete');
        const linkDel = document.getElementById('link-delete');

        select.addEventListener('change', function() {
            const selectedValue = this.value;
            if (selectedValue) {
                editLink.href = `?edit=${selectedValue}`;
            } else {
                editLink.href = '#';
            }
        });

        select.addEventListener('change', function() {
            const selectedValue = this.value;
            if (selectedValue) {
                linkDel.href = `environment.php?delete=${selectedValue}`;
            } else {
                linkDel.href = '#';
            }
        });
    </script>
    <?php include '../layout/js.php' ?>
</body>

</html>
