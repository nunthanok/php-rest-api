<?php 
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: application/json; charset=UTF-8");
 header("Access-Control-Allow-Methods: POST");
 header("Access-Control-Max-Age: 3600");
 header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


 include_once("../../config/config.php");
 include_once("../../class/category.php");

 $database = new Database();
 $db = $database->getConnection();

 $item = new Category($db);

 $item->id = isset($_GET['id']) ? $_GET['id'] : die();

 $item->getSingleCategory();

 if($item->CategoryName != null){
     //Create Array
     $cate_arr = array(
        "CategoryID" => $item->id,
        "CategoryName" => $item->CategoryName,
        "Description" => $item->Description
     );

     http_response_code(200);
     echo json_encode($cate_arr); 

 }else{

    http_response_code(404);
    echo json_encode("Category not found.");
 }



?>