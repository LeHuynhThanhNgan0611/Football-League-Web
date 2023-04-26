<?php
session_start();
require 'db.php';
$conn = create_connection();
if(isset($_POST['submit'])){
    $teamname=$_POST['teamname'];
    $hlvname=$_POST['hlvname'];
    $file = $_FILES['file'];
    
    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];
    $fileExt = explode(".",$fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array ("jpg", "jpeg", "png");

    if (in_array ($fileActualExt, $allowed)) {
        if ($fileError === 0){
            $imageFullName = uniqid("",true).".".$fileActualExt;
            $fileDestination = "../img/gallery/".$imageFullName;
            if(!empty($teamname)&&!empty($hlvname)){
                $sql="INSERT INTO `thongtindoi` (`teamname`,`hlvname`,`img`)VALUE('$teamname','$hlvname','$imageFullName') ";
                move_uploaded_file($fileTempName, $fileDestination);
                if($conn->query($sql)===TRUE){
                    $sql2="INSERT INTO `bxh` (`teamname`) VaLue ('$teamname')";
                    $conn->query($sql2);
                    $_SESSION['status']="DoneDoi";
                    header('Location:../ADdoi.php');
                } else {
                    echo "Loi{$sql}".$conn->error;
                }
                } else{
                    $_SESSION['status']="ErrorDoi";
                    header('Location:../ADdoi.php');
                }
        } else {
            $_SESSION['status']="ErrorDoi";
            header('Location:../ADdoi.php');
    exit();
        }
    }else{
        $_SESSION['status']="ErrorDoi";
        header('Location:../ADdoi.php');
    exit();
    }
}

//     if(!empty($teamname)&&!empty($hlvname)){
//         $sql="INSERT INTO `thongtindoi` (`teamname`,`hlvname`)VALUE('$teamname','$hlvname') ";
//         if($conn->query($sql)===TRUE){
//             echo "thanh cong";
//             header('Location:../addteam.php');
//         } else {
//             echo "Loi{$sql}".$conn->error;
//         }

//     } else{
//         echo "Ban can nhap day du thong tin";
//     }

?>