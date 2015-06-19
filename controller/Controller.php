<?php

include_once("model/Model.php");  
  
class Controller {  
     public $model;   
  
     public function __construct()    
     {    
          $this->model = new Model();  
     }   
      
     public function invoke($cc)  
     {  
          if ($cc == null)  
          {  
               // default something something
          } 
          else 
          { 
               // show the requested book 
               $book = $this->model->displayCode($cc); 
               include 'view/body.php';  
          }  
     }  
}