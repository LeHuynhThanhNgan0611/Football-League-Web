<?php
require 'db/db.php';
$conn = create_connection();
$sql2 = "SELECT a.*, b.* FROM lichthidau a, soluongve b WHERE a.idmatch=b.idmatch and ve = 1 and b.status='Đang bán' ORDER BY matchdate";
$result2 = mysqli_query($conn, $sql2);

session_start();
if (!isset($_SESSION['user'])) {
    $usercheck = 'Guest';
    header('Location: Login.php');
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
?>
<?php include 'view/userviewheader.php' ?>
<div class="content__chonve">
    <div class="content__banner">
        <img src="img/home/verbanner.jpg" alt="">
    </div>
    <div class="content__lstve">
        Chọn trận
        <table class="table ">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Ngày</th>
                    <th scope="col">Đội nhà</th>
                    <th scope="col">Đội khách</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                        <tr class="selectmatch" onclick="selectmatch(this.id)" id="<?php echo $row2['idmatch'] ?>">
                            <th scope="row"><?php echo $row2['matchdate'] ?></th>
                            <td><?php echo $row2['homename'] ?></td>
                            <td><?php echo $row2['awayname'] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'view/userviewfooter.php' ?>