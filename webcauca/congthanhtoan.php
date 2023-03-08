<?php

// code thanh toan vnpay
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
$vnp_TmnCode = "N7AHH6MP"; //Website ID in VNPAY System
$vnp_HashSecret = "HLXKVMBNGWZRPMFMACRPIOOEYKBFVLFR"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; //Link thanh toán online
$vnp_Returnurl = "http://localhost/webcauca/camon.php"; //Trả về link khi thực hiện xong giao dịch hoặc hoàn tác
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";//Dùng để xác định xem GD khi thanh toán thành công
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
//end config file

$code_order = $_POST['total1_congthanhtoan'];
$tongtien = $_POST['total_congthanhtoan'];

$vnp_TxnRef = $code_order; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = 'thanh toán đơn hàng vnpay'; //4
$vnp_OrderType = 'other';
$vnp_Amount = $tongtien *100; //1
$vnp_Locale = 'vn';
$vnp_BankCode = 'NCB';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
//$vnp_ExpireDate = $_POST['txtexpire'];
//Billing
//$vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
//$vnp_Bill_Email = $_POST['txt_billing_email'];
//$fullName = trim($_POST['txt_billing_fullname']);
// if (isset($fullName) && trim($fullName) != '') {
//     $name = explode(' ', $fullName);
//     $vnp_Bill_FirstName = array_shift($name);
//     $vnp_Bill_LastName = array_pop($name);
// }
// $vnp_Bill_Address=$_POST['txt_inv_addr1'];
// $vnp_Bill_City=$_POST['txt_bill_city'];
// $vnp_Bill_Country=$_POST['txt_bill_country'];
// $vnp_Bill_State=$_POST['txt_bill_state'];
// // Invoice
// $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
// $vnp_Inv_Email=$_POST['txt_inv_email'];
// $vnp_Inv_Customer=$_POST['txt_inv_customer'];
// $vnp_Inv_Address=$_POST['txt_inv_addr1'];
// $vnp_Inv_Company=$_POST['txt_inv_company'];
// $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
// $vnp_Inv_Type=$_POST['cbo_inv_type'];
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef
    // "vnp_ExpireDate"=>$vnp_ExpireDate,
    // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
    // "vnp_Bill_Email"=>$vnp_Bill_Email,
    // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
    // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
    // "vnp_Bill_Address"=>$vnp_Bill_Address,
    // "vnp_Bill_City"=>$vnp_Bill_City,
    // "vnp_Bill_Country"=>$vnp_Bill_Country,
    // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
    // "vnp_Inv_Email"=>$vnp_Inv_Email,
    // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
    // "vnp_Inv_Address"=>$vnp_Inv_Address,
    // "vnp_Inv_Company"=>$vnp_Inv_Company,
    // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
    // "vnp_Inv_Type"=>$vnp_Inv_Type
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
}

//var_dump($inputData);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) 
{
    if ($i == 1) 
    {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) 
{
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array('code' => '00'
    , 'message' => 'success'
    , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) 
    {   //Nếu click vào nút thanh toán redirect
         //thêm dòng này vào sẽ lấy dc session để truyền qua tab camon
        include "inc/headersp.php"; 
        $_SESSION['code_cart'] = $code_order;
       
        //--------------------------------------
        header('Location: ' . $vnp_Url); // thì nó sẽ trả về đường dẫn dòng số 12
        die();
    }
        
    else 
    {
        echo json_encode($returnData);
    }

// code thanh toan momo
// code thanh toan paypal
// code thanh toan onepay
?>


<!-- vnp_Amount=25000000&
vnp_BankCode=NCB&
vnp_BankTranNo=VNP13899961&
vnp_CardType=ATM&
vnp_OrderInfo=thanh+toán+đơn+hàng+vnpay&
vnp_PayDate=20221209200309&vnp_ResponseCode=00&
vnp_TmnCode=N7AHH6MP&
vnp_TransactionNo=13899961&
vnp_TransactionStatus=00&
vnp_TxnRef=1670590761&
vnp_SecureHash=74eb3f6e86e83d44a483d5772cb7fb558903b9ddd1cdf1d0ce076b7ee82e31531a70fec1b9f6591a35474e4a2dcfdaa595cbab36fbe8c97ed642c86f60596c5b -->