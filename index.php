<?php 
    require_once('connection.php');

    $siteTitle = "Code Cuts";
    $siteTitleShort = "CC";
    $useStylesheet = "style/style.css";
    $metaAuthor = "Alexis Dicks-Stephen";
    $metaTitle = "HTML, CSS, JavaScript and PHP Tutorials";
    $metaKeywords = "html, css, javascript, php";

    if (isset($_GET['controller']) && isset($_GET['action'])) {
      $controller = $_GET['controller'];
      $action     = $_GET['action'];
    } else {
      $controller = 'display';
      $action     = 'categories';
    }

    if ($action != 'codepreview')
        require_once('view/layout.php');
    else
        require_once('routes.php');
