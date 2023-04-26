<?php
session_start();
require 'db.php';
$conn = create_connection();
$homegoal=$_POST['homegoal'];
$awaygoal=$_POST['awaygoal'];
$idmatch=$_GET['idmatch'];
$status="Đã thi đấu";
$sql="UPDATE `lichthidau` SET `homegoal`={$homegoal},`awaygoal`={$awaygoal},`status`='$status' WHERE `idmatch`={$idmatch}";
if(!mysqli_query($conn,$sql)){
    die('Connect fail'.mysqli_error($conn));
}
$sql2 = "SELECT * FROM `lichthidau`";
$result2 = mysqli_query($conn, $sql2);
if(mysqli_num_rows($result2) > 0) {
    $sql3 = "UPDATE `bxh` SET `pt`=0,`win`=0,`lose`=0,`draw`=0";
    if(!mysqli_query($conn,$sql3)){
        die('Connect fail'.mysqli_error($conn));
    }
    while ($row2 = mysqli_fetch_assoc($result2)) {
        if($row2['homegoal']>$row2['awaygoal']) {
            $sql4="UPDATE `bxh` SET `pt`=`pt`+3,`win`=`win`+1 WHERE `teamname`='{$row2['homename']}'";
            $sql5="UPDATE `bxh` SET `lose`=`lose`+1 WHERE `teamname`='{$row2['awayname']}'";
            if(!mysqli_query($conn,$sql4)){
                die('Connect fail'.mysqli_error($conn));
            }
            if(!mysqli_query($conn,$sql5)){
                die('Connect fail'.mysqli_error($conn));
            }
        }
        else if($row2['homegoal']<$row2['awaygoal']) {
            $sql4="UPDATE `bxh` SET `pt`=`pt`+3,`win`=`win`+1 WHERE `teamname`='{$row2['awayname']}'";
            $sql5="UPDATE `bxh` SET `lose`=`lose`+1 WHERE `teamname`='{$row2['homename']}'";
            if(!mysqli_query($conn,$sql4)){
                die('Connect fail'.mysqli_error($conn));
            }
            if(!mysqli_query($conn,$sql5)){
                die('Connect fail'.mysqli_error($conn));
            }
        }
        else if($row2['homegoal']==$row2['awaygoal']){
            $sql6="UPDATE `bxh` SET `pt`=`pt`+1,`draw`=`draw`+1 WHERE `teamname`='{$row2['awayname']}' OR `teamname`='{$row2['homename']}'";
            if(!mysqli_query($conn,$sql6)){
                die('Connect fail'.mysqli_error($conn));
            }
        }
    }
    mysqli_data_seek($result2, 0);
}
$_SESSION['status']="DoneMatch";
header("Location:../ADlich.php");
echo "thanhcong";
?>