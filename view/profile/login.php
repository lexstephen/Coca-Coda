<?php require_once 'header.php';
  if (isset($_POST['username']))
  {
      Profile::login();
  }
      
      ?>
<div class="row">
         <div class="page-header">
            <h3>Login</h3>
        </div>
        <form action="index.php?controller=profile&action=login" method="post">
            
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addUsername">Username</label>
                        <input type="text" name="username" class="form-control" id="addUsername">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addPassword1">Password</label>
                        <input type="password" name="password1" class="form-control" id="addPassword1">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addPassword2">Confirm Password</label>
                        <input type="password" name="password2" class="form-control" id="addPassword2">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4 col-lg-offset-3">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
</div>
<?php require_once 'footer.php'; ?>