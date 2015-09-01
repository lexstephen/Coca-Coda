<?php

function call($controller, $action) {
    // require the file that matches the controller name
    require_once('controller/' . $controller . '_controller.php');

    
    // create a new instance of the needed controller
    switch($controller) {
      case 'codes':
        // we need the model to query the database later in the controller
        require_once('model/Code.php');
        $controller = new CodesController();
      break;
      case 'add':
        // we need the model to query the database later in the controller
        require_once('model/Add.php');
        $controller = new AddController();
      break;
    }

    // call the method in Controller specified by the action
    $controller->$action();
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values

  // we're adding an entry for the new controller and its actions
  $controllers = array('codes' => ['index', 'show', 'search', 'categories', 'tags', 'codepreview', 'error'], 'add' => ['code', 'definition', 'error']);
  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('codes', 'error');
    }
  } else {
    call('codes', 'error');
  }
  ?>