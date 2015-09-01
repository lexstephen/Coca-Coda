<?php
  class CodesController {
      
    public function index() {
        // build sidebar, available tags, list of all codes
        // display index
        $sidebar = Code::sidebar();
        $available_tags = Code::displayAllTags();
        $codes = Code::all();
        require_once('view/codes/index.php');
    }
    
    public function error() {
        // build sidebar, available tags, list of all codes
        // display error
        $sidebar = Code::sidebar();
        $available_tags = Code::displayAllTags();
        $codes = Code::all();
        require_once('view/codes/error.php');
    }

    public function show() {
        // build sidebar, available tags, available code IDs, list of all codes
        // display error if id= not assigned or not in available code IDs
        $sidebar = Code::sidebar();
        $available_tags = Code::displayAllTags();
        $available_codes = Code::displayAllCodes();
        $codes = Code::all();
        if((isset($_GET['id'])) && in_array($_GET['id'], $available_codes)) {
            // use the given id to get the right code
            $code = Code::find($_GET['id']);
            require_once('view/codes/show.php');
        } else
            return call('codes', 'error');
    }
    
    
    public function search() {
      // we expect a url of form ?controller=codes&action=show&id=x
      // without an id we just redirect to the error page as we need the code id to find it in the database
      if (!isset($_GET['term']))
        return call('codes', 'error');

      $sidebar = Code::sidebar();
      $available_tags = Code::displayAllTags();
      $codes = Code::search($_GET['term']);
      require_once('view/codes/search.php');
    }
    
    public function categories() {
        $sidebar = Code::sidebar();
        $available_tags = Code::displayAllTags();
        $available_categories = Code::displayAllCats();
        if (!isset($_GET['category']))
            return call('codes', 'error');
        if(in_array($_GET['category'], $available_categories)) {
            $codes = Code::categories($_GET['category']);
            require_once('view/codes/categories.php');
        }
        elseif ($_GET['category'] == "all") {
            $codes = Code::all();
            require_once('view/codes/categories.php');
        }
        else 
            return call('codes', 'error');
    }
    public function tags() {
        $sidebar = Code::sidebar();
        $available_tags = Code::displayAllTags();
            $codes = Code::all();
        if (!isset($_GET['tag']))
            return call('codes', 'error');
        if(in_array($_GET['tag'], $available_tags)) {
            $codes = Code::tags($_GET['tag']);
            require_once('view/codes/tags.php');
        } 
        elseif ($_GET['tag'] == "all") {
            $codes = Code::all();
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

