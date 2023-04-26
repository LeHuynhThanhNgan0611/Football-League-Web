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
$sql = "SELECT * FROM `bxh` ORDER BY `pt` desc ";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT * FROM `lichthidau` where status ='Chưa thi đấu'";
// $sql2 = "SELECT l.* ,d.* FROM lichthidau l,thongtindoi d WHERE l.idteam=d.idteam";
$result2 = mysqli_query($conn, $sql2);
?>

<?php include 'view/userviewheader.php'?>

        <div id="banner1">
            <!-- Slideshow container -->
            <div class="slideshow-container1">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides1 fade1">
                    <div class="numbertext">1 / 3</div>
                    <img src="img/home/banner1.jpg" style="width:100%">
                </div>

                <div class="mySlides1 fade1">
                    <div class="numbertext">2 / 3</div>
                    <img src="img/home/banner22.jpg" style="width:100%">
                </div>

                <div class="mySlides1 fade1">
                    <div class="numbertext">3 / 3</div>
                    <img src="img/home/banner2.jpg" style="width:100%">
                </div>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                <br>

                <!-- The dots/circles -->
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </div>

        <div id="content" class="m-2rem">
            <div id="container">
                <div class="border" id="ltd__content">
                    <?php
                    mysqli_data_seek($result2, 0);
                    if (mysqli_num_rows($result2) > 0) {
                        $a=0;
                        while ($row2 = mysqli_fetch_assoc($result2)) {

                            if($a=!0){
                                ?>
                                <div style="border-bottom:solid 1px #e6e6e6; width:100%;"> </div> 
                            <?php }
                            $a=1;
                    ?>
                        
                        <Table class="content__ltd__item">
                            <tr class="content__ltd__item__head">
                                <td>
                                <?php
                                    $temp= $row2['idhome'];
                                    $sql3 = "SELECT * FROM `thongtindoi` Where idteam= {$temp}";
                                    $result3 = mysqli_query($conn, $sql3);
                                    $row3 = mysqli_fetch_assoc($result3);
                                ?>
                                    <img src="img/gallery/<?php echo $row3['img'] ?>" alt="">                                 
                                    <p><?php echo $row2['homename'] ?></p>
                                </td>
                                <td rowspan="2" style="border-left: solid 1px #e6e6e6 ; text-align: center;" >
                                    <p><?php echo $row2['matchdate'] ?></p>
                                </td>
                            </tr>
                            <tr class="content__ltd__item__head">                                
                                <td>
                                <?php
                                    $temp= $row2['idaway'];
                                    $sql3 = "SELECT * FROM `thongtindoi` Where idteam= {$temp}";
                                    $result3 = mysqli_query($conn, $sql3);
                                    $row3 = mysqli_fetch_assoc($result3);
                                ?>
                                    <img src="img/gallery/<?php echo $row3['img'] ?>" alt="">    
                                    <p><?php echo $row2['awayname'] ?></p>
                                </td>
                               
                            </tr>
                        </Table>
                        
                    <?php

                        }
                    }
                    ?>
                </div>
                <div  id="rank__content">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">TOP</th>
                                <th scope="col">Đội</th>
                                <th scope="col">Thắng</th>
                                <th scope="col">Hòa</th>
                                <th scope="col">Thua</th>
                                <th scope="col">Điểm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $a = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $a++ ?></th>
                                        <td><?php echo $row['teamname'] ?> </td>
                                        <td><?php echo $row['win'] ?></td>
                                        <td><?php echo $row['draw'] ?></td>
                                        <td><?php echo $row['lose'] ?></td>
                                        <td><?php echo $row['pt'] ?></td>
                                    </tr>

                            <?php
                                }
                                mysqli_data_seek($result, 0);
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="news" class="m-1rem">
                <div class="news__content">
                    <div class="news__img1">
                        <img src="img/home/new1.jpg" alt="">
                    </div>
                    <div class="news__text">
                        <h2>title</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod totam, corrupti, quo dolorum
                            facilis,Lorem ipsum dolor sit amet consectetur, enim dolor deserunt blanditiis in esse mollitia autem molestiae! Minus!</p>
                    </div>
                </div>
                <div class="news__content2">
                    <div class="news__content3">
                        <div class="news__img">
                            <img src="img/home/new2.jpg" alt="">
                        </div>
                        <div class="news__text">
                            <h3>title</h3>
                            <p>Lorem ipsum dolor sit amet consectetur, facilis!</p>
                        </div>
                    </div>
                    <div class="news__content3">
                        <div class="news__img">
                            <img src="img/home/new3.jpg" alt="">
                        </div>
                        <div class="news__text">
                            <h3>title</h3>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'view/userviewfooter.php'?>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides1");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
