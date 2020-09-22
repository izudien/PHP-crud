<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location:login.php");
    exit;
}
require 'functions.php';
// ambil data di url
$id = $_GET['id'];

// query/ambi data berdasarkan id
// kerana guna function query =data out jenis array nummerik;
// kena ambil array luar dulu
/*
array(1) {
    [0]=>
    array(7) {
      ["id"]=>
      string(1) "1"
      ["stud_no"]=>
      string(12) "12dip14f1064"
      ["stud_name"]=>
      string(15) "Azman bin Mamat"
      ["stud_email"]=>
      string(15) "azman@gmail.com"
      ["stud_course"]=>
      string(2) "IT"
      ["stud_image"]=>
      string(9) "azman.png"
      ["stud_gender"]=>
      string(4) "Male"
    }
  }
*/
$student = query("SELECT * FROM student WHERE id=$id")[0];



// check buttom submit ditekan atau belum
if (isset($_POST['submit'])) {

    // function add->ambil data dalam form->masuk dalam function tambah ->catch oleh $data
    // $_post -> $data
    // nilai 1 =berjaya
    // nilai -1 =gagal
    if (edit($_POST) > 0) {
        echo "<script>
        alert('Data has Edited');
        document.location.href='index.php?page=home';
        </script>";
    } else {
        echo "<script>
        alert('Data has Failed Edited');
        document.location.href='index.php?page=home';
        </script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Student Management</title>
</head>

<body>
    <div class="halaman">
        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    Add Student
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $student['id'] ?>">
                        <!-- kirim nama file lama jika tak ubah -->
                        <input type="hidden" name="old_image" value="<?= $student['stud_image'] ?>">

                        <div class="form-group">
                            <label for="matrix_no">No Matrix</label>
                            <input type="text" class="form-control" name="stud_no" id="matrix_no" required value="<?= $student['stud_no'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="stud_name" id="name" required value="<?= $student['stud_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="stud_email" id="email" value="<?= $student['stud_email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Example select</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="stud_course">
                                <option <?php if ($student['stud_course'] == "IT") echo 'selected'; ?> value="IT">IT</option>
                                <option <?php if ($student['stud_course'] == "ELECTRONIC") echo 'selected'; ?> value="ELECTRONIC">ELECTRONIC</option>
                                <option <?php if ($student['stud_course'] == "BUSINESS") echo 'selected'; ?> value="BUSINESS">BUSINESS</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stud_gender" value="Male" <?php if ($student['stud_gender'] == "Male") echo 'checked'; ?> checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Male
                            </label>
                            <br>
                            <input class="form-check-input" type="radio" name="stud_gender" value="Female" <?php if ($student['stud_gender'] == "Female") echo 'checked'; ?>>
                            <label class="form-check-label" for="exampleRadios1">
                                Female
                            </label>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <br>
                                <img src="images/<?= $student['stud_image']; ?>" width="100" class="mb-2">
                                <input type="file" class="form-control-file" name="stud_image" id="image">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
</body>