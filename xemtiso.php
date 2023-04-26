<?php
require('db/db.php');
$conn = create_connection();
session_start();
if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    echo '<script>
    window.onload = function(){
        addbuttonlogin();
    };
 </script>';
} else {
    echo '<script>
        window.onload = function(){
            addbuttonlogout();
        };
     </script>';
    if ($_SESSION['position'] != 0) {
        $usercheck = 'user';
        echo '<script>
        window.onload = function(){
            addbuttonadmin();
            addbuttonlogout();
        };
     </script>';
    }
}
$sql2 = "SELECT * FROM `lichthidau` where status ='Đã thi đấu'";
// $sql2 = "SELECT l.* ,d.* FROM lichthidau l,thongtindoi d WHERE l.idteam=d.idteam";
$result2 = mysqli_query($conn, $sql2);
?>
<?php include 'view/userviewheader.php' ?>
<div style="width: 1366px; margin:auto; height:900px">
    <h2 style="margin-top: 120px;">Bảng tỉ số</h2>
    <div  id="ltd__content">
        <div class="content__xts">
            <?php
            mysqli_data_seek($result2, 0);
            if (mysqli_num_rows($result2) > 0) {
                $a = 0;

                while ($row2 = mysqli_fetch_assoc($result2)) {
                    if ($a = !0) {
            ?>

                    <?php }
                    $a = 1;
                    ?>
                    <Table class="content__ltd__item content__ltd__item__flex" style="margin: 0; width:672px">
                        <tr class="content__ltd__item__head">
                            <td>
                                <?php
                                $temp = $row2['idhome'];
                                $sql3 = "SELECT * FROM `thongtindoi` Where idteam= {$temp}";
                                $result3 = mysqli_query($conn, $sql3);
                                $row3 = mysqli_fetch_assoc($result3);
                                ?>
                                <img src="img/gallery/<?php echo $row3['img'] ?>" alt="">
                                <p><?php echo $row2['homename'] ?></p>
                            </td>
                            <td style="width: 10%;">
                                <p><?php echo $row2['homegoal'] ?></p>
                            </td>
                            <td rowspan="2" style="border-left: solid 1px #e6e6e6 ; text-align: center;">
                                <p><?php echo $row2['matchdate'] ?></p>
                            </td>
                        </tr>
                        <tr class="content__ltd__item__head">
                            <td>
                                <?php
                                $temp = $row2['idaway'];
                                $sql3 = "SELECT * FROM `thongtindoi` Where idteam= {$temp}";
                                $result3 = mysqli_query($conn, $sql3);
                                $row3 = mysqli_fetch_assoc($result3);
                                ?>
                                <img src="img/gallery/<?php echo $row3['img'] ?>" alt="">
                                <p><?php echo $row2['awayname'] ?></p>
                            </td>
                            <td style="width: 10%;">
                                <p><?php echo $row2['awaygoal'] ?></p>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </Table>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'view/userviewfooter.php' ?>