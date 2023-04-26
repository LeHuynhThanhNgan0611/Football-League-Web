<?php
session_start();
require 'db.php';
$conn = create_connection();
if(isset($_POST['submit'])){
    $idhometeam=$_POST['doinha'];
    $sql="SELECT * FROM `thongtindoi` WHERE `idteam`={$idhometeam}";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $homename=$row['teamname'];
    $idawayteam=$_POST['doikhach'];
    $sql2="SELECT * FROM `thongtindoi` WHERE `idteam`={$idawayteam}";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    $awayname=$row2['teamname'];
    $matchdate=$_POST['matchdate'];
    $status="Chưa thi đấu";
    $homegoal=0;
    $awaygoal=0;
    if(!empty($matchdate)&&!empty($idhometeam)&&!empty($idawayteam)){
        $sql="INSERT INTO `lichthidau` (`idhome`,`homename`,`idaway`,`awayname`,`homegoal`,`awaygoal`,`matchdate`,`status`,`ve`)VALUE
        ('$idhometeam','$homename','$idawayteam','$awayname','$homegoal','$awaygoal','$matchdate','$status',0) ";
        if($conn->query($sql)===TRUE){
            $_SESSION['status']="DoneMatch";
            header('Location:../ADlich.php');
        } else {
            echo "Loi{$sql}".$conn->error;
        }
    } else{
        $_SESSION['status']="ErrorMatch";
        header('Location:../ADlich.php');
    }
}

?>