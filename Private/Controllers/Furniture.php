<?php 
  class Furniture extends Product{

    private $height;
    private $width;
    private $length;

    // Constructor
    public function __construct($SKU, $name, $price, $type, $attributes) {
      parent::__construct($SKU, $name, $price, $type);
      $this->height = $attributes[0];
      $this->width = $attributes[1];
      $this->length = $attributes[2];
    }

    // Getter and setter for Height
    private function getHeight(){
    return $this->height;
    }

    private function setHeight($height){
    $this->height = $height;
    }

    // Getter and setter for Width
    private function getWidth(){
    return $this->width;
    }

    private function setWidth($width){
    $this->width = $width;
    }

    // Getter and setter for Length
    private function getLength(){
    return $this->length;
    }
      
    private function setLength($length){
    $this->length = $length;
    }

    // Method to insert new Furniture attributes to the database 
    protected function saveProductAttributes($id){
      $sql = "insert into furniture (id, height, width, length) 
              values(:id,:height, :width, :length)";
      $insert= $this->connectDB()->prepare($sql);
      $insert->bindParam(':id',$id);
      $insert->bindParam(':height',$this->height);
      $insert->bindParam(':width',$this->width);
      $insert->bindParam(':length',$this->length);
      
      $insert->execute();
    }
   
  }
?>