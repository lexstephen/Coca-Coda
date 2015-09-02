<?php

class Display {

    public function __construct() {}


    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('
                    
                    SELECT code.id, code.title, code.description, \'codes\' FROM code
                    INNER JOIN catmap
                    ON code.id = catmap.code_id
                    
                        UNION
                    
                    SELECT definition.id, definition.term, definition.definition, \'definitions\' FROM definition
                    INNER JOIN catmap
                    ON definition.id = catmap.definition_id');
        // we create a list of Post objects from the database results
        foreach ($req->fetchAll() as $code) {
            $list[] = [
                        'type' => isset($code['codes'])?$code['codes']:$code['definitions'], 
                        'id' => isset($code['id'])?$code['id']:$code['id'], 
                        'title' => isset($code['title'])?$code['title']:$code['term'], 
                        'description' => isset($code['description'])?$code['description']:$code['definition']
                    ];
        }
        return $list;
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
                    UNION
                    SELECT name FROM category 
                    INNER JOIN catmap
                    ON catmap.definition_id = :id
                    AND category.id = catmap.cat_id
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        foreach ($req->fetchAll() as $row) {
            array_push($list, $row['name']);
        }
        return $list;
    }
    public static function displayTags($id) {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT name FROM tag 
                    INNER JOIN tagmap
                    ON tagmap.code_id = :id
                    AND tag.id = tagmap.tag_id
                    UNION
                    SELECT name FROM tag 
                    INNER JOIN tagmap
                    ON tagmap.definition_id = :id
                    AND tag.id = tagmap.tag_id
                    ORDER BY name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        foreach ($req->fetchAll() as $row) {
            array_push($list, $row['name']);
        }
        return $list;
    }
     
    public static function categories($category) {
        $list = [];
        $db = Db::getInstance();
        $thisQry = 'SELECT * FROM category WHERE category.name = \'' . $category . '\' ORDER BY id';
        $catReq = $db->query($thisQry);
        // we create a list of Code objects from the database results
        foreach ($catReq->fetchAll() as $cat) {
            $req = $db->prepare('
                    SELECT code.id, code.title, code.description, \'codes\' FROM code
                    INNER JOIN catmap
                    ON catmap.cat_id = :id
                    AND code.id = catmap.code_id
                    
                        UNION
                    
                    SELECT definition.id, definition.term, definition.definition, \'definitions\' FROM definition
                    INNER JOIN catmap
                    ON catmap.cat_id = :id
                    AND definition.id = catmap.definition_id');
            // the query was prepared, now we replace :id with our actual $id value
            $req->execute(array('id' => $cat['id']));

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $code) {
                $list[] = [
                        'category' => $cat['name'],
                        'type' => isset($code['codes'])?$code['codes']:$code['definitions'], 
                        'id' => isset($code['id'])?$code['id']:$code['id'], 
                        'title' => isset($code['title'])?$code['title']:$code['term'], 
                        'description' => isset($code['description'])?$code['description']:$code['definition']];
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
            $getCodesQry = '
                    SELECT code.id, code.title, code.description, \'codes\' FROM code
                    INNER JOIN tagmap
                    ON code.id = tagmap.code_id
                    
                        UNION
                    
                    SELECT definition.id, definition.term, definition.definition, \'definitions\' FROM definition
                    INNER JOIN tagmap
                    ON definition.id = tagmap.definition_id';
                $req = $db->query($getCodesQry);
                //echo '<br>'.$getCodesQry;
                $whichKind = 'id';

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $code) {
                $list[] = [
                        'type' => isset($code['codes'])?$code['codes']:$code['definitions'], 
                        'id' => isset($code['id'])?$code['id']:$code['id'], 
                        'title' => isset($code['title'])?$code['title']:$code['term'], 
                        'description' => isset($code['description'])?$code['description']:$code['definition']];
            }
        
        return $list;
        } else {
            $getTagsQry = 'SELECT * FROM tag WHERE name = \'' . $tag . '\' ORDER BY id';
            $tagReq = $db->query($getTagsQry);
        // we create a list of Code objects from the database results
            foreach ($tagReq->fetchAll() as $tg) {
            // the query was prepared, now we replace :id with our actual $id value
                $getCodesQry = 'SELECT code.id, code.title, code.description, \'codes\' FROM code 
                        INNER JOIN tagmap
                        ON tagmap.tag_id = '. $tg['id'] .'
                         AND code.id = tagmap.code_id 
                         UNION 
                         SELECT definition.id, definition.term, definition.definition, \'definitions\' FROM definition 
                        INNER JOIN tagmap
                        ON tagmap.tag_id = '. $tg['id'] .'
                         AND definition.id = tagmap.definition_id';
                $req = $db->query($getCodesQry);
                $whichKind = 'code_id';
            }

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $code) {
                $list[] = [
                    'tag' => $tg['name'],
                        'type' => isset($code['codes'])?$code['codes']:$code['definitions'], 
                        'id' => isset($code['id'])?$code['id']:$code['id'], 
                        'title' => isset($code['title'])?$code['title']:$code['term'], 
                        'description' => isset($code['description'])?$code['description']:$code['definition']];
            }
        }
        return $list;
            
        }

}

?>