<?php require_once 'header.php';
  if (isset($_POST['username']))
    {
        Profile::login();
        
    } ?>
<?php require_once 'footer.php'; ?>