<?php include "inc/headersp.php"; ?>



<div class="container-tto">
        <h1>THANH TOÁN ONLINE</h1>
        <div class = "grid_1_of_4">
            <h3>Chọn cổng thanh toán online</h3>
            <form action="donhangthanhtoanonline.php" method="POST"> <!--phương thức 
            post để gửi dữ liệu theo dạng ẩn, còn phương thức get sẽ gửi dữ liệu và hiển thị trên url-->
                <button class="btn-online" name="redirect" id="redirect">Thanh toán VNPAY</button>
                <!--name redirect là class quan trọng của nút thanh toán khi click sẽ kết nối xử lý sự kiện
                 dữ liệu với trang donhangthanh....php, nếu không có class redirect thì nó sẽ trả về json -->
            </form>
            <p>Đang trong quá trình phát triển, vui lòng chờ nhé.....</p>
            <a style="background:rgb(247, 233, 231)" href="hinhthucthanhtoan.php">Quay về</a>
        </div>
</div>


<style>
    .container-tto{
        max-width: 1300px;
        margin: auto;
        padding-left: 25px;
        padding-right: 25px;
        padding: 100px;
        text-align:center;
        width:700px;
    }
    
    .grid_1_of_4 {
        display: block; /* có tác dụng xác định thành phần hiển thị theo các hàng độc lập.*/
        margin: 1% 13px; /* % là khoảng cách giữa các section(thẻ cha) , px là độ rộng phần tử  */
        box-shadow: 0px 0px 3px rgb(120, 120, 120); /* Là hiệu ứng bóng đổ , giúp tạo viền khung */
        background: rgb(247, 233, 231);
        padding: 20px;}
    .grid_1_of_4:first-child { 
        margin-left: 0px;} 
    button{
        text-align: center;
        background: #37BA17;
        color: #fff;
        max-width: 300px;
    }
</style>






<?php include "inc/footer.php"; ?>