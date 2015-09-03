<?php require_once 'header.php';
  if (isset($_POST['username']))
  {
      Profile::addUser();
  }
      
      ?>
<div class="row">
         <div class="page-header">
            <h3>User Registration</h3>
        </div>
        <form action="index.php?controller=profile&action=register" method="post">
            
            <input type="hidden" name="controller" value="profile">
            <input type="hidden" name="action" value="register">
            <input type="hidden" name="approved" value="0">
            
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addUsername">Username</label>
                        <input type="text" name="username" class="form-control" id="addUsername">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addEmail">Email Address</label>
                        <input type="text" name="email_address" class="form-control" id="addEmail">
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
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addFirstName">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="addFirstName">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addLastName">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="addLastName">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addWebsite">Website URL</label>
                        <input type="text" name="website" class="form-control" id="addWebsite" value="http://">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="addImage">Image</label>
                        <input type="file" name="image" id="addImage">
                        <p class="help-block">Image should be a square</p>
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