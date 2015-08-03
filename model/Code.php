<?php

class Code {

    // attributes are public so that we can access them using $code->id directly
    public $id, $title, $description, $author, $files;
    public $sourcecode00, $sourcecode00title;
    public $sourcecode01, $sourcecode01title;
    public $sourcecode02, $sourcecode02title;
    public $sourcecode03, $sourcecode03title;
    public $sourcecode04, $sourcecode04title;
    public $sourcecode05, $sourcecode05title;
    public $sourcecode06, $sourcecode06title;
    public $sourcecodes;
    
    public function __construct($id, $title, $description, $author, $files, $sourcecode00, $sourcecode00title, $sourcecode01, $sourcecode01title, $sourcecode02, $sourcecode02title, $sourcecode03, $sourcecode03title, $sourcecode04, $sourcecode04title, $sourcecode05, $sourcecode05title, $sourcecode06, $sourcecode06title) {
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
            ['code' => $sourcecode06, 'title' => $sourcecode06title]];
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM code ORDER BY id DESC');
        // we create a list of Post objects from the database results
        foreach ($req->fetchAll() as $code) {
            $list[] = ['theCode' => new Code($code['id'], $code['title'], $code['description'], $code['author'], $code['files'], $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'], $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'], $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'], $code['sourcecode06'], $code['sourcecode06title'])];
        }
        return $list;
    }

