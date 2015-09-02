<?php
    class DefinitionsController {

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
                return call('definitions', 'error');
            if(in_array($_GET['category'], $available_categories)) {
                $definitions = Definition::categories($_GET['category']);
                require_once('view/definitions/categories.php');
            }
            elseif ($_GET['category'] == "all") {
                $definitions = Definition::all();
                require_once('view/definitions/categories.php');
            }
            else 
                return call('definitions', 'error');
        }


        public function codepreview() {
          // we expect a url of form ?controller=definitions&action=codepreview&id=x
          // without an id we just redirect to the error page as we need the code id to find it in the database
          if (!isset($_GET['id']))
            return call('definitions', 'error');

          // we use the given id to get the right code
          $code = Definition::find($_GET['id']);
          require_once('view/definitions/codepreview.php');
        }


        public function error() {
            // build sidebar, available tags, list of all definitions
            // display error
            $sidebar = Application::sidebar();
            $used_tags = Application::displayUsedTags();
            $definitions = Definition::all();
            require_once('view/definitions/error.php');
        }

        public function index() {
            // build sidebar, available tags, list of all definitions
            // display index
            $sidebar = Application::sidebar();
            $used_tags = Application::displayUsedTags();
            $definitions = Definition::all();
            require_once('view/definitions/index.php');
        }

        public function search() {
          // we expect a url of form ?controller=definitions&action=show&id=x
          // without an id we just redirect to the error page as we need the code id to find it in the database
          if (!isset($_GET['term']))
            return call('definitions', 'error');

          $sidebar = Application::sidebar();
          $used_tags = Application::displayUsedTags();
          $definitions = Definition::search($_GET['term']);
          require_once('view/definitions/search.php');
        }

        public function show() {
            // build sidebar, available tags, available code IDs, list of all definitions
            // display error if id= not assigned or not in available code IDs
            $sidebar = Application::sidebar();
            $used_tags = Application::displayUsedTags();
            $available_definitions = Application::displayAllDefinitions();
            $definitions = Definition::all();
            if((isset($_GET['id'])) && in_array($_GET['id'], $available_definitions)) {
                // use the given id to get the right code
                $definition = Definition::find($_GET['id']);
                require_once('view/definitions/show.php');
            } else
                return call('definitions', 'error');
        }

        public function tags() {
            $sidebar = Application::sidebar();
            $used_tag_names = Application::displayUsedTagNames();
            $definitions = Definition::all();
            if (!isset($_GET['tag']))
                return call('definitions', 'error');
            if(in_array($_GET['tag'], $used_tag_names)) {
                $definitions = Definition::tags($_GET['tag']);
                require_once('view/definitions/tags.php');
            } 
            elseif ($_GET['tag'] == "all") {
                $definitions = Definition::all();
                require_once('view/definitions/tags.php');
            }
            else {
                return call('definitions', 'error');
            }
        }
    }
?>

