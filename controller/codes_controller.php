<?php
  class CodesController {
    public function index() {
      $sidebar = Code::sidebar();
      $codes = Code::all();
      require_once('view/codes/index.php');
    }
    
    public function error() {
      $sidebar = Code::sidebar();
      $codes = Code::all();
      require_once('view/codes/error.php');
    }

    public function show() {
      // we expect a url of form ?controller=codes&action=show&id=x
      // without an id we just redirect to the error page as we need the code id to find it in the database
      if (!isset($_GET['id']))
        return call('codes', 'error');

      $sidebar = Code::sidebar();
      $codes = Code::all();
      // we use the given id to get the right code
      $code = Code::find($_GET['id']);
      require_once('view/codes/show.php');
    }
    
    public function categories() {
        $sidebar = Code::sidebar();
        $available_categories = Code::displayAllCats();
        if (!isset($_GET['category']))
            return call('codes', 'error');
        if(in_array($_GET['category'], $available_categories)) {
            $codes = Code::categories($_GET['category']);
            require_once('view/codes/categories.php');
        }
        else 
            return call('codes', 'error');
    }
    public function tags() {
        $sidebar = Code::sidebar();
        $available_tags = Code::displayAllTags();
        if (!isset($_GET['tag']))
            return call('codes', 'error');
        if(in_array($_GET['tag'], $available_tags)) {
            $codes = Code::tags($_GET['tag']);
            require_once('view/codes/tags.php');
        }
        else 
            return call('codes', 'error');
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

