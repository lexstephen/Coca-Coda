<?php
  class Code {
    // attributes are public so that we can access them using $post->author directly
    public $id, $title, $description, $author, $files;
    public $sourcecode00, $sourcecode00title;
    public $sourcecode01, $sourcecode01title;
    public $sourcecode02, $sourcecode02title;
    public $sourcecode03, $sourcecode03title;
    public $sourcecode04, $sourcecode04title;
    public $sourcecode05, $sourcecode05title;
    public $sourcecode06, $sourcecode06title;

    public function __construct($id, $title, $description, $author, $files, $sourcecode00, $sourcecode00title, $sourcecode01, $sourcecode01title, $sourcecode02, $sourcecode02title, $sourcecode03, $sourcecode03title, $sourcecode04, $sourcecode04title, $sourcecode05, $sourcecode05title, $sourcecode06, $sourcecode06title) {
      $this->id                     = $id;
      $this->title                  = $title;
      $this->description            = $description;
      $this->author                 = $author;
      $this->files                  = $files;
      $this->sourcecode00           = $sourcecode00;
      $this->sourcecode00title      = $sourcecode00title;
      $this->sourcecode01           = $sourcecode01;
      $this->sourcecode01title      = $sourcecode01title;
      $this->sourcecode02           = $sourcecode02;
      $this->sourcecode02title      = $sourcecode02title;
      $this->sourcecode03           = $sourcecode03;
      $this->sourcecode03title      = $sourcecode03title;
      $this->sourcecode04           = $sourcecode04;
      $this->sourcecode04title      = $sourcecode04title;
      $this->sourcecode05           = $sourcecode05;
      $this->sourcecode05title      = $sourcecode05title;
      $this->sourcecode06           = $sourcecode06;
      $this->sourcecode06title      = $sourcecode06title;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM code');
      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $code) {
        $list[] = new Code($code['id'], $code['title'], $code['description'], $code['author'], $code['files'], $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'], $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'], $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'], $code['sourcecode06'], $code['sourcecode06title']);
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
    
    public static function displayTags($id)
    {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT name FROM tag 
                    INNER JOIN tagmap
                    ON tagmap.code_id = :id
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
    
    public static function displayCats($id)
    {
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
      $rows = $req->fetchAll();

      $statement = [];
        foreach ($rows as $row) {
            array_push($statement, $row['name']);
//            var_dump($row);
        }
        return $statement;
    }
    
  }
?>