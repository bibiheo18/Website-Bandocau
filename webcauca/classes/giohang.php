<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
?>


<?php
	class giohang
	{
		private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

        public function insert_gio_hang($data)
        {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId' ";
            $get_product = $this->db->select($query);
            if($get_product)
            {	
                while($result = $get_product->fetch_assoc())
                {
                    
                    $productid = $result['productId'];
                    $sId = $result['sId'];
                    $productname = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $quantity; //tổng giá
                    $vat = $price * 0.1; //6000
                    $pricee = $price + $vat;
                    $image = $result['image'];
                    $code_cart = $result['code_cart'];

                    $insert_giohang = "INSERT INTO tbl_giohang(productId,sId,productName,price,quantity,image,code_cart) VALUES('$productid','$sId',
                    '$productname','$price','$quantity','$image','$code_cart')";
                    $result = $this->db->insert($insert_giohang);
                    $query_del = "DELETE FROM tbl_cart WHERE sId = '$sId'";
                    $result = $this->db->delete($query_del);
                }
            }
		}
    }

    
?>