    public static function find($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM code WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $code = $req->fetch();

        return new Code($code['id'], $code['title'], $code['description'], $code['author'], $code['files'], $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'], $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'], $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'], $code['sourcecode06'], $code['sourcecode06title']);
    }
    
    
    public static function search($term) {
        $list = [];
        $db = Db::getInstance();
        $searchQry = "SELECT * FROM code 
                WHERE (code.title LIKE '%". $term ."%')
                OR (code.author LIKE '%". $term ."%')
                OR (code.description LIKE '%". $term ."%')
                OR (code.sourcecode00 LIKE '%". $term ."%')
                OR (code.sourcecode00title LIKE '%". $term ."%')
                OR (code.sourcecode01 LIKE '%". $term ."%')
                OR (code.sourcecode01title LIKE '%". $term ."%')
                OR (code.sourcecode02 LIKE '%". $term ."%')
                OR (code.sourcecode02title LIKE '%". $term ."%')
                OR (code.sourcecode03 LIKE '%". $term ."%')
                OR (code.sourcecode03title LIKE '%". $term ."%')
                OR (code.sourcecode04 LIKE '%". $term ."%')
                OR (code.sourcecode04title LIKE '%". $term ."%')
                OR (code.sourcecode05 LIKE '%". $term ."%')
                OR (code.sourcecode05title LIKE '%". $term ."%')";
        $req = $db->query($searchQry);
        // the query was prepared, now we replace :id with our actual $id value

        //var_dump($req->fetchAll());
        
        foreach ($req->fetchAll() as $code) {
            $list[] = ['theCode' => new Code($code['id'], $code['title'], $code['description'], $code['author'], $code['files'], $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'], $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'], $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'], $code['sourcecode06'], $code['sourcecode06title'])];
        }
        return $list;
    }

    public static function displayTags($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT name FROM tagmap
                    WHERE code_id = :id
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $rows = $req->fetchAll();

        $statement = [];
        foreach ($rows as $row) {
            array_push($statement, $row['name']);
//            var_dump($row);
        }
        return $statement;
    }

    public static function displayCats($id) {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT name FROM category 
                    INNER JOIN catmap
                    ON catmap.code_id = :id
                    AND category.id = catmap.cat_id
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        foreach ($req->fetchAll() as $row) {
            array_push($list, $row['name']);
        }
        return $list;
    }
    public static function displayAllCats() {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $req = $db->query('SELECT name FROM category 
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        foreach ($req->fetchAll() as $row) {
            array_push($list, $row['name']);
        }
        return $list;
    }

    public static function displayAllTags() {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $req = $db->query('SELECT name FROM tagmap 
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        foreach ($req->fetchAll() as $row) {
            array_push($list, $row['name']);
        }
        $list = array_unique($list);
        return $list;
    }
    
    public static function displayAllCodes() {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $req = $db->query('SELECT id FROM code
                    ORDER BY id ASC');
        // the query was prepared, now we replace :id with our actual $id value
        foreach ($req->fetchAll() as $row) {
            array_push($list, $row['id']);
        }
        $list = array_unique($list);
        return $list;
    }

    public static function sidebar() {
        $list = [];
        $db = Db::getInstance();

        $catReq = $db->query('SELECT * FROM category ORDER BY name');

        // we create a list of Code objects from the database results
        foreach ($catReq->fetchAll() as $cat) {
            $req = $db->prepare('SELECT * FROM code
                    INNER JOIN catmap
                    ON catmap.cat_id = :id
                    AND code.id = catmap.code_id');
            // the query was prepared, now we replace :id with our actual $id value
            $req->execute(array('id' => $cat['id']));

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $code) {
                $list[] = [
                        'category' => $cat['name'],
                    'theCode' => new Code($code['code_id'], $code['title'], 
                        $code['description'], $code['author'], $code['files'], 
                        $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'], 
                        $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'], 
                        $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'], 
                        $code['sourcecode06'], $code['sourcecode06title'])
                ];
            }
        }
        return $list;
    }
    
    public static function categories($category) {
        $list = [];
        $db = Db::getInstance();

//        $checkCatQry = 'SELECT name FROM category';
//        $checkCat = $db->query($checkCatQry);
//        foreach ($checkCat->fetchAll() as $chk) {
//        echo $chk['name'];
//        }
        $thisQry = 'SELECT * FROM category WHERE category.name = \'' . $category . '\' ORDER BY id';
        $catReq = $db->query($thisQry);
        // we create a list of Code objects from the database results
        foreach ($catReq->fetchAll() as $cat) {
            $req = $db->prepare('SELECT * FROM code
                    INNER JOIN catmap
                    ON catmap.cat_id = :id
                    AND code.id = catmap.code_id');
            // the query was prepared, now we replace :id with our actual $id value
            $req->execute(array('id' => $cat['id']));

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $code) {
                $list[] = [
                        'category' => $cat['name'],
                    'theCode' => new Code($code['code_id'], $code['title'], 
                        $code['description'], $code['author'], $code['files'], 
                        $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'], 
                        $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'], 
                        $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'], 
                        $code['sourcecode06'], $code['sourcecode06title'])
                ];
            }
        }
        return $list;
    }
    public static function tags($tag) {
        $list = [];
        $db = Db::getInstance();

//        $checkCatQry = 'SELECT name FROM category';
//        $checkCat = $db->query($checkCatQry);
//        foreach ($checkCat->fetchAll() as $chk) {
//        echo $chk['name'];
//        }
        if ($tag == "all") {
            
            // the query was prepared, now we replace :id with our actual $id value
                $getCodesQry = 'SELECT DISTINCT code.id, code.title,'
                        . 'code.description, code.author, code.files,'
                        . 'code.sourcecode00, code.sourcecode00title,'
                        . 'code.sourcecode01, code.sourcecode01title,'
                        . 'code.sourcecode02, code.sourcecode02title,'
                        . 'code.sourcecode03, code.sourcecode03title,'
                        . 'code.sourcecode04, code.sourcecode04title,'
                        . 'code.sourcecode05, code.sourcecode05title,'
                        . 'code.sourcecode06, code.sourcecode06title'
                        . ' FROM code INNER JOIN tagmap';
                $req = $db->query($getCodesQry);
                //echo '<br>'.$getCodesQry;
                $whichKind = 'id';

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $code) {
                $list[] = [
                    'theCode' => new Code($code[$whichKind], $code['title'], 
                        $code['description'], $code['author'], $code['files'], 
                        $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'], 
                        $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'], 
                        $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'], 
                        $code['sourcecode06'], $code['sourcecode06title'])
                ];
            }
        
        return $list;
        } else {
            $getTagsQry = 'SELECT * FROM tagmap WHERE name = \'' . $tag . '\' ORDER BY id';
            $tagReq = $db->query($getTagsQry);
        // we create a list of Code objects from the database results
            foreach ($tagReq->fetchAll() as $tg) {
            // the query was prepared, now we replace :id with our actual $id value
                $getCodesQry = 'SELECT * FROM code' . "
                        INNER JOIN tagmap
                        ON tagmap.name = '" . $tg['name'] .
                        "' AND code.id = tagmap.code_id";
                $req = $db->query($getCodesQry);
                //echo '<br>'.$getCodesQry;
                $whichKind = 'code_id';
            }

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $code) {
                $list[] = [
                    'tag' => $tg['name'],
                    'theCode' => new Code($code[$whichKind], $code['title'], 
                        $code['description'], $code['author'], $code['files'], 
                        $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'], 
                        $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'], 
                        $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'], 
                        $code['sourcecode06'], $code['sourcecode06title'])
                ];
            }
        }
        return $list;
            
        }

    public static function showPreview($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT showPreview FROM category 
                    INNER JOIN catmap
                    ON catmap.code_id = :id
                    AND category.id = catmap.cat_id
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $rows = $req->fetchAll();

        $statement = [];
        foreach ($rows as $row) {
            array_push($statement, $row['showPreview']);
//            var_dump($row);
        }
        return $statement;
    }
    


}

?>