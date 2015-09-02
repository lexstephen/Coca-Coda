<?php
    class CodesController {

          //
          // CONTENTS: functions for
          // categories, codepreview, error, 
          // index, search, show, tags
          // 

        public function categories() {
            $sidebar = Application::sidebar();
            $used_tags = Application::displayUsedTags();
            $available_categories = Application::displayAllCatNames();
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


        public function codepreview() {
          // we expect a url of form ?controller=codes&action=codepreview&id=x
          // without an id we just redirect to the error page as we need the code id to find it in the database
          if (!isset($_GET['id']))
            return call('codes', 'error');

          // we use the given id to get the right code
          $code = Code::find($_GET['id']);
          require_once('view/codes/codepreview.php');
        }


        public function error() {
            // build sidebar, available tags, list of all codes
            // display error
            $sidebar = Application::sidebar();
            $used_tags = Application::displayUsedTags();
            $codes = Code::all();
            require_once('view/codes/error.php');
        }

        public function index() {
            // build sidebar, available tags, list of all codes
            // display index
            $sidebar = Application::sidebar();
            $used_tags = Application::displayUsedTags();
            $codes = Code::all();
            require_once('view/codes/index.php');
        }

        public function search() {
          // we expect a url of form ?controller=codes&action=show&id=x
          // without an id we just redirect to the error page as we need the code id to find it in the database
          if (!isset($_GET['term']))
            return call('codes', 'error');

          $sidebar = Application::sidebar();
          $used_tags = Application::displayUsedTags();
          $codes = Code::search($_GET['term']);
          require_once('view/codes/search.php');
        }

        public function show() {
            // build sidebar, available tags, available code IDs, list of all codes
            // display error if id= not assigned or not in available code IDs
            $sidebar = Application::sidebar();
            $used_tags = Application::displayUsedTags();
            $available_codes = Application::displayAllCodes();
            $codes = Code::all();
            if((isset($_GET['id'])) && in_array($_GET['id'], $available_codes)) {
                // use the given id to get the right code
                $code = Code::find($_GET['id']);
                require_once('view/codes/show.php');
            } else
                return call('codes', 'error');
        }

        public function tags() {
            $sidebar = Application::sidebar();
            $used_tag_names = Application::displayUsedTagNames();
            $codes = Code::all();
            if (!isset($_GET['tag']))
                return call('codes', 'error');
            if(in_array($_GET['tag'], $used_tag_names)) {
                $codes = Code::tags($_GET['tag']);
                require_once('view/codes/tags.php');
            } 
            elseif ($_GET['tag'] == "all") {
                $codes = Code::all();
                require_once('view/codes/tags.php');
            }
            else {
                return call('codes', 'error');
            }
        }
    }
?>

