<?php include "inc/headersp.php"; ?>
<div class="container-httt">
        <h1>CHỌN HÌNH THỨC THANH TOÁN</h1>
        <div class = "grid_1_of_4">
            <a href='onlinepayment.php' class='hero-btn2' >Thanh toán Online</a>
            <a href='payment.php' class='hero-btn2' >Thanh toán Offline</a>
            <p>
                <a style="background:rgb(247, 233, 231)" href="cart.php">Quay về</a>
            </p>
        </div>
</div>


<style>
    .container-httt{
        max-width: 1300px;
        margin: auto;
        padding-left: 25px;
        padding-right: 25px;
        padding: 100px;
        text-align:center;
        width:800px;
        height:800px;
    }
    
    .grid_1_of_4 {
        display: block; /* có tác dụng xác định thành phần hiển thị theo các hàng độc lập.*/
        margin: 1% 13px; /* % là khoảng cách giữa các section(thẻ cha) , px là độ rộng phần tử  */
        box-shadow: 0px 0px 3px rgb(120, 120, 120); /* Là hiệu ứng bóng đổ , giúp tạo viền khung */
        background: rgb(247, 233, 231);
        padding: 30px;}
    .grid_1_of_4:first-child { 
        margin-left: 0px;} 
</style>

<?php include "inc/footer.php"; ?>