<?php
  $filepath = realpath(dirname(__FILE__));
  include ($filepath."/../config/config.php");//Dùng include để gọi file config ra để sử dụng
  
?>



<?php
Class Database{  //khi dùng các function chỉ cần vào class(Database) này sau đó gọi ra những cái hàm này (seclect,insert,update,deleta....)
   public $host   = DB_HOST; //gọi database host đã được định nghĩa ở file config.php để dùng truy cập
   public $user   = DB_USER;
   public $pass   = DB_PASS;
   public $dbname = DB_NAME;
 
 
   public $link;// biến link này có thể gọi ở bất kì file class nào để kiểm tra kết nối
   public $error;
 
 public function __construct(){
  $this->connectDB();//có file cha chạy từ connectDB
 }
 
private function connectDB(){ // biến link tạo ra để kết nối CSDL trong hàm function này, nếu link sai = fail
   $this->link = new mysqli($this->host, $this->user, $this->pass, //Triệu gọi host,user,pass,name ở trên để thực hiện kết nối
    $this->dbname);
   if(!$this->link){  //Nếu không kết nối được
     $this->error ="Connection fail".$this->link->connect_error; // Báo kết nối fail
    return false;
   }
 }
 
// Select or Read data
public function select($query){   //$query chứa câu lệnh chọn(selct) ra trong dữ liệu
  $result = $this->link->query($query) or 
   die($this->link->error.__LINE__);
  if($result->num_rows > 0){
    return $result;
  } else {
    return false;
  }
 }
 
// Insert data
public function insert($query){   //$query chứa câu lệnh thêm(insert) vào trong dữ liệu
   $insert_row = $this->link->query($query) or 
     die($this->link->error.__LINE__);
   if($insert_row){
     return $insert_row;
   } else {
     return false;
    }
 }
  
// Update data
 public function update($query){   //$query chứa câu lệnh cập nhật(update) trong dữ liệu
   $update_row = $this->link->query($query) or 
     die($this->link->error.__LINE__);
   if($update_row){
    return $update_row;
   } else {
    return false;
    }
 }
  
// Delete data
 public function delete($query){   //$query chứa câu lệnh xóa(delete) trong dữ liệu
   $delete_row = $this->link->query($query) or 
     die($this->link->error.__LINE__);
   if($delete_row){
     return $delete_row;
   } else {
     return false;
    }
   }
 
}