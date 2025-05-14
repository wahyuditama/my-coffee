<?php
include '../database/koneksi.php';
include '../layout/encryp.php';

session_start();

if (isset($_POST['submit'])) {
    $nama = $_POST['username'];
    $title = $_POST['title'];
    $desk = $_POST['deskripsi'];

    if (!empty($_FILES['foto']['name'])) {
        $name_img = $_FILES['foto']['name'];
        $ukuran_file = $_FILES['foto']['size'];

        $ext = array('PNG', 'JPEG', 'JPG');
        $extpath = pathinfo($name_img, PATHINFO_EXTENSION);

        if (!in_array(strtoupper($extpath), $ext)) {
            echo "Format file gambar yang diperbolehkan hanya PNG, JPEG, atau JPG.";
            die();
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], to: '../upload/' . $name_img);
            $insert = mysqli_query($koneksi, "INSERT INTO about (username,title,suggestion,foto) VALUES ('$nama','$title','$desk','$name_img')");
        }
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO about (username,title,suggestion) VALUES('$nama','$title','$desk')");
    }
    header("location: section-about.php?input=berhasil");
}

//Edit Data Suggestion
$id = isset($_GET['edit']) ? decryptId($_GET['edit'], $key) : '';
$editData = mysqli_query($koneksi, "SELECT * FROM about WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editData);

if (isset($_POST['edit'])) {
    $nama = $_POST['username'];
    $title = $_POST['title'];
    $desk = $_POST['deskripsi'];

    if (!empty($_FILES['foto']['name'])) {
        $name_img = $_FILES['foto']['name'];
        $ukuran_file = $_FILES['foto']['size'];

        $ext = array('PNG', 'JPEG', 'jpg', 'png', 'jpeg', 'jpg');
        $extpath = pathinfo($name_img, PATHINFO_EXTENSION);

        if (!in_array($extpath, $ext)) {
            echo "Format file gambar yang diperbolehkan hanya PNG, JPEG, atau JPG.";
            die();
        } else {
            unlink(filename: '../upload/' . $rowEdit['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], to: '../upload/' . $name_img);

            $updateData = mysqli_query($koneksi, "UPDATE about SET 
            username='$nama',
            title='$title',
            suggestion='$desk',
            foto='$name_img'
            WHERE id='$id'");
        }
    } else {
        $updateData = mysqli_query($koneksi, "UPDATE about SET username='$nama', title='$title', suggestion='$desk' WHERE id='$id'");
    }
    header("location: section-about.php?replace=success");
}

//Delete
if (isset($_GET['delete'])) {
    $id_delete = decryptId($_GET['delete'], $key);
    mysqli_query($koneksi, "DELETE FROM about WHERE id='$id_delete'");
}
//ambil data
$queryAbout = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC");
$resultQuery = [];
while ($rowAbout = mysqli_fetch_assoc($queryAbout)) {
    $resultQuery[] = $rowAbout;
}

?>

<!DOCTYPE html>
<!DOCTYPE html>

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
                                <!-- Tambah & Edit Sugesstion -->
                                <div class="card">
                                    <div class="card-title"><?php echo isset($_GET['tambah']) ? 'Tambah' : 'Edit' ?> Saran & Masukan</div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="username" class="form-label mb-3">Masukan Nama Anda</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        id="username"
                                                        name="username"
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['username'] : '' ?>"
                                                        required>
                                                    <label for="title" class="form-label mt-3">Masukan title </label>
                                                    <input type="text"
                                                        class="form-control"
                                                        id="title"
                                                        name="title"
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['title'] : '' ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="deskripsi" class="form-label mb-3">Masukan Deskripsi Saran & Masukan</label>
                                                    <?php if (isset($_GET['edit'])): ?>
                                                        <textarea name="deskripsi" id="" class="form-control" value=""><?php echo isset($_GET['edit']) ? $rowEdit['suggestion'] : '' ?></textarea>
                                                    <?php else: ?>
                                                        <input type="deskripsi"
                                                            class="form-control"
                                                            id="deskripsi"
                                                            name="deskripsi"
                                                            required>
                                                    <?php endif ?>
                                                    <label for="foto" class="form-label mt-3">Masukan foto anda (Optional)</label>
                                                    <input type="file"
                                                        class="form-control"
                                                        id="foto"
                                                        name="foto">
                                                    <img src="../upload/<?php echo $rowEdit['foto'] ?>" class="mt-3" width="100" height="auto" alt="">
                                                </div>
                                            </div>
                                            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'submit' ?>" class="btn-md btn-primary mt-3"><?php echo isset($_GET['tambah']) ? 'Tambah' : 'Edit' ?></button>
                                        </form>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="card">
                                    <div class="card-title">
                                        <a href="?tambah">tambah</a>
                                    </div>
                                    <div class="row my-3">
                                        <?php
                                        foreach ($resultQuery as $rowAbout) : ?>
                                            <div class="col-md-6">
                                                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded" height="40">
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <img src="../upload/<?php echo $rowAbout['foto'] ?>" class="card shadow-lg bg-body-tertiary" width="100" height="auto" alt="">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <h5><?php echo $rowAbout['username'] ?></h5>
                                                            <p class="border-bottom"><?php echo $rowAbout['title'] ?></p>
                                                            <p>
                                                                <button class="btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample<?php echo $rowAbout['id'] ?>" aria-expanded="false" aria-controls="collapseWidthExample">
                                                                    Lihat Komentar
                                                                </button>
                                                            </p>
                                                            <div style="">
                                                                <div class="collapse collapse-horizontal" id="collapseWidthExample<?php echo $rowAbout['id'] ?>">
                                                                    <div class="card card-body" style="text-align: justify;">
                                                                        <?php echo $rowAbout['suggestion'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card mt-3">
                                                        <?php if ($_SESSION['level_id'] == 1) : ?>
                                                            <div class="col-md-12 border-top pt-3" align="right">
                                                                <a href="?edit=<?php echo $rowAbout['id'] ?>" class="btn-sm btn-success mx-2" width="20">
                                                                    <span class="tf-icon bx bx-pencil bx-18px "></span>
                                                                </a>
                                                                <a onclick="return confrim ('sure you want to delete?')" href="?delete=<?php echo $rowAbout['id'] ?>" class="btn-sm btn-danger" width="20">
                                                                    <span class="tf-icon bx bx-trash bx-18px "></span>
                                                                </a>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

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


    <?php include '../layout/js.php' ?>

</body>

</html>