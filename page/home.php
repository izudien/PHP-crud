<?php
$student = query("SELECT * FROM student ORDER BY id DESC");


// button search ditekan
if (isset($_POST["search"])) {
    $student = search($_POST["keyword"]);
}
?>
<div class="halaman container">
    <div class="card mt-4">
        <div class="card-header ml">
            <form action="" method="post">
                <input type="text" name="keyword" id="" size="40" autofocus="" autocomplete="off">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Images</th>
                        <th>Matrix No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Courses</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($student as $students) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><img src="images/<?= $students['stud_image'] ?>" style="height:70px"></td>
                            <td><?= $students['stud_no'] ?></td>
                            <td><?= $students['stud_name'] ?></td>
                            <td><?= $students['stud_email'] ?></td>
                            <td><?= $students['stud_course'] ?></td>
                            <td><?= $students['stud_gender'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $students['id'] ?>" class="btn btn-success btn-sm">EDIT</a> |
                                <a href="page/delete.php?id=<?= $students['id'] ?>" onclick="return confirm('DELETED??');" class="btn btn-danger btn-sm">Delete</a>
                            </td>

                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>