<?php include "inc/headersp.php"; ?>




<div class="small-container">

    <div class="row1 row-2">
        <h2>Sản Phẩm Theo Loại</h2>
        <select onchange="location = this.value;">
            <option value="sanpham.php">Tất Cả Loại</option>
            <option value="http://localhost/webcauca/productbycat.php?catid=48">Cần câu</option>
            <option value="http://localhost/webcauca/productbycat.php?catid=51">Máy câu</option>
            <option value="http://localhost/webcauca/productbycat.php?catid=43">Mồi câu</option>
            <option value="http://localhost/webcauca/productbycat.php?catid=42">Phụ kiện câu cá</option>
        </select>
    </div>
   
    <div class="row1">
<?php
    if(isset($_GET['timkiem']))
    {
        $tukhoa = $_GET['tukhoa'];
        
    }
    
    $timkiem = $product->timkiem($tukhoa);

    if($timkiem){
    while($getproductsearch = $timkiem->fetch_assoc()){
    {
?>
    <div class="col-4">
            <a href="chitietsp.php?proid=<?php echo $getproductsearch['productId'] ?>"><img src="admin/uploads/<?php echo $getproductsearch['image'] ?> " id="popcornmakers"></a>
            <h4><?php echo $getproductsearch['productName']?></h4>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <p>Giá: <?php echo $getproductsearch['price']?> VNĐ</p>
    </div>

<?php
        }
    }
}
else{
    echo '<div class="alert"><B>Không tìm thấy Sản phẩm.</B></div>';
}
?>