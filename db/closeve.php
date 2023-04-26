<?php
    session_start();
    require 'db.php';
    $conn = create_connection();
    $idmatch=$_POST['submit'];
    $sql="UPDATE `soluongve` SET `status`='Dừng bán' WHERE `idmatch`='$idmatch'";
    if($conn->query($sql)===TRUE){
        $_SESSION['status']="CloseVe";
        header('Location:../ADve.php');
    } else {
        echo "Loi{$sql}".$conn->error;
    }
?>