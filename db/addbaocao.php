<?php 
session_start();
require 'db.php';
$conn = create_connection();
if(isset($_POST['submit'])){
    $title=$_POST['tieude'];
    $content=$_POST['noidung'];
    $user= $_SESSION['user'];
    
    if(!empty($title)&&!empty($content)){
        $sql="INSERT INTO `baocao` (`user`,`title`,`content`,`date`) VALUEs ('$user','$title','$content',NOW())";
            mysqli_query($conn,$sql);
            $_SESSION['status']="DoneBC";
            header('Location:../ADbaocao.php');

    } else {
        $_SESSION['status']="ErrorBC";
        header('Location:../ADbaocao.php');
    }   
    }
    else {
        echo "Lỗi";
    }

?>