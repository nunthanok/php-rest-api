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
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->CategoryID = $data->id;
    
    // category values
    $item->CategoryName = $data->CategoryName;
    $item->Description = $data->Description;

    
    if($item->updateCategory()){

        echo json_encode("Employee data updated.");
        
    } else{

        echo json_encode("Data could not be updated");

    }
?>