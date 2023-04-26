<?php
require 'db.php';
$conn = create_connection();
$id=$_GET['id'];
$sql="DELETE FROM `thongtindoi` where `idteam`={$id}";
if(!mysqli_query($conn,$sql)){
    die('Connect fail'.mysqli_error($conn));
}
header("Location:../ADdoi.php");
echo "thanhcong";
?>