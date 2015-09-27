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
    public $sourcecode07, $sourcecode07title;
    public $sourcecode08, $sourcecode08title;
    public $sourcecode09, $sourcecode09title;
    public $sourcecodes;

    public function __construct($id, $title, $description, $author, $files, $sourcecode00, $sourcecode00title, $sourcecode01, $sourcecode01title, $sourcecode02, $sourcecode02title, $sourcecode03, $sourcecode03title, $sourcecode04, $sourcecode04title, $sourcecode05, $sourcecode05title, $sourcecode06, $sourcecode06title, $sourcecode07, $sourcecode07title, $sourcecode08, $sourcecode08title, $sourcecode09, $sourcecode09title) {
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

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM code ORDER BY id DESC');
        // we create a list of Post objects from the database results
        foreach ($req->fetchAll() as $code) {
            $list[] = ['theCode' => new Code($code['id'], $code['title'], $code['description'], $code['author'], $code['files'],
                    $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'],
                    $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'],
                    $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'],
                    $code['sourcecode06'], $code['sourcecode06title'], $code['sourcecode07'], $code['sourcecode07title'],
                    $code['sourcecode08'], $code['sourcecode08title'], $code['sourcecode09'], $code['sourcecode09title'])];
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

        return new Code($code['id'], $code['title'], $code['description'], $code['author'], $code['files'],
        $code['sourcecode00'], $code['sourcecode00title'], $code['sourcecode01'], $code['sourcecode01title'],
        $code['sourcecode02'], $code['sourcecode02title'], $code['sourcecode03'], $code['sourcecode03title'],
        $code['sourcecode04'], $code['sourcecode04title'], $code['sourcecode05'], $code['sourcecode05title'],
        $code['sourcecode06'], $code['sourcecode06title'], $code['sourcecode07'], $code['sourcecode07title'],
        $code['sourcecode08'], $code['sourcecode08title'], $code['sourcecode09'], $code['sourcecode09title']);
    }


    public static function displayUser($id) {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM users
                    INNER JOIN usermap
                    ON usermap.code_id = :id
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

    public static function displayCourses($id) {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT courses.name FROM courses
                    INNER JOIN course_code_definition
                    ON course_code_definition.code_id = :id
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
                        $code['sourcecode06'], $code['sourcecode06title'], $code['sourcecode07'], $code['sourcecode07title'],
                        $code['sourcecode08'], $code['sourcecode08title'], $code['sourcecode09'], $code['sourcecode09title'])
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
                        . 'code.sourcecode07, code.sourcecode07title'
                        . 'code.sourcecode08, code.sourcecode08title'
                        . 'code.sourcecode09, code.sourcecode09title'
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
                        $code['sourcecode06'], $code['sourcecode06title'],
                        $code['sourcecode07'], $code['sourcecode07title'],
                        $code['sourcecode08'], $code['sourcecode08title'],
                        $code['sourcecode09'], $code['sourcecode09title'])
                ];
            }

        return $list;
        } else {
            $getTagsQry = 'SELECT * FROM tag WHERE name = \'' . $tag . '\' ORDER BY id';
            $tagReq = $db->query($getTagsQry);
        // we create a list of Code objects from the database results
            foreach ($tagReq->fetchAll() as $tg) {
            // the query was prepared, now we replace :id with our actual $id value
                $getCodesQry = 'SELECT * FROM code' . "
                        INNER JOIN tagmap
                        ON tagmap.tag_id = '" . $tg['id'] .
                        "' AND code.id = tagmap.code_id";
                $req = $db->query($getCodesQry);
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
                        $code['sourcecode06'], $code['sourcecode06title'], $code['sourcecode07'], $code['sourcecode07title'],
                        $code['sourcecode08'], $code['sourcecode08title'], $code['sourcecode09'], $code['sourcecode09title'])
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

    public static function editCode($id) {
        $id = intval($id);
        // for debugging
        // print_r($_POST);

        // grab the components for the new Code being added
        // set them to null if they didn't submit a value
        //
        //
        // TO DO: set required fields and strip the nulling of them
        //
        //
        $codeTitle = isset($_POST['title'])?$_POST['title']:null;
        $codeDescription = isset($_POST['description'])?$_POST['description']:null;
        $codeAuthor = isset($_POST['author'])?$_POST['author']:null;
        $codeImage = isset($_POST['image'])?$_POST['image']:null;
        $codeFiles = isset($_POST['files'])?$_POST['files']:null;
        $codeSourceCode00Title = isset($_POST['sourcecode00title'])?$_POST['sourcecode00title']:null;
        $codeSourceCode00 = isset($_POST['sourcecode00'])?$_POST['sourcecode00']:null;
        $codeSourceCode01Title = isset($_POST['sourcecode01title'])?$_POST['sourcecode01title']:null;
        $codeSourceCode01 = isset($_POST['sourcecode01'])?$_POST['sourcecode01']:null;
        $codeSourceCode02Title = isset($_POST['sourcecode02title'])?$_POST['sourcecode02title']:null;
        $codeSourceCode02 = isset($_POST['sourcecode02'])?$_POST['sourcecode02']:null;
        $codeSourceCode03Title = isset($_POST['sourcecode03title'])?$_POST['sourcecode03title']:null;
        $codeSourceCode03 = isset($_POST['sourcecode03'])?$_POST['sourcecode03']:null;
        $codeSourceCode04Title = isset($_POST['sourcecode04title'])?$_POST['sourcecode04title']:null;
        $codeSourceCode04 = isset($_POST['sourcecode04'])?$_POST['sourcecode04']:null;
        $codeSourceCode05Title = isset($_POST['sourcecode05title'])?$_POST['sourcecode05title']:null;
        $codeSourceCode05 = isset($_POST['sourcecode05'])?$_POST['sourcecode05']:null;
        $codeSourceCode06Title = isset($_POST['sourcecode06title'])?$_POST['sourcecode06title']:null;
        $codeSourceCode06 = isset($_POST['sourcecode06'])?$_POST['sourcecode06']:null;
        $codeSourceCode07Title = isset($_POST['sourcecode07title'])?$_POST['sourcecode07title']:null;
        $codeSourceCode07 = isset($_POST['sourcecode07'])?$_POST['sourcecode07']:null;
        $codeSourceCode08Title = isset($_POST['sourcecode08title'])?$_POST['sourcecode08title']:null;
        $codeSourceCode08 = isset($_POST['sourcecode08'])?$_POST['sourcecode08']:null;
        $codeSourceCode09Title = isset($_POST['sourcecode09title'])?$_POST['sourcecode09title']:null;
        $codeSourceCode09 = isset($_POST['sourcecode09'])?$_POST['sourcecode09']:null;

        // $codeCourses holds an array of any preexisting courses that were selected
        $codeCourses = isset($_POST['courses'])?$_POST['courses']:null;
        // $codeNewCourses holds the # of new courses they added
        $codeNewCourses = isset($_POST['newCourses'])?$_POST['newCourses']:null;
        // $codeNewCourse holds an array of the new tags they added
        $codeNewCourseCode = isset($_POST['newCourseCode'])?$_POST['newCourseCode']:null;
        $codeNewCourseName = isset($_POST['newCourseName'])?$_POST['newCourseName']:null;
        $codeNewCourseCategories = isset($_POST['newCourseCategories'])?$_POST['newCourseCategories']:null;

        // $codeCategories holds an array of any preexisting categories that were selected
        $codeCategories = isset($_POST['categories'])?$_POST['categories']:null;
        // $codeNewCategories holds the # of new categories they added
        $codeNewCategories = isset($_POST['newCategories'])?$_POST['newCategories']:null;
        // $codeNewCategory holds an array of the new categories they added
        $codeNewCategory = isset($_POST['newCategory'])?$_POST['newCategory']:null;

        // $codeTags holds an array of any preexisting tags that were selected
        $codeTags = isset($_POST['tags'])?$_POST['tags']:null;
        // $codeNewTags holds the # of new tags they added
        $codeNewTags = isset($_POST['newTags'])?$_POST['newTags']:null;
        // $codeNewTag holds an array of the new tags they added
        $codeNewTag = isset($_POST['newTag'])?$_POST['newTag']:null;



        // fire up the database connection
        $db = Db::getInstance();

        $qry = "";
        if($codeTitle) { $qry .= "`title` = '" . $codeTitle."', ";}
        if($codeDescription) { $qry .= "`description` = '" . $codeDescription."', ";}
        if($codeAuthor) { $qry .= "`author` = '" . $codeAuthor."', ";}
        if($codeFiles) { $qry .= "`files` = '" . $files."', ";}
        if($codeImage) { $qry .= "`image` = '" . $image."', ";}
        if($codeSourceCode00Title) { $qry .= "`sourcecode00title` = '" . $codeSourceCode00Title."', ";}
        if($codeSourceCode00) { $qry .= "`sourcecode00` = '" . $codeSourceCode00."', ";}
        if($codeSourceCode01Title) { $qry .= "`sourcecode01title` = '" . $codeSourceCode01Title."', ";}
        if($codeSourceCode01) { $qry .= "`sourcecode01` = '" . $codeSourceCode01."', ";}
        if($codeSourceCode02Title) { $qry .= "`sourcecode02title` = '" . $codeSourceCode02Title."', ";}
        if($codeSourceCode02) { $qry .= "`sourcecode02` = '" . $codeSourceCode02."', ";}
        if($codeSourceCode03Title) { $qry .= "`sourcecode03title` = '" . $codeSourceCode03Title."', ";}
        if($codeSourceCode03) { $qry .= "`sourcecode03` = '" . $codeSourceCode03."', ";}
        if($codeSourceCode04Title) { $qry .= "`sourcecode04title` = '" . $codeSourceCode04Title."', ";}
        if($codeSourceCode04) { $qry .= "`sourcecode04` = '" . $codeSourceCode04."', ";}
        if($codeSourceCode05Title) { $qry .= "`sourcecode05title` = '" . $codeSourceCode05Title."', ";}
        if($codeSourceCode05) { $qry .= "`sourcecode05` = '" . $codeSourceCode05."', ";}
        if($codeSourceCode06Title) { $qry .= "`sourcecode06title` = '" . $codeSourceCode06Title."', ";}
        if($codeSourceCode06) { $qry .= "`sourcecode06` = '" . $codeSourceCode06."', ";}
        if($codeSourceCode07Title) { $qry .= "`sourcecode07title` = '" . $codeSourceCode07Title."', ";}
        if($codeSourceCode07) { $qry .= "`sourcecode07` = '" . $codeSourceCode07."', ";}
        if($codeSourceCode08Title) { $qry .= "`sourcecode08title` = '" . $codeSourceCode08Title."', ";}
        if($codeSourceCode08) { $qry .= "`sourcecode08` = '" . $codeSourceCode08."', ";}
        if($codeSourceCode09Title) { $qry .= "`sourcecode09title` = '" . $codeSourceCode09Title."', ";}
        if($codeSourceCode09) { $qry .= "`sourcecode09` = '" . $codeSourceCode09."', ";}

        $qry = rtrim($qry, ', ');
        // use prepare/execute instead of query so that harmful code is not directly injected
        // insert a new Code into the code table
        $req = $db->prepare("UPDATE `cc_test`.`code` SET $qry WHERE `code`.`id` = ?");
        $req->execute(array($id));
print_r($qry);
        // get the ID of the code inserted to use in building category and tag associations
        $codeID = $db->lastInsertId();

        // check if a course was selected and link its id to the code's id
        if ($codeCourses) {
            foreach($codeCourses as $codeCourse) {
                $catReq = $db->query(
                    "INSERT INTO `cc_test`.`course_code_definition` (`id`, `course_id`, `code_id`, `definition_id`)
                    VALUES (NULL, '$codeCourse', '$codeID', NULL)"
                );
            }
        }
        // check if a category was selected and link its id to the code's id
        if ($codeCategories) {
            foreach($codeCategories as $codeCategory) {
                $catReq = $db->query(
                    "INSERT INTO `cc_test`.`catmap` (`id`, `code_id`, `cat_id`)
                    VALUES (NULL, '$codeID', '$codeCategory')"
                );
            }
        }
        // check if a tag was selected and link its id to the code's id
        if ($codeTags) {
            foreach($codeTags as $codeTag) {
                $tagReq = $db->query(
                    "INSERT INTO `cc_test`.`tagmap` (`id`, `tag_id`, `code_id`)
                    VALUES (NULL, '$codeTag', '$codeID')"
                );
            }
        }
        // check if new courses were added and add them to the database
        // then link each id to the code's id
        if ($codeNewCourseCode) {
            for ($x = 0; $x < $codeNewCourses; $x++) {
                // add the new course code
                    $addThatCourse = $db->query(
                        "INSERT INTO `cc_test`.`courses`
                        (`code`, `name`)
                        VALUES ('$codeNewCourseCode[$x]', '$codeNewCourseName[$x]')"
                    );
                    // get the ID of the course inserted
                    // then link each course code to the code's id
                    $linkThatCourse = $db->query(
                        "INSERT INTO `cc_test`.`course_code_definition` (`id`, `course_id`, `code_id`, `definition_id`)
                        VALUES (NULL, '$codeNewCourseCode[$x]', '$codeID', NULL)"
                    );
                    print_r($codeNewCategories[$x]);
                    $linkThatCourseToACategory = $db->query(
                        "INSERT INTO `cc_test`.`coursemap` (`id`, `course_id`, `cat_id`)
                        VALUES (NULL, '$codeNewCourseCode[$x]', '$codeNewCourseCategories[$x]')"
                    );
                    // get the ID of the category inserted to use in building category and code associations
                    $catID = $db->lastInsertId();
                    $linkThatCategoryToTheCode = $db->query(
                        "INSERT INTO `cc_test`.`catmap` (`id`, `code_id`, `cat_id`)
                        VALUES (NULL, '$codeID', '$catID')"
                    );
            }
        }

        // check if new categories were added and add them to the database
        // then link each id to the code's id
        if ($codeNewCategory) {
            for ($x = 0; $x < $codeNewCategories; $x++) {
                    $addThatCat = $db->query(
                        "INSERT INTO `cc_test`.`category`
                        (`id`, `name`, `showPreview`, `showCode`)
                        VALUES (NULL, '$codeNewCategory[$x]', '1','1')"
                    );
                    // get the ID of the category inserted
                    // then link each id to the code's id
                    $catID = $db->lastInsertId();
                    $linkThatCat = $db->query(
                        "INSERT INTO `cc_test`.`catmap` (`id`, `code_id`, `cat_id`)
                        VALUES (NULL, '$codeID', '$catID')"
                    );
            }
        }
        // check if new tags were added and add them to the database
        // then link each id to the code's id
        if ($codeNewTag) {
            for ($x = 0; $x < $codeNewTags; $x++) {
                    $addThatTag = $db->query(
                        "INSERT INTO `cc_test`.`tag` (`id`, `name`)
                        VALUES (NULL, '$codeNewTag[$x]')"
                    );
                    // get the ID of the tag inserted
                    // then link each id to the code's id
                    $tagID = $db->lastInsertId();
                    $linkThatTag = $db->query(
                        "INSERT INTO `cc_test`.`tagmap` (`id`, `tag_id`, `code_id`)
                        VALUES (NULL, '$tagID', '$codeID')"
                    );
            }
        }
    }


}

?>
