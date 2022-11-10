<?php 

namespace Service\XmlParse;

  class Car 
  { 
    private $conn;
    private $table = 'cars';


    // Constructor with DB
  
    // Get cars
    public function read() 
    {     
        $query = "SELECT DISTINCT id, generation_id FROM ".$this->table;
        // Prepare statement
        $stmt = $this->conn->query($query);
      
        return $stmt;       
    }


    // Create 
    public function create(object $value) 
    {
    
        $query = "INSERT INTO cars (id, mark, model, generation, `year`, run, 
        color,`body-type`, `engine-type`, transmission, `gear-type`, generation_id)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
             
          $stmt = $this->conn->prepare($query);
         
            $id = $value->id;
            $mark = $value->mark;
            $model = $value->model;
            $generation = $value->generation;
            $year = $value->year;
            $run = $value->run;
            $color = $value->color;
            $body_type = $value->{'body-type'};
            $engine_type = $value->{'engine-type'};
            $transmission = $value->transmission;
            $gear_type = $value->{'gear-type'};
            $generation_id = (string) $value->{'generation_id'};
                

          if($stmt->execute(array($id, $mark, $model, $generation, $year, $run, $color, 
          $body_type, $engine_type, $transmission, $gear_type, $generation_id))) {
            return true;
          }
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

  

 

  public function delete($id, $generation_id) {
    $query = 'DELETE FROM '. $this->table. ' WHERE id = ? AND generation_id = ?';

    $stmt = $this->conn->prepare($query);


    if($stmt->execute(array($id, $generation_id))) {
      return true;
    }
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

}

?>