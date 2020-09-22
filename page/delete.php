<?php
// // jika tak login..sign first
// if (!isset($_SESSION['login'])) {
//     header("Location:login.php");
//     exit;
// }
require '../functions.php';

$id = $_GET["id"];

if (delete($id) > 0) {
    echo "<script>
    alert('Data has Deleted');
    document.location.href='../index.php?page=home';
    </script>";
}else{
    echo "<script>
    alert('Data has Failed Deleted');
    document.location.href='../index.php?page=home';
    </script>";
}
 