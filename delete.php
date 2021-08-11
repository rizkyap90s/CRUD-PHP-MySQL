<?php 
require "functions.php";

$getID = $_GET["id"];

if(delete($getID) > 0){
    echo "
        <script>
            alert('Data Deleted');
            document.location.href='index.php';
        </script>
    ";
}
else{
    echo "
        <script>
            alert('Fail');
            document.location.href='index.php';
        </script>
    ";
}

?>