<?php
  class CodesController {
    public function index() {
      // we store all the codes in a variable
      $codes = Code::all();
      require_once('view/codes/index.php');
    }

    public function show() {
      // we expect a url of form ?controller=codes&action=show&id=x
      // without an id we just redirect to the error page as we need the code id to find it in the database
      if (!isset($_GET['id']))
        return call('codes', 'error');

      // we use the given id to get the right code
      $code = Code::find($_GET['id']);
      require_once('view/codes/show.php');
    }
    
    public function codepreview() {
      // we expect a url of form ?controller=codes&action=codepreview&id=x
      // without an id we just redirect to the error page as we need the code id to find it in the database
      if (!isset($_GET['id']))
        return call('codes', 'error');

      // we use the given id to get the right code
      $code = Code::find($_GET['id']);
      require_once('view/codes/codepreview.php');
    }
  }
?>