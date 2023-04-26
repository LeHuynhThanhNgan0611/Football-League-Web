<?php
require 'db.php';
session_start();
$conn = create_connection();
if (isset($_POST['submit'])) {
    $accname=$_SESSION['user'];
    $tenkh = $_POST['tenkh'];
    $phone = $_POST['phone'];
    $pid = $_POST['pid'];
    $ve = $_POST['ve'];
    $soluong = $_POST['soluong'];
    $thanhtoan = $_POST['thanhtoan'];
    $idmatch = $_POST['submit'];
    if (!empty($tenkh) && !empty($phone) && !empty($pid) && !empty($ve) && !empty($soluong) && !empty($thanhtoan) && !empty($idmatch)) {
        $sql = "INSERT INTO `bill` (`accname`,`hoten`,`sdt`,`pid`,`cateve`,`soluong`,`phuongthuc`,`idmatch`)
        VALUE('$accname','$tenkh','$phone','$pid','$ve','$soluong','$thanhtoan','$idmatch') ";
        $sql4="SELECT vethuong, vevip FROM `soluongve` Where `idmatch`='$idmatch'";
        $result4 = mysqli_query($conn, $sql4);
        $row = mysqli_fetch_assoc($result4);
        if($ve=='vethuong'and $row['vethuong']>=$soluong)
        {
            $sql2 = "UPDATE `soluongve`SET vethuong=vethuong-'$soluong' WHERE `idmatch`='$idmatch'";
            $result2 = mysqli_query($conn, $sql2);
            if (!$result2) {
                die('loi' . mysqli_error($conn));
            } else{       
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['status']="DoneDatve";
                    header('Location:../formmua.php?id='.$idmatch);
            } else {
                echo "Loi{$sql}" . $conn->error;
            }}
        }else if($ve=='vevip'and $row['vevip']>=$soluong)
        {
            $sql3 = "UPDATE `soluongve`SET vevip=vevip-'$soluong' WHERE `idmatch`='$idmatch'";
            $result3 = mysqli_query($conn, $sql3);
            if (!$result3) {
                die('LỖI' . mysqli_error($conn));
            } else{
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['status']="DoneDatve";
                    header('Location:../formmua.php?id='.$idmatch);
                } else {
                    echo "Loi{$sql}" . $conn->error;
                }
            }
        }else{
            $_SESSION['status']="ErrorHetve";
            header('Location:../formmua.php?id='.$idmatch);
        }
    } else {
        $_SESSION['status']="ErrorDatve";
        header('Location:../formmua.php?id='.$idmatch);
    }
}