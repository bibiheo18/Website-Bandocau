<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");
	

?>

<?php
	class product
	{
		private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		// Chức năng thêm sản phẩm
		public function insert_product($data,$files)
		{	
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			
			$newprice = $this->fm->RemoveSpecialCharSpace($price);
			
			
			//kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			
			
            // Nếu 6 cái này rỗng
			if($productName=="" || $category=="" || $product_desc=="" || $price=="" || $type=="" || $file_name == ""){
				$alert = "<span class='error'>Các Trường không được để trống</span>";
				return $alert;
			}

			elseif(preg_match('/[\'$%&*()}{@#~?><>,|=_+¬-]/', $newprice)) //bỏ ^£
			{
				echo '<script>alert("Vui lòng nhập giá tiền hợp lệ!")</script>';
			}

			 else {
				move_uploaded_file($file_temp, $uploaded_image); //dùng để lấy tên của file hình ảnh tạm đó để gửi vào $file_temp sau đó upload vào folder uploads
                // Thực hiện câu truy vấn thêm các thông tin các cột
				$query = "INSERT INTO tbl_product(productName,catId,product_desc,type,price,image) VALUES('$productName','$category',
				'$product_desc','$type','$newprice','$unique_image')";
				$result = $this->db->insert($query);

				if($result){
					
					$alert = '<span class="success">Bạn đã thêm Sản Phẩm '  .$productName. '</span>' . '<span class="success"> Thành Công </span>';
					
					return $alert;
				}else{
					$alert = '<span class="error">Bạn đã thêm Sản Phẩm '  .$productName. '</span>' . '<span class="error"> Thất Bại </span>';
				}
			}
		}
        // Chức năng show danh sách sản phẩm
		public function show_product()
		{

			$query = "
			SELECT tbl_product.*, tbl_category.catName 
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			order by tbl_product.productId desc";
			$result = $this->db->select($query);
			return $result;
		}

        // Chức năng lấy id sản phẩm
		public function getproductbyId($Id){
			$query = "SELECT * FROM tbl_product WHERE productId = '$Id'";
			$result = $this->db->select($query);
			return $result;
		}
        // Chức năng sửa(update) sản phẩm
		public function update_product($data,$files,$Id){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);
			
			
			//kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name); //explode dùng để chia cắt phần tên và đuôi của file ra thành 2 phần tách biệt thông qua dấu .
			$file_ext = strtolower(end($div)); //Lấy phần cuối đuôi của file để ktra , strotolower để biến tất cả chữ hoa thành chữ thường
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; //substring là hàm random số từ 0 -> 10 kết hợp với tên file_ext để tạo thành tên mới và thêm vào csdl
			$uploaded_image = "uploads/".$unique_image;

	        // Nếu 6 cái này rỗng
			if($productName=="" || $category=="" || $product_desc=="" || $price=="" || $type==""){
				$alert = "<span class='error'>Các Trường không được để trống</span>";
				return $alert;
			} else {
				        //nếu không trống $file_name có nghĩa là nếu người dùng đã chọn ảnh
						if(!empty($file_name)){
							 //  Nếu đã chọn ảnh tiếp theo sẽ kiểm tra điều kiện size >=2MB
							if($file_size > 204800) {
							 	$alert = "<span class='error'>Kích Thước Ảnh không được vượt quá 20MB!</span>";
							 	return $alert;
							}
							//Nếu chọn sai "không phải file ảnh" thì hệ thống sẽ thông báo lỗi
							elseif (in_array($file_ext, $permited) === false) 
							{
								//echo "<span class='error'>Bạn chỉ có thể được tải lên:-".implode(', ', $permited)."</span>";
								$alert = "<span class='error'>Bạn chỉ có thể chọn flie theo định dạng: ".implode(', ', $permited)."</span>";
								return $alert;
							}
							//Update và gán giá trị theo id sản phẩm
							move_uploaded_file($file_temp,$uploaded_image);
							$query = "UPDATE tbl_product SET 
							productName = '$productName',
							catId = '$category',
							product_desc = '$product_desc',
							type = '$type',
							price = '$price',
							image = '$unique_image'

							WHERE productId = '$Id'";


				   		}else{
				   			//Ngược lại nếu người dùng không chọn ảnh thì nó sẽ upload lại ảnh củ theo Id
				   			$query = "UPDATE tbl_product SET 
							productName = '$productName',
							catId = '$category',
							product_desc = '$product_desc',
							type = '$type',
							price = '$price'
							WHERE productId = '$Id'";

				   		}
				   	}

                // Thao tác khi nhấn nút sửa
				$result = $this->db->update($query);
				if($result){
					
					$alert = '<span class="success">Bạn đã sửa thành công sản phẩm '  .$productName. '</span>' . '<span class="success"> từ danh mục Sản Phẩm</span>';					
					return $alert;
				}else{
					$alert = '<span class="error">Bạn đã sửa thất bại sản phẩm '  .$productName. '</span>' . '<span class="error"> từ danh mục Sản Phẩm</span>';
					return $alert;
				}
			}
		
		
        // Chức năng xóa sản phẩm
		public function del_product($Id){
			$query = "DELETE FROM tbl_product WHERE productId = '$Id'";
			$result = $this->db->delete($query);
			if($result){
					
					$alert = '<span class="success">Bạn đã xoá Thành Công sản phẩm này</span>';					
					return $alert;
				}else{
					$alert = '<span class="error">Bạn đã xóa Thất Bại sản phẩm này </span>';
					return $alert;
				}
			}
			//kết thúc backend
			//bắt đầu frontend
        // Chức năng sử dụng loại danh mục (đặc trưng or ko đặc trưng)
		public function getproduct_featured(){
			$query = "SELECT * FROM tbl_product WHERE type = '1'";
			$result = $this->db->select($query);
			return $result;
		}

        // Chức năng lấy tất cả thông tin chi tiết sản phẩm thông qua id 
		public function get_details($id){
			$query = "
			SELECT tbl_product.*, tbl_category.catName 
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			WHERE tbl_product.productId = '$id' ";

			$result = $this->db->select($query);
			return $result;
		}

        // Chức năng lấy tất cả sản phẩm ra        
		public function getallproduct(){
			$query = "SELECT * FROM tbl_product ";
			$result = $this->db->select($query);
			return $result;
		}
		// Chức năng tìm kiếm sản phẩm
		public function timkiem($tukhoa)
	{
		$query = "SELECT * FROM tbl_product,tbl_category WHERE tbl_product.catId = tbl_category.catId AND
		tbl_product.productName LIKE '%".$tukhoa."%'";
		$result = $this->db->select($query);
		return $result;
	}

	}
?>


