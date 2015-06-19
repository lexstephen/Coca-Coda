<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO('mysql:host=localhost;dbname=cc_test', 'cc_tester', 'cctest', $pdo_options);
          //  $this->con = new PDO('mysql:host=localhost;dbname=cc_test', 'cc_tester', 'cctest');
      }
      return self::$instance;
    }
  }
?>