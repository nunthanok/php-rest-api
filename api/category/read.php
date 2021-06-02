<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once("../../config/config.php");
    include_once("../../class/category.php");

    $database = new Database();
    $db = $database->getConnection();

    $items = new Category($db);

    $stmt = $items->getCategory();
    $itemCount = $stmt->rowCount();

    // echo json_encode($itemCount);

    if($itemCount > 0){

        $categoryArr = array();
        $categoryArr["body"] = array();
        $categoryArr["itemCount"] = $itemCount;

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            $e = array(
                
                "CategoryID" => $CategoryID,
                "CategoryName" => $CategoryName,
                "Description" => $Description
            );
            array_push($categoryArr["body"], $e);
        }

        http_response_code(200);
        echo json_encode($categoryArr);

    }else{

        http_response_code(404);
        echo json_encode(

            array("massege" => "No record found.")
        );
    }

?>