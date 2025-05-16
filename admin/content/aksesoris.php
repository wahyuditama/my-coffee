<?php
include '../database/koneksi.php';
include '../layout/encryp.php';
session_start();


if (isset($_POST['submit'])) {
    $title = $_POST['judul'];
    $desk = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    if (!empty($_FILES['foto']['name'])) {
        $name_img = $_FILES['foto']['name'];
        $ukuran_file = $_FILES['foto']['size'];

        $ext = array('PNG', 'JPEG', 'JPG');
        $extpath = pathinfo($name_img, PATHINFO_EXTENSION);

        if (!in_array(strtoupper($extpath), $ext)) {
            echo "Format file foto yang diperbolehkan hanya PNG, JPEG, atau JPG.";
            die();
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], to: '../upload/' . $name_img);
            $insertacc = mysqli_query($koneksi, "INSERT INTO accessories (title,description,price,images) VALUES ('$title','$desk','$harga','$name_img')");
        }
    } else {
        $insertacc = mysqli_query($koneksi, "INSERT INTO accessories (title,description,price) VALUES('$title','$desk','$harga')");
    }
    // print_r($insertacc);
    // die();
    header("location:aksesoris.php?input=berhasil");
}

//Edit Data Suggestion
$id = isset($_GET['edit']) ? decryptId($_GET['edit'], $key) : '';
$editData = mysqli_query($koneksi, "SELECT * FROM accessories WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editData);

if (isset($_POST['edit'])) {
    $title = $_POST['judul'];
    $desk = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    if (!empty($_FILES['foto']['name'])) {
        $name_img = $_FILES['foto']['name'];
        $ukuran_file = $_FILES['foto']['size'];

        $ext = array('PNG', 'JPEG', 'jpg', 'png', 'jpeg', 'jpg');
        $extpath = pathinfo($name_img, PATHINFO_EXTENSION);

        if (!in_array($extpath, $ext)) {
            echo "Format file foto yang diperbolehkan hanya PNG, JPEG, atau JPG.";
            die();
        } else {
            unlink(filename: '../upload/' . $rowEdit['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], to: '../upload/' . $name_img);

            $updateData = mysqli_query($koneksi, "UPDATE accessories SET 
         title='$title',
         description='$desk',
        price='$harga',
         images='$name_img'
         WHERE id='$id'");
        }
    } else {
        $updateData = mysqli_query($koneksi, "UPDATE accessories SET 
         title='$title',
         description='$desk',
        price='$harga'
          WHERE id='$id'");
    }
    // print_r($updateData);
    // die();
    header("location: aksesoris.php?replace=success");
}

//Delete Data
if (isset($_GET['deleted'])) {
    $id_delete = decryptId($_GET['deleted'], $key);
    mysqli_query($koneksi, "DELETE FROM accessories WHERE id='$id_delete'");
}
//ambil data
$queryaccessories = mysqli_query($koneksi, "SELECT * FROM accessories ORDER BY id DESC");
$resultQuery = [];
while ($rowaccessories = mysqli_fetch_assoc($queryaccessories)) {
    $resultQuery[] = $rowaccessories;
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
                            <?php if (isset($_GET['tambah']) || isset($_GET['edit'])) : ?>
                                <div class="card">
                                    <div class="card-title d-flex justify-content-between p-3">
                                        <a href="#" class="text-secondary"><?php echo isset($_GET['tambah']) ? 'Tambah' : 'Edit' ?> Data</a>
                                        <a href="aksesoris.php?" class="btn btn-sm btn-secondary">Kembali</a>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <?php if (isset($_GET['edit']) && !isset($rowEdit['id'])): ?>
                                            <h5 class="text-danger">Data Tidak Ditemukan</h5>
                                        <?php else : ?>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="title" class="form-label mb-3">Masukan Title Disini</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            id="title"
                                                            name="judul"
                                                            value="<?php echo isset($_GET['edit']) ? $rowEdit['title'] : '' ?>"
                                                            required>
                                                        <label for="text" class="form-label my-3">Masukan Text deskripsi Disini</label>
                                                        <textarea type="text"
                                                            class="form-control"
                                                            id="deskripsi"
                                                            name="deskripsi"
                                                            value=""><?php echo isset($_GET['edit']) ? $rowEdit['description'] : '' ?></textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="title" class="form-label mb-3">Masukan Harga Disini</label>
                                                        <input type="number"
                                                            class="form-control"
                                                            id="harga"
                                                            name="harga"
                                                            value="<?php echo isset($_GET['edit']) ? $rowEdit['price'] : '' ?>">
                                                        <label for="images" class="form-label mt-3">Masukan foto disini (Optional)</label>
                                                        <input type="file"
                                                            class="form-control"
                                                            id="foto"
                                                            name="foto">
                                                        <img src="../upload/<?php echo $rowEdit['images'] ?>" class="mt-3" width="100" height="auto" alt="">
                                                    </div>

                                                </div>
                                                <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'submit' ?>" class="btn-md btn-primary mt-3"><?php echo isset($_GET['tambah']) ? 'Tambah' : 'Edit' ?></button>
                                            </form>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="col-sm-12">
                                    <div class="card p-4">
                                        <div class="row">
                                            <div class="card-title" align="right">
                                                <a href="?tambah" class="btn-sm btn-primary">tambah</a>
                                            </div>
                                            <?php foreach ($resultQuery as $val_accessories) : ?>
                                                <div class="col-md-2 text-center">
                                                    <div class="card p-3 border shadow-sm bg-body-tertiary rounded" style="height: 14rem;">
                                                        <img src="../upload/<?php echo $val_accessories['images'] ?>" class="mx-auto" width="100" alt="">
                                                        <div class="card-tile border-top my-2">
                                                            <p><?php echo $val_accessories['title'] ?></p>
                                                            <button type="button" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $val_accessories['id'] ?>">
                                                                Lihat Detail
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

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
            href="#"
            class="btn btn-buy-now-new text-white">Welcome to MY-Coffee</a>
    </div>
    <?php foreach ($resultQuery as $data) : $encrypt = encryptId($data['id'], $key) ?>
        <div class="modal fade" id="exampleModal<?php echo $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $data['title'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="../upload/<?php echo $data['images'] ?>" width="100" class="shadow bg-body-tertiary rounded " alt="">
                            </div>
                            <div class="col-md-8">
                                <div class="card-text">
                                    <p class="border-bottom pb-2" style="text-align:justify;"><?php echo $data['description'] ?></p>
                                    <p>harga : <?php echo $data['price'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php if ($_SESSION['level_id'] == 1): ?>
                            <a href="?edit=<?php echo urlencode($encrypt) ?>" class="btn btn-success mx-2 p-2"><span class=" bx bx-pencil"></span>Edit</a>
                            <a href="?deleted=<?php echo urlencode($encrypt) ?>" class="btn btn-danger p-2"><span class=" bx bx-trash"></span>Delete</a>
                        <?php endif ?>
                        <!-- <button <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>  -->
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <?php include '../layout/js.php' ?>
</body>

</html>