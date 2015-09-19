<?php
class Add {
    public function __construct() {}
    
    public static function addCode() {
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
        
        // use prepare/execute instead of query so that harmful code is not directly injected
        // insert a new Code into the code table
        $req = $db->prepare(
                "INSERT INTO `cc_test`.`code` 
                    (`id`, `title`, `description`, `author`, `files`, `image`, 
                    `sourcecode00title`, `sourcecode00`, `sourcecode01title`, `sourcecode01`, 
                    `sourcecode02title`, `sourcecode02`, `sourcecode03title`, `sourcecode03`, 
                    `sourcecode04title`, `sourcecode04`, `sourcecode05title`, `sourcecode05`, 
                    `sourcecode06title`, `sourcecode06`, `sourcecode07title`, `sourcecode07`, 
                    `sourcecode08title`, `sourcecode08`, `sourcecode09title`, `sourcecode09`) 
                VALUES 
                    (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"
        );
        $req->execute(array($codeTitle, $codeDescription, $codeAuthor, $codeFiles, $codeImage, 
            $codeSourceCode00Title, $codeSourceCode00, $codeSourceCode01Title, $codeSourceCode01, 
            $codeSourceCode02Title, $codeSourceCode02, $codeSourceCode03Title, $codeSourceCode03, 
            $codeSourceCode04Title, $codeSourceCode04, $codeSourceCode05Title, $codeSourceCode05, 
            $codeSourceCode06Title, $codeSourceCode06, $codeSourceCode07Title, $codeSourceCode07, 
            $codeSourceCode08Title, $codeSourceCode08, $codeSourceCode09Title, $codeSourceCode09));

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