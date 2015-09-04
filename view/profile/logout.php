<?php require_once 'header.php';
  if ($loggedIn)
  {
      Profile::logout();
      ?>

            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <p>You have been logged out.</p>  
                </div>
            </div>
<?php 
  }
  else
  { ?>

            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <p>You were not logged in.</p>  
                </div>
            </div>
<?php  }
      
     
require_once 'footer.php'; ?>