<?php

// jika tak login..sign first
if (!isset($_SESSION['login'])) {
    header("Location:login.php");
    exit;
}
// check buttom submit ditekan atau belum
if (isset($_POST['submit'])) {
    // function add->ambil data dalam form->masuk dalam function tambah ->catch oleh $data
    // $_post -> $data
    // nilai 1 =berjaya
    // nilai -1 =gagal
    if (add($_POST) > 0) {
        echo "<script>
        alert('Data has Added');
        document.location.href='index.php?page=home';
        </script>";
    } else {
        echo "<script>
        alert('Data has Failed Added');
        document.location.href='index.php?page=home';
        </script>";
    }
}
?>
<div class="halaman">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Add Student
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="matrix_no">No Matrix</label>
                        <input type="text" class="form-control" name="stud_no" id="matrix_no" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="stud_name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="stud_email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="stud_course">
                            <option value="IT">IT</option>
                            <option value="ELECTRONIC">ELECTRONIC</option>
                            <option value="BUSINESS">BUSINESS</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stud_gender" value="Male" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Male
                        </label>
                        <br>
                        <input class="form-check-input" type="radio" name="stud_gender" value="Female">
                        <label class="form-check-label" for="exampleRadios1">
                            Female
                        </label>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" name="stud_image" id="image">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>