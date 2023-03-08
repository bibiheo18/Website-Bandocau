<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath."/../lib/database.php");
	include_once ($filepath."/../helper/format.php");


?>


<?php
	class category
	{
		private $db;
		private $fm;


		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		// Chức năng thêm danh mục sản phẩm
		public function insert_category($catName)
		{	
			$catName = $this->fm->validation($catName); // lấy giá trị đã nhập gán vào catName 
			$catName = mysqli_real_escape_string($this->db->link, $catName); // kết nối dữ liệu , dữ liệu catName
			
            // Nếu để trống catName(tên danh mục sp)
			if(empty($catName)){
				$alert = "<span class='error'>Tên Danh Mục Sản Phẩm không được để trống</span>";
				return $alert;
			//  Ngược lại nếu đã thêm vào thành công sẽ hiện thông báo
			} else {
				// thực hiện câu truy vấn thêm danh mục đã nhập vào catName trong bảng tbl category csdl
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
				// Kết nối dữ liệu thực hiện câu truy vấn thêm vào và nó sẽ là kết quả
				$result = $this->db->insert($query);

				// Nếu kết quả thực hiện câu truy vấn thành công sẽ thông báo thành công
				if($result){
					
					$alert = '<span class="success">Bạn đã thêm '  .$catName. '</span>' . '<span class="success"> vào Danh Mục Sản Phẩm Thành Công </span>';
					
					return $alert;
				// Ngược lại sẽ thông báo không thành công
				}else{
					$alert = '<span class="error">Thêm '  .$catName. '</span>' . '<span class="error"> vào Danh Mục Sản Phẩm Thất Bại </span>';
				}
			}
		}
        // Chức năng hiện bảng danh mục sản phẩm 
		public function show_category()
		{
			$query = "SELECT * FROM tbl_category order by catId desc";
			// Gọi bảng tất cả danh mục ra theo thứ tự giảm dần của catID
			$result = $this->db->select($query);
			// Lệnh select là chọn tất cả danh mục trong câu truy vấn = kết quả
			return $result;
		}

        // Chức năng lấy Id từ bảng danh mục sản phẩm
		public function getcatbyId($Id){
			$query = "SELECT * FROM tbl_category WHERE catId = '$Id'";
			$result = $this->db->select($query);
			return $result;
		}
        // Chức năng update danh mục sản phẩm
		public function update_category($catName,$Id){
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$Id = mysqli_real_escape_string($this->db->link, $Id);

			if(empty($catName)){
				$alert = "<span class='error'>Tên Danh Mục Sản Phẩm không được để trống</span>";
				return $alert;
			} else {
				$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$Id'";
				$result = $this->db->update($query);

				if($result){
					
					$alert = '<span class="success">Bạn đã sửa thành công loại sản phẩm '  .$catName. '</span>' . '<span class="success"> từ Danh Mục Loại Sản Phẩm</span>';					
					return $alert;
				}else{
					$alert = '<span class="error">Bạn đã sửa thất bại loại sản phẩm '  .$catName. '</span>' . '<span class="error"> từ Danh Mục Loại Sản Phẩm</span>';
					return $alert;
				}
			}
		}
        // Chức năng xóa danh mục sản phẩm
		public function del_cat($Id){
			$query = 
			"DELETE tbl_category, tbl_product 
			FROM tbl_category, tbl_product  
			WHERE tbl_category.catId = '$Id' 
			AND tbl_category.catId = tbl_product.catId";

			$result = $this->db->delete($query);
			if($result){
					
					$alert = '<span class="success">Bạn đã xoá Thành Công loại sản phẩm này</span>';					
					return $alert;
				}else{
					$alert = '<span class="error">Bạn đã xóa Thất Bại loại sản phẩm này </span>';
					return $alert;
				}
			}
		// Hiển thị danh mục ở trang chủ
		public function show_category_fontend()
		{
			$query = "SELECT * FROM tbl_category order by catId desc";
			$result = $this->db->select($query);
			return $result;
		}

		// Lấy sản phẩm ra theo danh mục
		public function get_product_by_cat($id)
		{
			$query = "SELECT * FROM tbl_product WHERE catId = '$id' order by catId desc LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}

		// Lấy tên danh mục ra 
		public function get_name_by_cat($id)
		{
			$query = "SELECT tbl_product.*, tbl_category.catName,tbl_category.catId FROM tbl_product, tbl_category 
			WHERE tbl_product.catId = tbl_category.catId AND tbl_product.catId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}
		//Lấy tất cả sản phẩm ra
		public function getallcat() {
			$query = "SELECT tbl_product.*, tbl_category.catName,tbl_category.catId FROM tbl_product, tbl_category 
			WHERE tbl_product.catId = tbl_category.catId ";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>


