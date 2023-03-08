<?php
    include 'lib/session.php'; // gọi thư viện session ra (Lưu ý: Thư mục cùng cấp mới lấy ra được)
    Session::init(); //gọi session init ra để khởi tạo phiên làm việc
?>


<?php 
    include "lib/database.php";//Gọi thư viện database ra
    include "helper/format.php";//Gọi thư viện format ra

    spl_autoload_register(function($class) //hàm autoload này để tự lấy cái class mà mình truyền vào
    {   // lệnh include_once dùng để chèn tập tin '.php' 
        include_once "classes/".$class.".php"; //tạo biến khởi tạo $class để gọi các file class trong thư viện classes ra
    });
    // Lấy các class ra
    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $us = new user();// ko xài cái class user này nữa(Thay thế nó là customer)
    $cat = new category();
    $cs = new customer();
    $product = new product();
    $gh = new giohang();
?>


<!DOCTYPE html>
<html>
<head>
    <!--Lệnh meta này sẽ giúp điều chỉnh view(khung hình) 
        hợp lý khi dùng các thiết bị-->
    <meata name="viewport" content="with=device-width, initial-scale=1.0"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cửa Hàng Câu Cá Anh Kiệt </title>
<!-- Script của trang chatbot Collect.chat -->
<script>(function(w, d) { w.CollectId = "63615d3570e4853cfa5ce1a0"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">  
    <!--Link này lấy trong video dùng để tạo icon trên trang web , còn link trong web bootrapcdn ko dùng được ko xài đc-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>   
    <section class="header">
      <nav>
          <a href="index.php"><img id="logo" src="images/logo4.png"  ></a>        
            <div class="nav-links" id="navLinks">  
                <ul>                     
                    <li><a href="index.php">TRANG CHỦ</a></li>
                    <li><a href="gioithieu.php#focus-gioithieu">GIỚI THIỆU</a></li>

                    <div class="subnavvv">
<!--Thẻ  #focusvaoday là thẻ được gán trên link , khi click vào link thì nó sẽ focus thẳng tới thẻ name="focusvaoday" trong link cart.php-->
                    <li class="fa fa-shopping-basket"><a href="cart.php#focusvaoday">GIỎ HÀNG</a></li>
                    </div>

                    <?php 
                        if(isset($_GET['customer_id'])){
                            Session::destroy();
                            header("Location:index.php");
                        }
                    ?>
                   
                     <div class="subnavv">
                    <?php 
                        $login_check = Session::get('customer_login');
                        if($login_check == false){
#Thẻ #focus-dn(dk) là thẻ được gán trên link header, khi click vào dn trên link header thì nó sẽ focus thẳng tới thẻ name="focus-dn(dk)" trong link cart.php
                            echo '<div class="subnavvv">
                            <li class="fa fa-user"><a href="dangnhap.php#focus-dn">ĐĂNG NHẬP / </a>
                                      <a href="dangkyacc.php#focus-dk">ĐĂNG KÝ</a></li>';
                            #echo '<li><a href="dangkyacc.php#focus-dk">ĐĂNG KÝ</a></li>';
                            #echo trên bỏ vì cái đó sẽ tách riêng , còn muốn gộp chung thì bỏ thẻ (a) vào chung
                        }else{
                             echo '<li><a href="?customer_id='.Session::get('customer_id').'">ĐĂNG XUẤT</a></li>';
                            
                        }    
                    ?>

                    </div>

                    



                    <div class="subnavv">
                        <li><a href="lienhe.php#focus-lh">LIÊN HỆ</a></li>
                        
                    </div>

                    <div class="subnavv">
                        <li><a href="sanpham.php#focus-sp">SẢN PHẨM</a></li>
                    </div>

                    

                    <div class="subnavv">
                        <li><a href="noicau.php#focus-noicau">NƠI CÂU</a></li>
                        
                    </div>
                    
                </ul>
                    <form action="timkiem.php?tukhoa=" method="GET">
                        <input type="text1" placeholder="Tìm kiếm sản phẩm..." name="tukhoa">
                        <input type="submit" name="timkiem" value="Tìm kiếm">
                    </form>

                
			
            </div>
            
           

            <!--Gắn thẻ i class vào để đặt icon menu vô thanh menu -->
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>  
        <div class="text-box">
            <h1></h1>
            <p></p>
            <a href="gioithieu.php#focus-gioithieu"class="hero-btn">Nhấn vào đây để biết thêm về chúng tôi</a>

        </div> 
            
        </section>

        <!--Chạy auto slide-->
        <section class="banner">
        <!--slider start-->
        <div class="slider">
            <div class="slides">
                <!--radio button start -->
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">
                <input type="radio" name="radio-btn" id="radio5">
                <input type="radio" name="radio-btn" id="radio6">
                <!--radio button end -->
                <!--slide image start -->
                <div class="slide first">
                    <a href="http://localhost/webcauca/productbycat.php?catid=48"><img src="images/Can-cau.png" alt=""></a>
                </div>
                <div class="slide">
                    <a href="http://localhost/webcauca/productbycat.php?catid=51"><img src="images/May-cau.png" alt=""></a>
                </div>
                <div class="slide">
                    <a href="http://localhost/webcauca/productbycat.php?catid=43"><img src="images/Moi-cau.png" alt=""></a>
                </div>
                <div class="slide">
                    <a href="http://localhost/webcauca/productbycat.php?catid=42"><img src="images/Phu-kien.png" alt=""></a>
                </div>
                <div class="slide">
                    <img src="images/Day-cau.png" alt="">
                </div>
                <div class="slide">
                    <img src="images/Luoi-cau.png" alt="">
                </div>
                <!--slide image end -->
                <!--automatic navigation start -->
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                    <div class="auto-btn5"></div>
                    <div class="auto-btn6"></div>
                </div>
                <!--automatic navigation end -->
            </div>
            <!--manual navigation start-->
            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
                <label for="radio5" class="manual-btn"></label>
                <label for="radio6" class="manual-btn"></label>
            </div>
            <!--manual navigation end-->
        </div>
        <!--image slider end-->
        <script type="text/javascript">
        var counter = 1;
        setInterval(function(){
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if(counter > 4){
            counter = 1;
        }
        }, 2000); /*setting thời gian chạy trong slide */
        </script>
    </section>

    <style>
.subnav-contentt {
  display: none;
  left: 0;
  position: absolute;
  width: 79.5%;
}

.subnavv:hover .subnav-contentt {
  display: block;
}

.subnavv {
  float: right;
  overflow: hidden;
}

.subnavvv{
  float: right;
  overflow: hidden;
  padding-top: 2.8px;
}
        
</style>

<!-- Đoạn scripts này dùng đẻ làm auto lướt ảnh nhưng đã dẹp-->
