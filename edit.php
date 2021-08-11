<?php 
require "functions.php";
$ID = $_GET["id"];
$student = query("SELECT * FROM db_mahasiswa WHERE id=$ID;")[0];

if(isset($_POST["edit"])){
    if(edit($_POST) > 0){
        echo "
        <script>
            alert('Data Updated');
            document.location.href='index.php';
        </script>
        ";
    }
    else{
        echo "
        <script>
            alert('Fail Updated');
            // document.location.href='index.php';
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
<h1>HALAMAN EDIT</h1>
    <form action="" method="POST">
        <ul>
            <input type="hidden" name="id" value="<?= $student["id"]; ?>">
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" value="<?= $student["nama"]; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $student["jurusan"]; ?>">
            </li>
            <li>
                <label for="telpon">Telpon : </label>
                <input type="text" name="telpon" id="telpon" value="<?= $student["telpon"]; ?>">
            </li>
            <li>
                <label for="foto">Foto : </label>
                <input type="text" name="foto" id="foto" value="<?= $student["foto"]; ?>">
            </li>
            <li>
                <button type="submit" name="edit">Save</button>
            </li>
            

        </ul>
    </form>
    
</body>
</html>