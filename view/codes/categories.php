
<?php require_once 'header.php'; ?>

        <div class="page-header">
            <h3 class="text-center">Posts tagged <b><?php echo strtoupper($_GET['category']); ?></b></h3>
        </div>
  <div class="row">
      
    <?php 
    
      foreach($codes as $code) { ?>
      <div class="col-xs-3">
          <div class="thumbnail">
              
            <div class="caption">
            <h3><a href='?controller=codes&action=show&id=<?php echo $code['theCode']->id; ?>'><?php echo $code['theCode']->title; ?></a></h3>
            </div>
          </div>
      </div>
<?php } ?>

  </div>
<?php require_once 'footer.php'; ?>