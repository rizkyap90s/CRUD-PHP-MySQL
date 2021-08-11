<?php 
$conn = mysqli_connect("localhost","root", "", "phpdasar");

function query ($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = [];
    while($data = mysqli_fetch_assoc($result)){
        $row[]=$data;
    }
    return $row;
}

function add($add){
    global $conn;
    $nama = htmlspecialchars($add["nama"]);
    $jurusan = htmlspecialchars($add["jurusan"]);
    $telpon = htmlspecialchars($add["telpon"]);
    
    $foto = upload();
    if(!$foto){
        return false;
    }

    $query = "INSERT INTO db_mahasiswa VALUES
    (null, '$nama', '$jurusan', '$telpon', '$foto');";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $nameFile = $_FILES['foto']["name"];
    $sizeFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];
    
    //sudah pilih foto apa belum? 
    if($error === 4){
        echo "
            <script>
                alert('Anda belum memilih gambar');
            </script>
        ";
        return false;
    }

    //yg di upload foto apa bukan?
    $ekstensiFotoValid = ['jpg','jpeg', 'png'];
    $ekstensiFoto = explode('.', $nameFile);
    $ekstensiFinal = strtolower(end($ekstensiFoto));
    
    if(!in_array($ekstensiFinal, $ekstensiFotoValid)){
        echo "
            <script>
                alert('Yang anda masukkan bukan gambar');
            </script>
        ";
        return false;
    }

    //ukuran foto
    if($sizeFile > 1000000){
        echo "
            <script>
                alert('Ukuran foto terlalu besar');
            </script>
        ";
        return false;
    }

    //siap upload
    move_uploaded_file($tmpName, 'img/'.$nameFile);
    return $nameFile;
}

function delete($id){
    global $conn;
    $query = "DELETE FROM db_mahasiswa WHERE id=$id;";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit($edit){
    global $conn;
    $id =  $edit['id'];
    $nama = $edit['nama'];
    $jurusan = $edit['jurusan'];
    $telpon = $edit['telpon'];
    $foto = $edit['foto'];

    $query = "UPDATE db_mahasiswa SET
    nama = '$nama',
    jurusan = '$jurusan',
    telpon = '$telpon',
    foto = '$foto'
    WHERE id = $id;
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function search($keyword){

    $query = "SELECT * FROM db_mahasiswa WHERE
    nama LIKE '%$keyword%'OR
    jurusan LIKE '%$keyword%'OR
    telpon LIKE '%$keyword%'
    ";
    return query($query);
}

function register($data){
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT * FROM db_user WHERE username='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "
            <script>
                alert('Username already exist');
            </script>
        ";
        return false;
    }

    if(!$password === $password2){
        echo "
            <script>
                alert('Periksa kembali konfirmasi password');
            </script>
        ";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT); 

    $query = "INSERT INTO db_user VALUES 
    (null, '$username', '$password');
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


?>