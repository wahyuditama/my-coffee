<?php
include '../database/koneksi.php';
session_start();
//Tambah user
if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $phone = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $idLevel = $_POST['level'];
    $email = $_POST['email'];

    $insert = mysqli_query($koneksi, "INSERT INTO user (id_level,username, phone, address, email) VALUES ('$idLevel','$username','$phone','$alamat','$email')");
    header("location: user.php?input=berhasil");
}
// print_r($insert);
// die();
//edit data user
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editData = mysqli_query($koneksi, "SELECT level.level_name, user.* FROM user LEFT JOIN level ON user.id_level = level.id
WHERE user.id ='$id'");

$rowEdit = mysqli_fetch_assoc($editData);

if (isset($_POST['edit'])) {
    $username   = $_POST['username'];
    $phone = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $email  = $_POST['email'];
    $idLevel = $_POST['level'];
    $update = mysqli_query($koneksi, "UPDATE user SET id_level='$idLevel', username='$username', phone='$phone', address='$alamat', email='$email' WHERE id='$id'");

    if ($_SESSION['user_id'] == 1) {
        header(header: "location:user.php?ubah=berhasil");
    } else {
        header("location: user.php?edit=$id");
    }
}

//Delet Data user

$id_hapus = isset($_GET['delete']) ? $_GET['delete'] : '';
if ($id_hapus) {
    mysqli_query($koneksi, "DELETE FROM user WHERE id='$id_hapus'");
    header("location: user.php?hapus=berhasil");
}
//Ambil data user
$queryuser = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC");

//Ambil data level
$level = mysqli_query($koneksi, "SELECT * FROM level ORDER BY id DESC");
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
                        <?php if (isset($_GET['edit']) || isset($_GET['tambah'])) : ?>
                            <div class="row">
                                <div class="card">
                                    <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> user</div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="" class="form-label">Nama user</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="username"
                                                        placeholder="Masukkan nama Pelanggan"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['username'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="" class="form-label">Nomor Telepon</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="telepon"
                                                        placeholder="Masukkan Nomor Telepon"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="" class="form-label">Alamat Pelanggan</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="alamat"
                                                        placeholder="Masukkan Alamat"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['address'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="" class="mb-1">Pilih Level</label>
                                                    <?php if ($_SESSION['user_id'] == 1): ?>
                                                        <select name="level" id="" class="form-control" <?php ($_SESSION['user_id'] == 2) ? 'disabled' : '' ?>>
                                                            <?php
                                                            while ($rowLevel = mysqli_fetch_assoc($level)) { ?>
                                                                <option value="<?php echo $rowLevel['id'] ?>" <?php echo isset($_GET['edit']) && $rowEdit['id_level'] == $rowLevel['id'] ? 'selected' : '' ?>>
                                                                    <?php echo $rowLevel['level_name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php else : ?>
                                                        <input type="text" name="" value="<?php echo isset($_GET['edit']) ? $rowEdit['level_name'] : '' ?>" class="form-control" readonly>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="" class="form-label">Masukkan Enail</label>
                                                    <input type="email"
                                                        class="form-control"
                                                        name="email"
                                                        placeholder="Masukkan Alamat Email"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                </div>

                                            </div>
                                            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn-sm btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between">
                                                <a href="?true" class="btn btn-sm mb-3">Data users</a>
                                                <a href="user.php?tambah" class="btn btn-primary btn-sm mb-3">Tambah user</a>
                                            </div>
                                            <?php if (isset($_GET['hapus'])): ?>
                                                <div class="alert alert-success" role="alert">
                                                    Data berhasil dihapus
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>No. Telp</th>
                                                        <th>Alamat</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    while ($rowuser = mysqli_fetch_assoc($queryuser)) { ?>
                                                        <tr>
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $rowuser['username'] ?></td>
                                                            <td><?php echo $rowuser['phone'] ?></td>
                                                            <td><?php echo $rowuser['address'] ?></td>
                                                            <td>
                                                                <a href="?edit=<?php echo $rowuser['id'] ?>" class="btn-sm btn-success bx bx-pencil"></a>
                                                                <a href="?delete=<?php echo $rowuser['id'] ?>" class="btn-sm btn-danger bx bx-trash"></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php endif ?>
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

    <?php include '../layout/js.php' ?>
</body>

</html>