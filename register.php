<?php 
require "functions.php";

if(isset($_POST["daftar"])){
    if(register($_POST) > 0){
        echo "
            <script>
                alert('Success registered');
                document.location.href='index.php';
            </script>
        ";
    }
    else{
        echo "
            <script>
                alert('Fail added');
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
<h1>HALAMAN DAFTAR</h1>
<form action="" method="POST">
    <ul>
        <li>
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" required>
        </li>
        <li>
            <label for="password2">Konfirmasi Password :</label>
            <input type="password" name="password2" id="password2" required>
        </li>
        <li>
            <button type="submit" name="daftar">Sign up</button>
        </li>
    </ul>


</form>
    
</body>
</html>