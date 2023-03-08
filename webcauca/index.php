<?php include "inc/header.php"; ?>








<!--Course -->

    
    <section class="course">
        <div class="content">
        <h1>Sản Phẩm Nổi Bật</h1>
        <p>Những sản phẩm được nhiều người mua ở cửa hàng , bao gồm các loại cần câu, máy câu, mồi câu, phụ kiện ....</p>
        <?php
            $product_featured = $product->getproduct_featured();
            if($product_featured) {
                while ($result = $product_featured->fetch_assoc()){
        ?>

            <div class = "grid_1_of_4 images_1_of_4">
                <a href="chitietsp.php ?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>"  alt="" /></a>
                <h2><?php echo $result['productName'] ?></h2>
                <p><?php echo $fm->textShorten($result['product_desc'], 100) ?></p>
                <p><span class ="price"><?php echo $result['price']." "."VNĐ" ?></span></p>
                <i class="fa fa-star" style="color:orange"></i>
                <i class="fa fa-star" style="color:orange"></i>
                <i class="fa fa-star" style="color:orange"></i>
                <i class="fa fa-star" style="color:orange"></i>
                <i class="fa fa-star" style="color:orange"></i>
                <div class=buttton><span><a href="chitietsp.php ?proid=<?php echo $result['productId'] ?> class="details">Xem Chi Tiết </a></span></div>
            </div>

            <?php
            }
            }
            ?>


            <style>.grid_1_of_4 {
                display: block; /* có tác dụng xác định thành phần hiển thị theo các hàng độc lập.*/
                float: left; /*nghĩa là "nổi" sang bên trái */
                margin: 1% 13px; /* % là khoảng cách giữa các section(thẻ cha) , px là độ rộng phần tử  */
                box-shadow: 0px 0px 3px rgb(150, 150, 150);} /* Là hiệu ứng bóng đổ , giúp tạo viền khung */


                .grid_1_of_4:first-child { 
                margin-left: 0px; } 

                .images_1_of_4 {
                width: 17.8%; /*độ rộng */
                padding:1.5%; /* là khoảng trống nằm giữa nội dung và viền,là khoảng cách so với thẻ con */
                text-align:center; /* căn chỉnh vị trí chữ ở giữa */
                position:relative;}/*giúp Định vị trí tuyệt đối cho các thành phần */ 

                .images_1_of_4  img{
                max-width:100%; }


                
            </style>





        </div>
        <p>.</p>
    </section>

 

    <!--Danh mục sản phẩm -->
    <section class="course-dmsp">
    <div class="content"><!--moi fix 31/12-->
    </br>
    
        <h2>Danh Mục Sản Phẩm</h2>

        <div class="row">

        <?php 

            $getall_category = $cat->show_category_fontend(); 
            if($getall_category){
                while($result_allcat = $getall_category->fetch_assoc()){
        

        ?>
            <div class="course-col">
                <h3><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?> "> <?php echo $result_allcat['catName'] ?> </a></h3><p>Chuyên bán cần câu, máy câu, mồi câu, phụ kiện các loại tại cửa hàng. Nhiều chính sách ưu đãi khi mua , giao hàng tận nơi và hỗ trợ tư vấn mọi nhu cầu khách hàng muốn giải quyết .</p>
            </div>

        <?php 
            }
                }
        ?>

        </div>
    
    </section>

<!--facilities-->
<section class="facilities">
    <h1>Các Cửa Hàng Của Chúng Tôi</h1>
    <p>Mở cửa từ Thứ 2 đến Thứ 6 <br>Sáng :6h-11h <br>Chiều :13h-17h </p>
    <div class="row">
        <div class="facilities-col">
            <img src="images/shophanoi.jpg"width="600" height="418">
            <h3>Chi Nhánh Ở Hà Nội</h3>
            <p>24 Phố Quảng Bá, Quảng An, Tây Hồ, Hà Nội</p>
        </div>
        <div class="facilities-col">
            <img src="images/shophue2.jpg"width="600" height="418">
            <h3>Chi Nhánh Ở Huế</h3>
            <p>8 Nguyễn Bỉnh Khiêm, Phú Cát, Thành phố Huế, Thừa Thiên Huế</p>
        </div>
        <div class="facilities-col">
            <img src="images/shopsaigon1.jpg"width="600" height="418">
            <h3>Chi Nhánh Ở Sài Gòn</h3>
            <p>77 Quốc lộ 1A , khu phố 2, phường hiệp bình phước , thành phố mới thủ đức</p>
        </div>
    </div>
</section>

<!--CALL TO ACTION-->
<section class="cta">
    <h1>Liên Hệ Với Chúng Tôi <br>Bất Cứ Khi Nào Bạn Cần</h1>
 <!--hero-btn đã tạo sẵn nên chỉ cần gắn class vào là sẽ có nút sẵn -->
    <a href="lienhe.php#focus-lh" class="hero-btn">LIÊN HỆ NGAY</a>
</section>

</script>

    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>



<?php include 'inc/footer.php'; ?>