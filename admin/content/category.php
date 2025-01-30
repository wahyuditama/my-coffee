<?php
include '../database/koneksi.php';
session_start();

// jika button simpan di tekan
if (isset($_POST['simpan'])) {
    $category = $_POST['name_category'];

    $insert = mysqli_query($koneksi, "INSERT INTO category (name_category) VALUES ('$category')");
    header("location: category.php?input=berhasil");
}


$id  = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM category WHERE id ='$id'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);


// jika button edit di klik

if (isset($_POST['edit'])) {
    $category  = $_POST['name_category'];

    $update = mysqli_query($koneksi, "UPDATE category SET name_category='$category' WHERE id='$id'");
    header("location:category.php?ubah=berhasil");
}

// munculkan / pilih sebuah atau semua kolom dari table user
$queryCategory = mysqli_query($koneksi, "SELECT * FROM category");
// mysqli_fetch_assoc($query) = untuk menjadikan hasil query menjadi sebuah data (object,array)

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; 

    // query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM category  WHERE id ='$id'");
    header("location:category.php?hapus=berhasil");
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
                            <?php if (isset($_GET['edit']) || isset($_GET['tambah'])) : ?>
                                <!-- Tambah & Edit Barang -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Kategori Barang</div>
                                        <div class="card-body">
                                            <?php if (isset($_GET['hapus'])): ?>
                                                <div class="alert alert-success" role="alert">
                                                    Data berhasil dihapus
                                                </div>
                                            <?php endif ?>

                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Nama Kategori</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="name_category"
                                                            placeholder="Masukkan nama kategori"
                                                            required
                                                            value="<?php echo isset($_GET['edit']) ? $rowEdit['name_category'] : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <!-- Tampilkan data level -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">Kategori Coffee</div>
                                        <div class="card-body">
                                            <?php if (isset($_GET['hapus'])): ?>
                                                <div class="alert alert-success" role="alert">

                                                </div>
                                            <?php endif ?>
                                            <div align="right" class="mb-3">
                                                <a href="category.php?tambah" class="btn btn-primary mt-2">Tambah</a>
                                            </div>
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama kategori</th>
                                                        <th>Aksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    while ($rowCategory = mysqli_fetch_assoc($queryCategory)) { ?>
                                                        <tr>
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $rowCategory['name_category'] ?></td>
                                                            <td>
                                                                <a href="category.php?edit=<?php echo $rowCategory['id'] ?>" class="btn btn-success btn-sm">
                                                                    <span class="tf-icon bx bx-pencil bx-18px "></span>
                                                                </a>
                                                                <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                                                    href="category.php?delete=<?php echo $rowCategory['id'] ?>" class="btn btn-danger btn-sm">
                                                                    <span class="tf-icon bx bx-trash bx-18px "></span>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>

                </div>
                <!-- Footer -->
                <?php include '../layout/footer.php' ?>
                <!-- / Footer -->
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

    <?php include '../layout/js.php' ?>
</body>

</html>
