<?php

class Code {  
    public $con;
    public $codeID, $title, $description, $author, $files; 
    public $sourcecode00title, $sourcecode00;
    public $sourcecode01title, $sourcecode01;
    public $sourcecode02title, $sourcecode02;
    public $sourcecode03title, $sourcecode03;
    public $sourcecode04title, $sourcecode04;
    public $sourcecode05title, $sourcecode05;
    public $sourcecode06title, $sourcecode06;
    
      
    public function __construct()    
    {    
            $this->con = new PDO('mysql:host=localhost;dbname=cc_test', 'cc_tester', 'cctest');
            $questionQry = "SELECT * FROM code";
            $result = $this->con->query($questionQry);
            $row = $result->fetch();
            $id = $row["id"];
            $title = $row['title'];
            $description = $row['description'];
            $files = $row['files'];
    }   
           
        public function showPreview($codeID) {
            $qry = "SELECT showPreview FROM category 
                        INNER JOIN catmap
                        ON catmap.code_id = $codeID
                        AND category.id = catmap.cat_id
                        ORDER BY name ASC";
            $result = $this->con->query($qry);
            $row = $result->fetch();
            return $row['showPreview'];
        }
        public function showCode($codeID) {
            $qry = "SELECT showCode FROM category 
                        INNER JOIN catmap
                        ON catmap.code_id = $codeID
                        AND category.id = catmap.cat_id
                        ORDER BY name ASC";
            $result = $this->con->query($qry);
            $row = $result->fetch();
            return $row['showCode'];
        }
        public function displayTags($codeID)
        {
            $tagQry = "SELECT name FROM tag 
                        INNER JOIN tagmap
                        ON tagmap.code_id = $codeID
                        AND tag.id = tagmap.tag_id
                        ORDER BY name ASC";
            $result = $this->con->query($tagQry);
            $rows = $result->fetchAll();
            
            $statement = '';
            
            foreach ($rows as $row) {
                    $statement .= '<a href="index.php?cc='.$codeID.'&q='.$row['name'].'">'.$row['name']. '</a>, ';
            }
            
            $statement = rtrim($statement,', ');
            
            return $statement;
        }
        
        public function displayCats($codeID)
        {
            $catQry = "SELECT name FROM category 
                        INNER JOIN catmap
                        ON catmap.code_id = $codeID
                        AND category.id = catmap.cat_id
                        ORDER BY name ASC";
            $result = $this->con->query($catQry);
            $cats = $result->fetchAll();
            
            $kitties = '';
            
            foreach ($cats as $cat) {
                    $kitties .= $cat['name'] . ', ';
            }
            
            $kitties = rtrim($kitties,', ');
            
            return $kitties;
        }
        
        public function getSource($codeID) 
        {
            $questionQry = "SELECT * FROM code WHERE id = $codeID";
            $result = $this->con->query($questionQry);
            $row = $result->fetch();
            $sourcecode = $row['sourcecode00'];
            return $sourcecode;
        }
        
        public function listCats()
        {
            $catQry = "SELECT * FROM category 
                    JOIN catmap
                    ON category.id = catmap.cat_id
                    ORDER BY name ASC";
            $result = $this->con->query($catQry);
            $cats = $result->fetchAll();
            
            $statement[] = "";
            
            foreach ($cats as $cat) {
                    $cName = $cat['name'];
                    echo '<div id="clickme" class="sidebarHead">'.$cName.' <span class="caret"></span></div>
	<ul>';
                    $statement[] = $cName;
                    $codeList = $this->listCodes($cat['cat_id']);
                    echo '</ul>';
            }
                        
            return $statement;
        }
        
        public function listCodes($categoryID)
        {
            $catQry = "SELECT *
                    FROM code 
                    WHERE id = 
                      (SELECT code_id 
                        FROM catmap
                        WHERE cat_id = $categoryID)
                    ORDER BY title ASC";
                    
            $result = $this->con->query($catQry);
            $cats = $result->fetchAll();
            
            $kitties = '';
            
            foreach ($cats as $cat) {
                    $codeTitle = $cat['title'];
                    $codeID = $cat['id'];
                    echo  '<li><a href="index.php?cc=' . $codeID . '">' . $codeTitle . '</a></li>';
            }
            
            $kitties = rtrim($kitties,', ');
            
            return $kitties;
        }
        
        public function searchTags($thisTag) {
            $catQry = "SELECT *
                    FROM code 
                    WHERE id IN 
                    (SELECT code_id 
                    FROM tagmap
                    INNER JOIN tag
                    ON tagmap.tag_id = tag.id
                    WHERE tag.name = \"$thisTag\")
                    ORDER BY title ASC";
            $result = $this->con->query($catQry);
            $cats = $result->fetchAll();
            
            if ($cats) {
                echo 'Search results: <i>'.$thisTag.'</i>';
                echo '<ul>';
                foreach ($cats as $cat) {
                        $codeTitle = $cat['title'];
                        $codeID = $cat['id'];
                        echo  '<li><a href="index.php?cc=' . $codeID . '&q='.$thisTag.'">' . $codeTitle . '</a></li>';
                }
                echo '</ul>';
            } else {
                echo 'No results for <i>'.$thisTag.'</i>';
            }
        }
    }