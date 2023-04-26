<?php 
require 'db.php';
session_start();
$conn = create_connection();
    $value=$_POST['submit'];
    $idct=substr($value,2,);
    $ctname=$_POST['ctname'];
    $vitri=$_POST['vitri'];
    $nationality=$_POST['nationality'];
    $birthday=$_POST['birthday'];
    $idteam=$_POST['idteam'];
    if(!empty($ctname)&&!empty($nationality)&&!empty($birthday)&&!empty($vitri)&&!empty($idteam)){
        $sql="UPDATE `cauthu` SET `ctname`='$ctname',`vitri`='$vitri',`birthday`='$birthday',`nationality`='$nationality',`idteam`='$idteam' WHERE `idct`='$idct'";
        if($conn->query($sql)===TRUE){
            $_SESSION['status']="DoneCt";
            header('Location:../ADct.php');
        } else {
            echo "Loi{$sql}".$conn->error;
        }
    } else{
        $_SESSION['status']="ErrorCt";
        header('Location:../ADct.php');
    }
?>