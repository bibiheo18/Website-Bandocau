<?php include "inc/headersp.php"; ?>

<style>body{  
    font-family: Calibri, Helvetica, sans-serif;  
    background-color: #fff;
  }  

  .container {  
      padding: 20px;  
  }  
    
  input[type=text], input[type=password], textarea {  
    width: 45%;  
    padding: 15px;  
    margin: 5px 0 22px 0;  
    display: inline-block;  
    border: none;  
    background:bisque;  
  }  
  input[type=text]:focus, textarea:focus, input[type=password]:focus {  
    background-color: bisque;  
    outline: none;  
  }  

  hr {  
    border: 1px solid #f1f1f1;  
    margin-bottom: 25px;  
  }  
  .registerbtn {  
    background-color: #4CAF50;  
    color: white;  
    padding: 16px 20px;  
    margin: 8px 0;  
    border: none;  
    cursor: pointer;  
    width: 60%;  
    opacity: 0.9;  
  }  
  .registerbtn:hover {  
    opacity: 1;  
  }  </style>

<?php 
if(!isset($_SESSION['code_cart']) || $_SESSION['code_cart']==NULL)
{
    echo "<script>window.location = '404.php'</script>";
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] != null)
{
    $name = $_POST['name'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];

    $insert_order = $ct->insert_order_online($name,$sdt,$diachi);
}
?>


<?php
if(isset($_GET['vnp_BankTranNo']))
{
  $insert_order_details = $ct->insert_order_details($_POST);
  $insert_gio_hang = $gh->insert_gio_hang($_POST);

    $vnp_Amount = $_GET['vnp_Amount']; //1
    $vnp_BankCode = $_GET['vnp_BankCode']; //2
    $vnp_BankTranNo = $_GET['vnp_BankTranNo']; //3
    $vnp_CardType = $_GET['vnp_CardType']; //4
    $vnp_OrderInfo = $_GET['vnp_OrderInfo']; //5
    $vnp_PayDate = $_GET['vnp_PayDate']; //6
    $vnp_TmnCode = $_GET['vnp_TmnCode']; //7
    $vnp_TransactionNo = $_GET['vnp_TransactionNo']; //8
    $code_cart = $_SESSION['code_cart']; //9

    

    $insertvnpaytbl = $ct -> insert_vnpay($vnp_Amount, $vnp_BankCode, $vnp_BankTranNo, $vnp_OrderInfo, 
    $vnp_PayDate, $vnp_TmnCode, $vnp_TransactionNo, $vnp_CardType, $code_cart);

    if($insertvnpaytbl)
    {
        //insert giỏ hàng
        echo '<br><h3><center>Giao dịch thanh toán bằng VNPAY thành công<center></h3>';
        // echo '<p><center>Vui lòng vào trang <a target="_blank" href"#">Lịch sử đơn hàng</a> để xem chi tiết đơn hàng của bạn</center></p>';
        
?>
    <div class="container"> 
        <hr>
        <br>
        <center><h4>Vui lòng để lại thông tin của bạn</h4></center>
        <form action="" method="POST">
            <center><label>Họ Tên </label> 
            <input type="text" name="name" size="15" id="dangky" autofocus/>  </center>   
            <center><label> Số Điện Thoại </label>   
            <input type="text" name="sdt" size="15"  />  </center> 
            <center><label>Địa Chỉ </label>    
            <input type="text" name="diachi" size="15" id = "t1" />
            <br>
            <input type = "submit" name = "submit" id = "logButton" value="Đặt Hàng" onclick="registration()" class="registerbtn">  
        </form>
        <br>
    </div>

<?php
    }   
    else
    {
        echo 'Giao dịch thất bại';
    }
}

elseif(isset($_GET['vnp_BankTranNo']) == 0)
{
    echo '<center><h3>Bạn đã huỷ thanh toán</h3></center>';
    unset($_SESSION['code_cart']);
}
?>

<?php include 'inc/footer.php'; ?>

