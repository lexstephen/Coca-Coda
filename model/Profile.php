<?php
class Profile {
        
    public function __construct() {}
    
    public static function addUser() {
        
        $username = isset($_POST['username'])?$_POST['username']:null;
        // client-side we made sure both passwords matched, here we just grab the first
        $password = isset($_POST['password1'])?$_POST['password1']:null; 
        // salt it & hash it
        $token = hash('ripemd128',"$salt1$password$salt2");
        $first_name = isset($_POST['first_name'])?$_POST['first_name']:null;
        $last_name = isset($_POST['last_name'])?$_POST['last_name']:null;
        $email_address = isset($_POST['email_address'])?$_POST['email_address']:null;
        $image = isset($_POST['image'])?$_POST['image']:null;
        $website = isset($_POST['website'])&&($_POST['website']!='http://')?$_POST['website']:null;
        
        require 'salt.php';
        
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
        require 'salt.php';
        $token = hash('ripemd128',"$salt1$password_tmp$salt2");
       
        // fire up the database connection
        $db = Db::getInstance();
        
        // use prepare/execute instead of query so that harmful code is not directly injected
        // insert a new Code into the code table
        $req = $db->query(
                "SELECT * from `cc_test`.`users` WHERE `username` = '$username_tmp'"
        );
        
        foreach ($req->fetchAll() as $user) {
            print_r($user);
            if($user['password']==$token)
                echo 'You are approved';
        }

        // get the ID of the code inserted to use in building category and tag associations
        $userID = $db->lastInsertId();
    }
}
?>