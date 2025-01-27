 <?php
    include '../database/koneksi.php';
    session_start();


    if (isset($_POST['submit'])) {
        $title = $_POST['judul'];
        $sub_judul = $_POST['sub_judul'];
        $artikel = $_POST['artikel'];
        $desk = $_POST['deskripsi'];

        if (!empty($_FILES['gambar']['name'])) {
            $name_img = $_FILES['gambar']['name'];
            $ukuran_file = $_FILES['gambar']['size'];

            $ext = array('PNG', 'JPEG', 'JPG');
            $extpath = pathinfo($name_img, PATHINFO_EXTENSION);

            if (!in_array(strtoupper($extpath), $ext)) {
                echo "Format file gambar yang diperbolehkan hanya PNG, JPEG, atau JPG.";
                die();
            } else {
                move_uploaded_file($_FILES['gambar']['tmp_name'], to: '../upload/' . $name_img);
                $insertSer = mysqli_query($koneksi, "INSERT INTO services (title,sub_title,article,description,images) VALUES ('$title','$sub_judul','$artikel','$desk','$name_img')");
            }
        } else {
            $insertSer = mysqli_query($koneksi, "INSERT INTO services (title,sub_title,article,description) VALUES('$title','$sub_judul','$artikel','$desk')");
        }

        header("location:services.php?input=berhasil");
    }

    //Edit Data Suggestion
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';
    $editData = mysqli_query($koneksi, "SELECT * FROM services WHERE id='$id'");
    $rowEdit = mysqli_fetch_assoc($editData);

    if (isset($_POST['edit'])) {
        $title = $_POST['judul'];
        $sub_judul = $_POST['sub_judul'];
        $artikel = $_POST['artikel'];
        $desk = $_POST['deskripsi'];

        if (!empty($_FILES['gambar']['name'])) {
            $name_img = $_FILES['gambar']['name'];
            $ukuran_file = $_FILES['gambar']['size'];

            $ext = array('PNG', 'JPEG', 'jpg', 'png', 'jpeg', 'jpg');
            $extpath = pathinfo($name_img, PATHINFO_EXTENSION);

            if (!in_array($extpath, $ext)) {
                echo "Format file gambar yang diperbolehkan hanya PNG, JPEG, atau JPG.";
                die();
            } else {
                unlink(filename: '../upload/' . $rowEdit['gambar']);
                move_uploaded_file($_FILES['gambar']['tmp_name'], to: '../upload/' . $name_img);

                $updateData = mysqli_query($koneksi, "UPDATE services SET 
            title='$title',
            sub_title='$sub_judul',
            article = '$artikel',
            description='$desk',
            images='$name_img'
            WHERE id='$id'");
            }
        } else {
            $updateData = mysqli_query($koneksi, "UPDATE services SET 
            title='$title',
            sub_title='$sub_judul',
            article = '$artikel',
            description='$desk'
             WHERE id='$id'");
        }
        // print_r($updateData);
        // die();
        header("location: services.php?replace=success");
    }

    //Delete Data
    if (isset($_GET['deleted'])) {
        $id_delete = $_GET['deleted'];
        mysqli_query($koneksi, "DELETE FROM services WHERE id='$id_delete'");
    }
    //ambil data
    $queryservices = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id DESC");
    $resultQuery = [];
    while ($rowservices = mysqli_fetch_assoc($queryservices)) {
        $resultQuery[] = $rowservices;
    }
    ?> -
 <!DOCTYPE html>

 <!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* services Page: https://themeselection.com/servicess/sneat-bootstrap-html-admin-template/
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
                                     <div class="card-title border-bottom p-3 d-flex justify-content-between">
                                         <a class="btn-md "><?php echo isset($_GET['tambah']) ? 'Tambah' : 'Edit' ?> Saran & Masukan</a>
                                         <a href="?" class="btn-sm btn-secondary ml-3 p-2 rounded">Kembali</a>
                                     </div>
                                     <div class="card-body">
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
                                                     <label for="title" class="form-label mt-3">Masukan Sub-Title </label>
                                                     <textarea type="text"
                                                         class="form-control"
                                                         id="sub_judul"
                                                         name="sub_judul"
                                                         value=""><?php echo isset($_GET['edit']) ? $rowEdit['sub_title'] : '' ?></textarea>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <label for="title" class="form-label mb-3">Masukan Text Artikel Disini</label>
                                                     <textarea type="text"
                                                         class="form-control"
                                                         id="artikel"
                                                         name="artikel"
                                                         value=""><?php echo isset($_GET['edit']) ? $rowEdit['article'] : '' ?></textarea>
                                                     <label for="title" class="form-label my-3">Masukan Text deskripsi Disini</label>
                                                     <textarea type="text"
                                                         class="form-control"
                                                         id="deskripsi"
                                                         name="deskripsi"
                                                         value=""><?php echo isset($_GET['edit']) ? $rowEdit['description'] : '' ?></textarea>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <label for="images" class="form-label mt-3">Masukan gambar disini (Optional)</label>
                                                     <input type="file"
                                                         class="form-control"
                                                         id="gambar"
                                                         name="gambar">
                                                     <img src="../upload/<?php echo $rowEdit['images'] ?>" class="mt-3" width="100" height="auto" alt="">
                                                 </div>

                                             </div>
                                             <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'submit' ?>" class="btn-md btn-primary mt-3"><?php echo isset($_GET['tambah']) ? 'Tambah' : 'Edit' ?></button>
                                         </form>
                                     </div>
                                 </div>
                             <?php else : ?>
                                 <div class="card p-3">
                                     <div class="row">
                                         <div class="card-title border-bottom p-3 shadow-sm bg-socondary d-flex justify-content-between" align="right">
                                             <a href="">Servicescape :</a>
                                             <a href="?tambah" class="btn-sm btn-primary">tambah</a>
                                         </div>
                                         <?php foreach ($resultQuery as $val_services) : ?>
                                             <div class="col-md-4">
                                                 <div class="card" style="height: 12rem;">
                                                     <div class="card-title px-3 border-bottom">
                                                         <h5><?php echo $val_services['title'] ?></h5>
                                                     </div>
                                                     <div class="card-title px-3 border-bottom"><?php echo $val_services['sub_title'] ?></div>
                                                     <div class="row mx-2 my-1">
                                                         <div class="col-md-6">
                                                             <button type="button" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $val_services['id'] ?>">
                                                                 Launch demo modal
                                                             </button>
                                                         </div>
                                                         <div class="col-md-6 mt-2">
                                                             <a href="?edit=<?php echo $val_services['id'] ?>" class="btn-sm btn-success mx-2 p-2"><span class=" bx bx-pencil"></span></a>
                                                             <a href="?deleted=<?php echo $val_services['id'] ?>" class="btn-sm btn-danger p-2"><span class=" bx bx-trash"></span></a>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         <?php endforeach ?>
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
             href="https://themeselection.com/servicess/sneat-bootstrap-html-admin-template/"
             target="_blank"
             class="btn btn-danger btn-buy-now">Welcome to MY-Coffee</a>
     </div>
     <?php foreach ($resultQuery as $val) : ?>
         <div class="modal fade" id="exampleModal<?php echo $val['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-md-4">
                                 <img src="../upload/<?php echo $val['images'] ?>" width="100" alt="">
                             </div>
                             <div class="col-md-8" class="text-justify">
                                 <p><?php echo $val['article'] ?></p>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                     </div>
                 </div>
             </div>
         </div>
     <?php endforeach ?>
     <?php include '../layout/js.php' ?>
 </body>

 </html>