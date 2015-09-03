<?php
    class DisplayController {

          //
          // CONTENTS: functions for
          // categories, error, 
          // index, search, show, tags
          // 

        public function categories() {
            $sidebar = Application::sidebar();
            $available_categories = Application::displayAllCatNames();
            if (!isset($_GET['category']))
                $category = 'all';
            else
                $category = $_GET['category'];
            
            if(in_array($category, $available_categories)) {
                $codes = Display::categories($category);
                require_once('view/display/categories.php');
            }
            elseif ($category == "all") {
                $codes = Display::all();
                require_once('view/display/categories.php');
            }
            else 
                return call('codes', 'error');
        }

        public function error() {
            // build sidebar, available tags, list of all codes
            // display error
            require_once('view/codes/error.php');
        }

        public function search() {
          // we expect a url of form ?controller=codes&action=show&id=x
          // without an id we just redirect to the error page as we need the code id to find it in the database
          if (!isset($_GET['term']))
            return call('codes', 'error');

          $codes = Display::search($_GET['term']);
          require_once('view/display/search.php');
        }

        public function tags() {
            $used_tag_names = Application::displayUsedTagNames();
            $codes = Display::all();
            if (!isset($_GET['tag']))
                return call('codes', 'error');
            if(in_array($_GET['tag'], $used_tag_names)) {
                $codes = Display::tags($_GET['tag']);
                require_once('view/display/tags.php');
            } 
            elseif ($_GET['tag'] == "all") {
                $codes = Display::all();
                require_once('view/display/tags.php');
            }
            else {
                return call('codes', 'error');
            }
        }
    }
?>

