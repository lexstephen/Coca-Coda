<?php
class Profile {
        
    public function __construct() {}
    
    public static function addUser() {
        
        $username = isset($_POST['username'])?$_POST['username']:null;
        // client-side we made sure both passwords matched, here we just grab the first
        $password_tmp = isset($_POST['password1'])?$_POST['password1']:null; 
        $first_name = isset($_POST['first_name'])?$_POST['first_name']:null;
        $last_name = isset($_POST['last_name'])?$_POST['last_name']:null;
        $email_address = isset($_POST['email_address'])?$_POST['email_address']:null;
        $image = isset($_POST['image'])?$_POST['image']:null;
        $website = isset($_POST['website'])&&($_POST['website']!='http://')?$_POST['website']:null;
        
        // salt it & hash it
        $token = password_hash($password_tmp, PASSWORD_DEFAULT);
        
        // fire up the database connection
        $db = Db::getInstance();
        
        // use prepare/execute instead of query so that harmful code is not directly injected
        // insert a new Code into the code table
        $req = $db->prepare(
                "INSERT INTO `cc_test`.`users` 
                    (`id`, `username`, `password`, `first_name`, `last_name`, `email_address`, `image`, `website`) 
                VALUES 
                    (NULL, ?, ?, ?, ?, ?, ?, ?);"
        );
        $req->execute(array($username, $token, $first_name, $last_name, $email_address, $image, $website));

        // get the ID of the code inserted to use in building category and tag associations
        $userID = $db->lastInsertId();
    }
    
    
    public static function login() {
        
        $username_tmp = isset($_POST['username'])?$_POST['username']:null;
        // client-side we made sure both passwords matched, here we just grab the first
        $password_tmp = isset($_POST['password1'])?$_POST['password1']:null; 
        // salt it & hash it
        
        $token = password_hash($password_tmp, PASSWORD_DEFAULT);

        // fire up the database connection
        $db = Db::getInstance();
        
        // check that the username exists
        $req = $db->prepare("SELECT * from `cc_test`.`users` WHERE `username` = '$username_tmp'");
        $req->execute();
        
        // were any rows returned?
        if ($req->rowCount()) {
            foreach ($req->fetchAll() as $user) {
                // check that the password is correct
                if (password_verify($password_tmp, $user['password'])) {
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['first_name'] = $user['first_name'];
                } else {
                    // this person is obviously trying to hack everything
                    echo 'Invalid password.';
                }
            }
        }
        else {
            echo 'Username not found.  <a href="index.php?controller=profile&action=register">Register</a>?';
        }

        // get the ID of the code inserted to use in building category and tag associations
        $userID = $db->lastInsertId();
    }
    public static function logout() {
        session_destroy();
    }
    public static function find($id) {
        
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM users 
                    WHERE id = :id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        $row = $req->fetch();
        
        $statement = [
                        'username' => $row['username'],
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                        'image' => $row['image'],
                        'website' => $row['website']
                        ];
//            var_dump($row);
        return $statement;
    }
    public static function displayAllCodes($id) {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id = intval($id);
        $req = $db->prepare('SELECT code.id, code.title, code.description FROM code
                    INNER JOIN usermap
                    ON usermap.user_id = :id
                    AND usermap.code_id = code.id');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id' => $id));
        foreach ($req->fetchAll() as $row) {
        $list[] = [
                        'id' => $row['id'],
                        'title' => $row['title'],
                        'description' => $row['description']
                        ];
        }
        return $list;
    }
    
    public static function displayAllDefinitions($id) {
        $list = [];
        $db = Db::getInstance();
        // we make sure $id is an integer
        $req = $db->prepare('SELECT definition.id, definition.term, definition.definition FROM definition
                    INNER JOIN usermap
                    ON usermap.user_id = :id
                    AND usermap.definition_id = definition.id');
        $req->execute(array('id' => $id));
        // the query was prepared, now we replace :id with our actual $id value
        foreach ($req->fetchAll() as $row) {
        $list[] = [
                        'id' => $row['id'],
                        'term' => $row['term'],
                        'definition' => $row['definition']
                        ];
        }
        return $list;
    }
}
?>