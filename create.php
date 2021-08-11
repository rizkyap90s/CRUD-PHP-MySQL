<?php 
require "functions.php";

if(isset($_POST["add"])){

    if(add($_POST) > 0){
        echo "
            <script>
                alert('Success Added');
                document.location.href='index.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
                alert('Fail Added');
                document.location.href='create.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>HALAMAN TAMBAH</h1>
<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama">
        </li> 
        <li>
            <label for="jurusan">Jurusan : </label>
            <input type="text" name="jurusan" id="jurusan">
        </li> 
        <li>
            <label for="telpon">Telpon : </label>
            <input type="text" name="telpon" id="telpon">
        </li>
        <li>
            <label for="foto">Foto : </label>
            <input type="file" name="foto" id="foto">
        </li>     
        <li>
            <button type="submit" name="add">Add</button>
        </li>
    </ul> 
</form>  
</body>
</html>