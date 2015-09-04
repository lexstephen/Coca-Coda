<?php
  class ProfileController {
      
      //
      // CONTENTS: functions for
      // code, definition, error
      //
      
    public function register() {
        // build sidebar, available tags, list of all add
        // display index
        $available_courses = Application::displayAllCourses();
        $available_categories = Application::displayAllCats();
        $available_tags = Application::displayAllTags();
        $sidebar = Application::sidebar();
        $used_tags = Application::displayUsedTags();
        require_once('view/profile/register.php');
    }
    public function login() {
        // build sidebar, available tags, list of all add
        // display index
        $available_courses = Application::displayAllCourses();
        $available_categories = Application::displayAllCats();
        $available_tags = Application::displayAllTags();
        $sidebar = Application::sidebar();
        $used_tags = Application::displayUsedTags();
        require_once('view/profile/login.php');
    }
    public function logout() {
        // build sidebar, available tags, list of all add
        // display index
        $available_courses = Application::displayAllCourses();
        $available_categories = Application::displayAllCats();
        $available_tags = Application::displayAllTags();
        $sidebar = Application::sidebar();
        $used_tags = Application::displayUsedTags();
        require_once('view/profile/logout.php');
    }
    public function show() {
        // build sidebar, available tags, list of all add
        // display index
        $available_courses = Application::displayAllCourses();
        $available_categories = Application::displayAllCats();
        $available_tags = Application::displayAllTags();
        $sidebar = Application::sidebar();
        $used_tags = Application::displayUsedTags();
        $users = Profile::find($_GET['user']);
        $codes = Profile::displayAllCodes($_GET['user']);
        $definitions = Profile::displayAllDefinitions($_GET['user']);
        require_once('view/profile/show.php');
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

