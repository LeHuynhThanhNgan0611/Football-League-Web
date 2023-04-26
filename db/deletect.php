<?php
require 'db.php';
$conn = create_connection();
session_start();
$idct=$_GET['id'];
$idteam="SELECT * FROM `cauthu` where `idct`={$idct}";
$result=mysqli_query($conn,$idteam);
if(!$result)
{
    die('lỗi'.mysqli_error($conn));
}
$row=mysqli_fetch_assoc($result);
$sql="DELETE FROM `cauthu` where `idct`={$idct}";
if(!mysqli_query($conn,$sql)){
    die('Connect fail'.mysqli_error($conn));
}
$_SESSION['status']="DoneCt";
header("Location:../ADchitietdoi.php?id=".$row['idteam']);
?>