<?php


class Category{

      // Connection
      private $conn;

      // Table
      private $db_table = "Categories";

      //Columns
      public $CategoryID;
      public $CategoryName;
      public $Description;

      /// Db connection
      public function __construct($db){

            $this->conn = $db;
      }


      //Get ALL 
      public function getCategory(){

            $sqlQuery = "SELECT CategoryID, CategoryName, Description FROM " .$this->db_table." ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
      }


      //CREAT 
      public function createCategory(){
            
            $sqlQuery = "INSERT INTO ".$this->db_table." 
                        SET CategoryName= :CategoryName,
                            Description= :Description";
            
            $stmt = $this->conn->prepare($sqlQuery);
            
            // sanitize

            $this->CategoryName=htmlspecialchars(strip_tags($this->CategoryName));
            $this->Description=htmlspecialchars(strip_tags($this->Description));

            // bind data
            $stmt->bindParam(":CategoryName", $this->CategoryName);
            $stmt->bindParam(":Description", $this->Description);

            if($stmt->execute()){
                  
                  return true;
            }

            return false;
      }



      //READ single
      public function getSingleCategory(){

            $sqlQuery = "SELECT CategoryID, CategoryName, Description FROM ".$this->db_table." WHERE CategoryID = ? LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();    

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->CategoryName = $dataRow['CategoryName'];
            $this->Description = $dataRow['Description'];



      }

      //UPDATE
      public function updateCategory(){

            $sqlQuery = "UPDATE ".$this->db_table." SET CategoryName = :name, Description = :descrip WHERE CategoryID = :id ";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->CategoryName =htmlspecialchars(strip_tags($this->CategoryName)) ;
            $this->Description = htmlspecialchars(strip_tags($this->Description));

            //bind data 
            $stmt->bindParam(":name", $this->CategoryName);
            $stmt->bindParam(":descrip", $this->Description);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                  
                  return true;

            }

                  return false;
            



      }

      //DELETE 
      public function deleteCategory(){

            $sqlQuery = "DELETE FROM ".$this->db_table." WHERE CategoryID = ? ";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->CategoryID = htmlspecialchars(strip_tags($this->CategoryID));

            $stmt->bindParam(1, $this->id);

            if($stmt->execute()){

                  return true;
            }
                  return false;
      }


}


?>