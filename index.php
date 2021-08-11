<?php 
session_start();

if( isset($_SESSION["isLogin"]) === false){
    header("Location: login.php");exit;
}

require "functions.php";
$students = query("SELECT * FROM db_mahasiswa;");

if(isset($_POST["cari"])){
    $students = search($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .mr{
            margin-right: 10px;
        }
    </style>
</head>
<body>
<a class="mr" href="logout.php">logout</a>
<h1>HALAMAN UTAMA</h1>
<a class="mr" href="create.php">Add Data</a>
<a class="mr" href="index.php">All Data</a>

<form action="" method="POST">
    <input type="text" name="keyword" placeholder="Insert Keyword...">
    <button type="submit" name="cari">Search</button>
</form>
    <table border="1" cellspacing="0" cellpadding="20">
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>No. HP</th>
            <th>Foto</th>
            <th>Aksi</th>
        </thead>
        <?php $i=1; ?>
        <?php foreach($students as $student): ?>
        <tbody>
            <td><?= $i; ?></td>
            <td><?= $student["nama"]; ?></td>
            <td><?= $student["jurusan"]; ?></td>
            <td><?= $student["telpon"]; ?></td>
            <td><img style="width: 50px;" src="img/<?= $student["foto"]; ?>"></td>
            <td>
                <a href="edit.php?id=<?= $student["id"]; ?>">Edit</a> | 
                <a href="delete.php?id=<?= $student["id"]; ?>">Hapus</a>
            </td>
        </tbody>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>