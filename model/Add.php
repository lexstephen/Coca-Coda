<?php

class Add {
    
    // attributes are public so that we can access them using $code->id directly
    public $id, $title, $description, $author, $files;
    public $sourcecode00, $sourcecode00title;
    public $sourcecode01, $sourcecode01title;
    public $sourcecode02, $sourcecode02title;
    public $sourcecode03, $sourcecode03title;
    public $sourcecode04, $sourcecode04title;
    public $sourcecode05, $sourcecode05title;
    public $sourcecode06, $sourcecode06title;
    public $sourcecode07, $sourcecode07title;
    public $sourcecode08, $sourcecode08title;
    public $sourcecode09, $sourcecode09title;
    public $sourcecodes;
    
    public function __construct($id, $title, $description, $author, $files, $sourcecode00, $sourcecode00title, $sourcecode01, $sourcecode01title, $sourcecode02, $sourcecode02title, $sourcecode03, $sourcecode03title, $sourcecode04, $sourcecode04title, $sourcecode05, $sourcecode05title, $sourcecode06, $sourcecode06title, $sourcecode07, $sourcecode07title, $sourcecode08, $sourcecode08title) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->files = $files;
        $this->sourcecodes = [
            ['code' => $sourcecode00, 'title' => $sourcecode00title],
            ['code' => $sourcecode01, 'title' => $sourcecode01title],
            ['code' => $sourcecode02, 'title' => $sourcecode02title],
            ['code' => $sourcecode03, 'title' => $sourcecode03title],
            ['code' => $sourcecode04, 'title' => $sourcecode04title],
            ['code' => $sourcecode05, 'title' => $sourcecode05title],
            ['code' => $sourcecode06, 'title' => $sourcecode06title],
            ['code' => $sourcecode07, 'title' => $sourcecode07title],
            ['code' => $sourcecode08, 'title' => $sourcecode08title],
            ['code' => $sourcecode09, 'title' => $sourcecode09title]
        ];
    }
    
    public static function addCode() {
        $codeTitle = isset($_POST['title'])?$_POST['title']:null;
        $codeDescription =isset($_POST['description'])?$_POST['title']:null;
        $codeAuthor =isset($_POST['author'])?$_POST['author']:null;
        $codeImage =isset($_POST['image'])?$_POST['image']:null;
        $codeFiles =isset($_POST['files'])?$_POST['files']:null;
        $codeSourceCode00Title =isset($_POST['sourcecode00title'])?$_POST['sourcecode00title']:null;
        $codeSourceCode00 =isset($_POST['sourcecode00'])?$_POST['sourcecode00']:null;
        $codeSourceCode01Title =isset($_POST['sourcecode01title'])?$_POST['sourcecode01title']:null;
        $codeSourceCode01 =isset($_POST['sourcecode01'])?$_POST['sourcecode01']:null;
        $codeSourceCode02Title =isset($_POST['sourcecode02title'])?$_POST['sourcecode02title']:null;
        $codeSourceCode02 =isset($_POST['sourcecode02'])?$_POST['sourcecode02']:null;
        $codeSourceCode03Title =isset($_POST['sourcecode03title'])?$_POST['sourcecode03title']:null;
        $codeSourceCode03 =isset($_POST['sourcecode03'])?$_POST['sourcecode03']:null;
        $codeSourceCode04Title =isset($_POST['sourcecode04title'])?$_POST['sourcecode04title']:null;
        $codeSourceCode04 =isset($_POST['sourcecode04'])?$_POST['sourcecode04']:null;
        $codeSourceCode05Title =isset($_POST['sourcecode05title'])?$_POST['sourcecode05title']:null;
        $codeSourceCode05 =isset($_POST['sourcecode05'])?$_POST['sourcecode05']:null;
        $codeSourceCode06Title =isset($_POST['sourcecode06title'])?$_POST['sourcecode06title']:null;
        $codeSourceCode06 =isset($_POST['sourcecode06'])?$_POST['sourcecode06']:null;
        $codeSourceCode07Title =isset($_POST['sourcecode07title'])?$_POST['sourcecode07title']:null;
        $codeSourceCode07 =isset($_POST['sourcecode07'])?$_POST['sourcecode07']:null;
        $codeSourceCode08Title =isset($_POST['sourcecode08title'])?$_POST['sourcecode08title']:null;
        $codeSourceCode08 =isset($_POST['sourcecode08'])?$_POST['sourcecode08']:null;
        $codeSourceCode09Title =isset($_POST['sourcecode09title'])?$_POST['sourcecode09title']:null;
        $codeSourceCode09 =isset($_POST['sourcecode09'])?$_POST['sourcecode09']:null;
        
        $codeCategories =isset($_POST['categories'])?$_POST['categories']:null;
        $codeNewCategories =isset($_POST['newCategories'])?$_POST['newCategories']:null;
        $codeNewCategory =isset($_POST['newCategory'])?$_POST['newCategory']:null;
        $codeNewTags =isset($_POST['newTags'])?$_POST['newTags']:null;
        $codeNewTag =isset($_POST['newTag'])?$_POST['newTag']:null;
        $codeTags =isset($_POST['tags'])?$_POST['tags']:null;
        
        $db = Db::getInstance();
        //$codeSourceCode00 = $db->quote($codeSourceCode00);
        $req = $db->prepare("
            INSERT INTO `cc_test`.`code`    (`id`, `title`, `description`, `author`, `files`, `image`, 
                `sourcecode00title`, `sourcecode00`, `sourcecode01title`, `sourcecode01`, `sourcecode02title`, `sourcecode02`, 
                `sourcecode03title`, `sourcecode03`, `sourcecode04title`, `sourcecode04`, `sourcecode05title`, `sourcecode05`, 
                `sourcecode06title`, `sourcecode06`, `sourcecode07title`, `sourcecode07`, `sourcecode08title`, `sourcecode08`,
                `sourcecode09title`, `sourcecode09`) 
            VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $req->execute(array($codeTitle, $codeDescription, $codeAuthor, $codeFiles, $codeImage, 
            $codeSourceCode00Title, $codeSourceCode00, $codeSourceCode00Title, $codeSourceCode01, 
            $codeSourceCode02Title, $codeSourceCode02, $codeSourceCode03Title, $codeSourceCode03, 
            $codeSourceCode04Title, $codeSourceCode04, $codeSourceCode05Title, $codeSourceCode05, 
            $codeSourceCode06Title, $codeSourceCode06, $codeSourceCode07Title, $codeSourceCode07, 
            $codeSourceCode08Title, $codeSourceCode08, $codeSourceCode09Title, $codeSourceCode09));
//        $codeID = $req->fetch(PDO::FETCH_NUM);
//        $codeID = $codeID[0];
        
        $codeID = $db->lastInsertId();
        
            
            if ($codeCategories) {
                foreach($codeCategories as $codeCategory)
                {
                   // echo 'Category: ' . $codeCategory;
                    $catReq = $db->query("INSERT INTO `cc_test`.`catmap` (`id`, `code_id`, `cat_id`) VALUES (NULL, '$codeID', '$codeCategory')");
                }
            }
            if ($codeTags) {
                foreach($codeTags as $codeTag)
                {
                   // echo 'Tag: ' .$codeTag;
                    $tagReq = $db->query("INSERT INTO `cc_test`.`tagmap` (`id`, `tag_id`, `code_id`) VALUES (NULL, '$codeTag', '$codeID')");
                }
            }
            if ($codeNewCategory) {
                for ($x = 0; $x < $codeNewCategories; $x++) {
                       // echo 'Category: ' . $codeCategory;
                        // INSERT INTO `cc_test`.`category` (`id`, `name`, `showPreview`, `showCode`) VALUES (NULL, 'jQuery', '1', '1');
                        $addThatCat = $db->query("INSERT INTO `cc_test`.`category` (`id`, `name`, `showPreview`, `showCode`) "
                                . "VALUES (NULL, '$codeNewCategory[$x]', '1','1')");
                        $catID = $db->lastInsertId();
                        $linkThatCat = $db->query("INSERT INTO `cc_test`.`catmap` (`id`, `code_id`, `cat_id`) VALUES (NULL, '$codeID', '$catID')");
                    
                }
            }
            if ($codeNewTag) {
                for ($x = 0; $x < $codeNewTags; $x++) {
                       // echo 'Category: ' . $codeCategory;
                        // INSERT INTO `cc_test`.`category` (`id`, `name`, `showPreview`, `showCode`) VALUES (NULL, 'jQuery', '1', '1');
                        $addThatTag = $db->query("INSERT INTO `cc_test`.`tag` (`id`, `name`) "
                                . "VALUES (NULL, '$codeNewTag[$x]')");
                        $tagID = $db->lastInsertId();
                        $linkThatTag = $db->query("INSERT INTO `cc_test`.`tagmap` (`id`, `tag_id`, `code_id`) VALUES (NULL, '$tagID', '$codeID')");
                    
                }
            }
           print_r($_POST);
    }

    public static function displayAllCats() {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $req = $db->query('SELECT id, name FROM category 
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        foreach ($req->fetchAll() as $row) {
            array_push($list,[$row['id'], $row['name']]);
        }
        return $list;
    }

    public static function displayAllTags() {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $req = $db->query('SELECT DISTINCT id, name FROM tag 
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        foreach ($req->fetchAll() as $row) {
            array_push($list, [$row['id'], $row['name']]);
        }
      //  $list = array_unique($list);
        return $list;
    }
}

?>