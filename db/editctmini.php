<?php 
require 'db.php';
session_start();
$conn = create_connection();
    $value=$_POST['submit'];
    $idct=substr($value,2,);
    $ctname=$_POST['ctname2'];
    $vitri=$_POST['vitri2'];
    $nationality=$_POST['nationality2'];
    $birthday=$_POST['birthday2'];
    $idteam=$_GET['id'];
    if(!empty($ctname)&&!empty($nationality)&&!empty($birthday)&&!empty($vitri)){
        $sql="UPDATE `cauthu` SET `ctname`='$ctname',`vitri`='$vitri',`birthday`='$birthday',`nationality`='$nationality' WHERE `idct`='$idct'";
        if($conn->query($sql)===TRUE){
            $_SESSION['status']="DoneCt";
            header('Location:../ADchitietdoi.php?id='.$idteam);
        } else {
            echo "Loi{$sql}".$conn->error;
        }
    } else{
        $_SESSION['status']="ErrorCt";
        header('Location:../ADchitietdoi.php?id='.$idteam);
    }
?>