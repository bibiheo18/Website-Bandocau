<?php
/**
*Session Class
**/
class Session{
 public static function init(){ // init là khởi tạo file session
  if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {// session_id được khởi tạo
            session_start();
        }
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
 }/*tạo session ban đầu vd khi thêm vào giỏ hàng, thanh toán, đăng nhập thì session này sẽ đảm nhận chức năng đó
  điều này được gọi là lưu các phiên giao dịch, khi page dc f5 thì dữ liệu vẫn còn được lưu*/

 public static function set($key, $val){ //set key thành giá trị vd:usernam dn là admin thì sẽ xuất ra giá trị là admin
    $_SESSION[$key] = $val;
 }

 public static function get($key){  //get giá trị
    if (isset($_SESSION[$key])) {
     return $_SESSION[$key];
    } else {
     return false;
    }
 }

 public static function checkSession(){
    // Gọi lớp này khi dn admin sai và nó sẽ hủy và ở lại trang login
    self::init();
    if (self::get("adminlogin")== false) {
     self::destroy();
     header("Location:login.php"); 
    }
 }

 public static function checkLogin(){
    // Gọi lớp này khi dn admin đúng và nó sẽ chuyển qua trang index
    self::init();
    if (self::get("adminlogin")== true) {
     header("Location:index.php");
    }
 }

 public static function destroy(){ //gọi hàm này khi muốn hủy phiên làm việc của cái gì đó
    // Gọi lớp này khi muốn dùng với mục đích logout ra khỏi trang hiện tại và chuyển sang login
  session_destroy();
  header("Location:login.php");
 }
}
?>