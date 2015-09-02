<?php
  class AddController {
      
      //
      // CONTENTS: functions for
      // code, definition, error
      //
      
    public function code() {
        // build sidebar, available tags, list of all add
        // display index
        $available_courses = Application::displayAllCourses();
        $available_categories = Application::displayAllCats();
        $available_tags = Application::displayAllTags();
        $sidebar = Application::sidebar();
        $used_tags = Application::displayUsedTags();
        require_once('view/add/code.php');
    }
    
    public function definition() {
        // build sidebar, available tags, list of all add
        // display index
        
        // TO DO: set up a definition view (form), function and behaviour
        $available_categories = Application::displayAllCats();
        $available_tags = Application::displayAllTags();
        $sidebar = Application::sidebar();
        $used_tags = Application::displayUsedTags();
        require_once('view/add/definition.php');
    }
    
    public function error() {
        // build sidebar, available tags, list of all add
        // display error
        $sidebar = Application::sidebar();
        $used_tags = Application::displayUsedTags();
        require_once('view/add/error.php');
    }

  }
?>

