<?php

class Definition {

    // attributes are public so that we can access them using $code->id directly
    public $id, $term, $definition, $sample_code;
    
    public function __construct($id, $term, $definition, $sample_code) {
        $this->id = $id;
        $this->term = $term;
        $this->definition = $definition;
        $this->sample_code = $sample_code;
    }
    
    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM definition ORDER BY id DESC');
        // we create a list of Post objects from the database results
        foreach ($req->fetchAll() as $definition) {
            $list[] = ['theDefinition' => new Definition($definition['id'], 
                $definition['term'], $definition['definition'], $definition['sample_code'])];
        }
        return $list;
    }

    public static function find($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM definition WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $definition = $req->fetch();

        return new Definition($definition['id'], 
                $definition['term'], $definition['definition'], $definition['sample_code']);
    }
    
    
    public static function search($search_term) {
        $list = [];
        $db = Db::getInstance();
        $searchQry = "SELECT * FROM definition 
                WHERE (definition.title LIKE '%". $search_term ."%')
                OR (definition.author LIKE '%". $search_term ."%')
                OR (definition.description LIKE '%". $search_term ."%')
                OR (definition.term LIKE '%". $search_term ."%')
                OR (definition.sample_code LIKE '%". $search_term ."%')";
        $req = $db->query($searchQry);
        // the query was prepared, now we replace :id with our actual $id value

        //var_dump($req->fetchAll());
        
        foreach ($req->fetchAll() as $definition) {
            $list[] = ['theDefinition' => new Definition($definition['id'], 
                $definition['term'], $definition['definition'], $definition['sample_code'])];
        }
        return $list;
    }

    public static function displayUser($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM users 
                    INNER JOIN usermap
                    ON usermap.definition_id = :id
                    AND usermap.user_id = users.id
                    ORDER BY username ASC');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $rows = $req->fetchAll();

        $statement = [];
        foreach ($rows as $row) {
            $statement[] = ['id' => $row['user_id'], 'username' => $row['username'], 'first_name' => $row['first_name']];
            
        }
        return $statement;
    }

    public static function displayTags($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT name FROM tag 
                    INNER JOIN tagmap
                    ON tagmap.definition_id = :id
                    AND tag.id = tagmap.tag_id
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
    
    public static function displayCourses($id) {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT courses.name FROM courses 
                    INNER JOIN course_code_definition
                    ON course_code_definition.definition_id = :id
                    AND course_code_definition.course_id = courses.code
                    ORDER BY courses.name ASC');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        foreach ($req->fetchAll() as $row) {
            array_push($list, $row['name']);
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
            $req = $db->prepare('SELECT * FROM definition
                    INNER JOIN catmap
                    ON catmap.cat_id = :id
                    AND definition.id = catmap.definition_id');
            // the query was prepared, now we replace :id with our actual $id value
            $req->execute(array('id' => $cat['id']));

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $definition) {
                $list[] = [
                        'category' => $cat['name'],
                    'theDefinition' => new Definition($definition['id'], 
                $definition['term'], $definition['definition'], $definition['sample_code'])
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
                $getDefinitionsQry = 'SELECT DISTINCT definition.id, definition.title,'
                        . 'definition.description, definition.author, definition.term,'
                        . 'definition.sample_code'
                        . ' FROM code INNER JOIN tagmap';
                $req = $db->query($getDefinitionsQry);
                $whichKind = 'id';

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $definition) {
                $list[] = [
                    'theDefinition' => new Definition($definition[$whichKind], 
                $definition['term'], $definition['definition'], $definition['sample_code'])
                ];
            }
        
        return $list;
        } else {
            $getTagsQry = 'SELECT * FROM tag WHERE name = \'' . $tag . '\' ORDER BY id';
            $tagReq = $db->query($getTagsQry);
        // we create a list of Code objects from the database results
            foreach ($tagReq->fetchAll() as $tg) {
            // the query was prepared, now we replace :id with our actual $id value
                $getCodesQry = 'SELECT * FROM definition' . "
                        INNER JOIN tagmap
                        ON tagmap.tag_id = '" . $tg['id'] .
                        "' AND definition.id = tagmap.definition_id";
                $req = $db->query($getCodesQry);
                $whichKind = 'definition_id';
            }

            // we create a list of Code objects from the database results
            foreach ($req->fetchAll() as $definition) {
                $list[] = [
                    'tag' => $tg['name'],
                    'theDefinition' => new Definition($definition[$whichKind], 
                $definition['term'], $definition['definition'], $definition['sample_code'])
                ];
            }
        }
        return $list;
            
        }
}
?>