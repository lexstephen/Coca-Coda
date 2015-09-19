<?php


function call($controller, $action) {
    // require the file that matches the controller name
    require_once('controller/' . $controller . '_controller.php');


    // create a new instance of the needed controller
    switch($controller) {
      case 'add':
        // we need the model to query the database later in the controller
        require_once('model/Add.php');
        $controller = new AddController();
      break;
        require_once('model/Code.php');
        $controller = new CodesController();
      break;
      case 'definitions':
        require_once('model/Definition.php');
        $controller = new DefinitionsController();
      break;
      case 'display':
        require_once('model/Display.php');
        $controller = new DisplayController();
      break;
      case 'profile':
        require_once('model/Profile.php');
        $controller = new ProfileController();
      break;
    }

    // call the method in Controller specified by the action
    $controller->$action();
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values
  $controllers = array(
      'add'         =>  ['code', 'definition', 'error'],
      'codes'       =>  ['categories', 'codepreview', 'error', 'index', 'show', 'tags', 'edit'],
      'definitions' =>  ['categories', 'error', 'index', 'show', 'tags'],
      'display'     =>  ['categories', 'error', 'search', 'tags'],
      'profile'     =>  ['register', 'login', 'logout', 'show']
    );


  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
      if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
      } else {
        call('display', 'error');
      }
  } else {
      call('display', 'error');
  }
  ?>
