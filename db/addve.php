<?php 
session_start();
require 'db.php';
$conn = create_connection();
if(isset($_POST['submit'])){
    $idmatch=$_POST['selectmatch'];
    $vethuong=$_POST['vethuong'];
    $vevip=$_POST['vevip'];
    if(!empty($idmatch)&&$vethuong>0&&$vevip>0){
        $sql="INSERT INTO `soluongve` (`idmatch`,`vethuong`,`vevip`,`status`) VALUE ('$idmatch','$vethuong','$vevip','Đang bán')";
        if($conn->query($sql)===TRUE){
            $sql2="UPDATE `lichthidau` SET `ve`=1 WHERE `idmatch`={$idmatch}";
            mysqli_query($conn,$sql2);
            $_SESSION['status']="DoneVe";
            header('Location:../ADve.php');
        } else {
            echo "Loi{$sql}".$conn->error;
        } 
    } else {
        $_SESSION['status']="ErrorVe";
        header('Location:../ADve.php');
    }
    echo "Lỗi";
}
?>