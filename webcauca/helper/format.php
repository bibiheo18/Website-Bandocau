<?php
/**
* Format Class
*/
class Format{//class lớn này chứa các hàm format
 public function formatDate($date){
    return date('F j, Y, g:i a', strtotime($date));
 }//hàm format ngày tháng năm

 public function textShorten($text, $limit = 400){
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text.".....";
    return $text;
 } //hàm format text chứa các đoạn text ngắn làm cho tiêu đề chuẩn SEO

 public function validation($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 } //kiểm tra form trống hay không 

 public function title(){
    $path = $_SERVER['SCRIPT_FILENAME'];
    $title = basename($path, '.php');
    //$title = str_replace('_', ' ', $title);
    if ($title == 'index') {
     $title = 'home';
    }elseif ($title == 'contact') {
     $title = 'contact';
    }
    return $title = ucfirst($title);
   }//kiểm tra tên server

   public function format_currency($n=0){
      $n=(string)$n;
      $n=strrev($n);
      $res='';
      for($i = 0; $i<strlen($n);$i++){
         if($i%3==0 && $i != 0){
            $res.='.';
         }
         $res.=$n[$i];
      }
      $res = strrev($res);
      return $res;
   }

   function RemoveSpecialCharSpace($str) {
 
      // Using str_replace() function
      // to replace the word
      $name = trim($str);
      $str = str_replace(' ', '-', $name);
      return preg_replace('/[^A-Za-z0-9\-]/', '', $str);
      // Returning the result
      }
}
?>