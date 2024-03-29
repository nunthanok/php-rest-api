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

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

        // The request is using the POST method
        $data = json_decode(file_get_contents("php://input"));
    
        $item->CategoryID = $data->id;
    
        // echo json_encode($item->CategoryID);
        
        if($item->deleteCategory()){ 
    
            echo json_encode("Category deleted.");
    
        } else{
    
            echo json_encode("Data could not be deleted");
    
        }

   }else{

       echo json_encode("Methods not allow");

   }
?>