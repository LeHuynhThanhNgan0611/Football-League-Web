<?php 
require 'db.php';
session_start();
$conn = create_connection();
if(isset($_POST['submit'])){
    $ctname=$_POST['ctname'];
    $vitri=$_POST['vitri'];
    $nationality=$_POST['nationality'];
    $birthday=$_POST['birthday'];
    $idteam=$_GET['id'];
    if(!empty($ctname)&&!empty($nationality)&&!empty($birthday)&&!empty($vitri)&&!empty($idteam)){
        $sql="INSERT INTO `cauthu` (`ctname`,`vitri`,`birthday`,`nationality`,`idteam`)VALUE('$ctname','$vitri','$birthday','$nationality','$idteam') ";
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
}
?>