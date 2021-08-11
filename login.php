<?php 
session_start();
require "functions.php";

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    //ambil user berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM db_user WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan usernmane
    if($key === hash('sha256', $row['username'])){
        $_SESSION['isLogin'] = true; 
    }


}

if(isset($_SESSION["isLogin"]) === true){
    header("Location: index.php");exit;
}


if(isset($_POST["login"])){ 
    $username = $_POST["username"];
    $password = $_POST["password"]; 
     
    $result = mysqli_query($conn, "SELECT * FROM db_user WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            $_SESSION["isLogin"] = true;

            if(isset($_POST["remember"])){
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }

            header("Location: index.php");exit;
        }
        else{
            echo "
                <script>
                    alert('Gagal login');
                </script>
            ";  
        }
    }
    else{
        echo "
            <script>
                alert('Gagal login');
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
<h1>HALAMAN MASUK</h1>
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
            <input type="checkbox" name="remember" id="remember" required>
            <label for="remember">Remember me</label>
        </li>
        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </ul>
</form>    
</body>
</html>