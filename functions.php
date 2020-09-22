<?php 
// Create connection
$conn = mysqli_connect("localhost", "root", "", "crud_php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];  //array kosong untuk letak setiap row yang diambil di table student
    // ambil data(fetch) student dari object result
    // mysqli_fetch_row = return array numerik
    // mysqli_fetch_row = return array numerik
    // mysqli_fetch_array = return array associative dan numerik
    // mysqli_fetch_object = return array numerik
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function add($data)
{
    global $conn;
    // ambil data dari setiap elemen/input dari form
    $stud_no = htmlspecialchars($data['stud_no']);
    $stud_name = htmlspecialchars($data['stud_name']);
    $stud_email = htmlspecialchars($data['stud_email']);
    $stud_course = $data['stud_course'];
    $stud_gender = $data['stud_gender'];


    // call function upload dulu
    // kalau success ->1.nama gambar dalam database  2.file gambar dalam folder
    // $stud_image =nama file
    $stud_image = upload();
    if (!$stud_image) {
        return false;
        // query insert tidak dijalankan sebab false
    }

    //query insert data
    $query = "INSERT INTO student
             VALUES
             (null,'$stud_no','$stud_name','$stud_email','$stud_course','$stud_image','$stud_gender')";
    mysqli_query($conn, $query);

    // akan return mysqli_affected_rows ke add.php
    return mysqli_affected_rows($conn);
}

function upload()
{
    $nameFile = $_FILES['stud_image']['name'];
    $sizeFile = $_FILES['stud_image']['size'];
    $errorFile = $_FILES['stud_image']['error'];
    // ["tmp_name"]=> tempat penyimpanan sementara
    $tmpName = $_FILES['stud_image']['tmp_name'];

    // check upload gambar atau tak
    // Value: 4; No file was uploaded. 
    // http://php.net/manual/en/features.file-upload.errors.php
    if ($errorFile === 4) {
        echo "<script>
        alert('Upload Images First');
        </script>";
        // setelah error display.stop function upload
        // function upload gagal.maka function add gagal juga
        return false;
    }

    // check yang diupload oleh user gambar atau bukan
    // simapn dalam array..mudah utk check
    $extensionImageValid = ['jpg', 'png', 'jpeg'];
    // ambil extension gambar dulu

    // explode= funsi untuk memecahkan string menjadi array
    // izudin.png =['izudin','png']
    $extensionImage = explode('.', $nameFile);
    // izudin.izu.png = end akan ambil yang paling akhir =png.
    //  izudin.izu.PNG = strtolower akan ubah jadi huruf kecil.\\ PNG = png ->beza.
    $extensionImage = strtolower(end($extensionImage));
    // in_array =check sebuah string dalam sebauah array
    if (!in_array($extensionImage, $extensionImageValid)) {
        echo "<script>
        alert('Your Upload is is Valid Image');
        </script>";

        // setelah error display.stop function upload
        // function upload gagal.maka function add gagal juga
        return false;
    }


    // check size image
    if ($sizeFile > 1000000) {
        echo "<script>
        alert('Your Size Image is more than 1mb');
        </script>";

        // setelah error display.stop function upload
        // function upload gagal.maka function add gagal juga
        return false;
    }

    // jika tiada error..images akan diupload
    // generate namafile baru
    // uniqid() =generate string random
    $newNameFile = uniqid();
    $newNameFile .= '.';
    $newNameFile .= $extensionImage;
    move_uploaded_file($tmpName, 'images/' . $newNameFile);

    return $newNameFile;
}




function delete($id)
{
    global $conn;
    $query = "DELETE FROM student WHERE id=$id";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function edit($data)
{
    global $conn;
    // ambil data dari setiap elemen/input dari form
    $id = $data['id'];
    $stud_no = htmlspecialchars($data['stud_no']);
    $stud_name = htmlspecialchars($data['stud_name']);
    $stud_email = htmlspecialchars($data['stud_email']);
    $stud_course = $data['stud_course'];
    $stud_gender = $data['stud_gender'];
    $old_image = $data["old_image"];

    // check apakah gambar diupadte atau tidak
    if ($_FILES['stud_image']['error'] === 4) {
        $stud_image = $old_image;
    } else {
        $stud_image = upload();
    }


    //query insert data
    $query = "UPDATE student SET
             stud_no='$stud_no',
             stud_name='$stud_name',
             stud_email='$stud_email',
             stud_course='$stud_course',
             stud_image='$stud_image',
             stud_gender='$stud_gender'
             WHERE id=$id
             ";

    mysqli_query($conn, $query);

    // akan return mysqli_affected_rows ke add.php
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM student 
             WHERE 
             stud_name LIKE '%$keyword%' OR
             stud_no LIKE '%$keyword%' OR 
             stud_email LIKE '%$keyword%' OR 
             stud_course LIKE '%$keyword%'
             ";

    return query($query);
}


function register($data)
{
    global $conn;
    // removes backslashes added =stripslashes
    // escapes special characters in a string for use in an SQL statement. = mysqli_real_escape_string(connection,escapestring);
    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password_confirm = mysqli_real_escape_string($conn, $data['password_confirm']);

    // check username ada atau belum
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username ='$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script> 
        alert('Username Has Been register');
        </script>";
        return false;
    }

    // check confirm password
    if ($password !== $password_confirm) {
        echo "<script> 
        alert('Password not Matched');
        </script>";
        return false;
    }

    // encryption password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query(
        $conn,
        "INSERT INTO users
                VALUES(
                null,'$username','$password')"
    );

    return mysqli_affected_rows($conn);
}
