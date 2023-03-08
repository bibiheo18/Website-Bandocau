<?php 
    include "inc/headersp.php"; 
?>

<?php 
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
      $cartId = $_POST['cartId'];
      $quantity = $_POST['quantity'];
      $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);

  }
?>


<?php 

    if(isset($_GET['cartid'])){
        $cartid = $_GET['cartid']; 
        $delcart = $ct->del_product_cart($cartid);
    }


?>

<a name="focusvaoday"></a>
   <section class="header-cart">
      <nav>
        </nav>  
    <!--CART ITEMS DETAIL-->
    <div class="small-container1 cart-page">
        <!--Thẻ name đã được tạo trong trang giỏ hàng khi chuyển trang sẽ tự động focus vào thẻ name -->
        
        <h2 style="color:black">Thanh toán bằng VNPAY</h2>
        


        <?php 
            if(isset($update_quantity_cart)){
                echo $update_quantity_cart;
            }
        ?>

        <?php 
            if(isset($delcart)){
                echo $delcart;
            }
        ?>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá tiền</th>
                <?php 

                    $get_product_cart = $ct->get_product_cart();
                    if($get_product_cart){
                        $subtotal = 0;
                        while($result = $get_product_cart->fetch_assoc())
                        {
                ?>
            </tr>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="admin/uploads/<?php echo $result['image'] ?> ">
                        <div>
                            <p><?php echo $result['productName'] ?></p>
                            <small><?php echo $result['price']  ?> VNĐ</small>
                            <br>
                            <a onclick="return confirm('Bạn có muốn xóa Sản Phẩm này không?');" href="?cartid= <?php echo $result['cartId'] ?> ">Xóa Sản Phẩm</a>
                        </div>
                    </div>

                </td>
                <td>
                    <form action ="" method="post">
                    <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>">
                    <input type="number" name="quantity" min ="1" value="<?php echo $result['quantity'] ?>">
                    <input type="submit" name="submit" Value="Cập Nhật" id="button" />



                    <style>#button{border: 1px solid #ddd;
                                    color: #444;
                                    cursor: pointer;
                                    font-size: 18px;
                                    padding: 0px 5px;
                                    border-radius: 50px 50px 50px 50px;
                                    background: pink;
                                    padding-right: 88px;
                                    padding-bottom: 27px;
                                }
                            
                    </style>
                    
                    
                    </form>

                </td>
                <td><?php   
                        $total = $result['price'] * $result['quantity']; 
                        echo $total;   
                    ?>    
                 VNĐ</td>
            </tr>

         <?php 
                    $subtotal += $total;
                        }
                    }

        ?>

        </table>
        
        <div class="total-price">
            <table>
                <tr>
                    <?php
                    $check_cart = $ct->check_cart();
                            if($check_cart){  
                    ?>

                    <td>Tổng Tiền</td>

                    <td>       
                        <?php
                            echo $subtotal .' ' .'VNĐ';
                            
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>Tổng Giá Tiền</td>
                    <td><?php 
                            
                           
                            echo $subtotal .' ' .'VNĐ';

                        ?>
                    
                    </td>
                </tr>

        <?php }else 
                {   

                    echo '<div class="alert"><B>Giỏ Hàng của bạn hiện tại không có Sản Phẩm nào.</B></div>';
                }
        ?>
            
            </table>
        </div>
       
        
        <?php 

                    $get_product_cart = $ct->get_product_cart();
                    if($get_product_cart){
                        while($result = $get_product_cart->fetch_array())
                        {   
        ?>
        <form action="congthanhtoan.php" method="POST">
            <input type="hidden" name="total1_congthanhtoan" value="<?php echo $result['code_cart']?>">
        <?php
           
                        }
        ?>
            <input type="hidden" name="total_congthanhtoan" value="<?php echo $subtotal ?>">
            <button class="hero-btn2" name="redirect" id="">Thanh toán VNPAY</button>
        </form>
                    

        <?php    
}else{
    
}
        ?>

        </div>

    <nav>
        </nav>  

    </section>

<?php include 'inc/footer.php'; ?>


 