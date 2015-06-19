<?php
include_once("model/Code.php");  
  
class Model {      
        // displays a Code with its title, category, tags, preview and code block
        public function displayCode($codeID) 
        {
            $theCode = new Code();
            $questionQry = "SELECT * FROM code WHERE id = $codeID";
            $result = $theCode->con->query($questionQry);
            return $result->fetch();
            $sourcecode00 = $row['sourcecode00'];
            $sourcecode01 = $row['sourcecode01'];
            $sourcecode02 = $row['sourcecode02'];
            $sourcecode03 = $row['sourcecode03'];
            $sourcecode04 = $row['sourcecode04'];
            $sourcecode05 = $row['sourcecode05'];
            $sourcecode06 = $row['sourcecode06'];
            $sourcecode00title = $row['sourcecode00title'];
            $sourcecode01title = $row['sourcecode01title'];
            $sourcecode02title = $row['sourcecode02title'];
            $sourcecode03title = $row['sourcecode03title'];
            $sourcecode04title = $row['sourcecode04title'];
            $sourcecode05title = $row['sourcecode05title'];
            $sourcecode06title = $row['sourcecode06title'];
            $author = $row['author'];
            $tagMe = $this->displayTags($id);   // sends this id to the displayTags function and saves the list of tags in the variable tagMe
            $catMe = $this->displayCats($id);   // sends this id to the displayCats function and saves the list of categories in the variable catMe
            $showPreview = $this->showPreview($id);             
            $showCode = $this->showCode($id);             

            $codes = array($sourcecode00, $sourcecode01, $sourcecode02, $sourcecode03, $sourcecode04, $sourcecode05, $sourcecode06);
            $titles = array($sourcecode00title, $sourcecode01title, $sourcecode02title, $sourcecode03title, $sourcecode04title, $sourcecode05title, $sourcecode06title);
            
        }
        
      
}  