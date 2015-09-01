<?php
  class AddController {
      
    public function code() {
        // build sidebar, available tags, list of all add
        // display index
        $available_tags = Add::displayAllTags();
        $available_categories = Add::displayAllCats();
        $sidebar = Application::sidebar();
        require_once('view/add/code.php');
    }
    
    public function error() {
        // build sidebar, available tags, list of all add
        // display error
        $available_tags = Add::displayAllTags();
        $sidebar = Application::sidebar();
        require_once('view/add/error.php');
    }

  }
?>

