
<?php require_once 'header.php'; ?>

  <div class="row">
      
      
      
    <?php foreach($codes as $code) { ?>
      <div class="col-xs-3">
          <div class="thumbnail">
              
            <div class="caption">
         <?php 
                $cats = $code->displayCats($code->id);
                $catList = '';
                foreach ($cats as $cat) {
                    $catList .= ' <b class="badge pull-right">' . $cat . '</b> ';
                }
                echo $catList;
                ?>
            <h3><a href='?controller=codes&action=show&id=<?php echo $code->id; ?>'><?php echo $code->title; ?></a></h3>
            </div>
          </div>
      </div>
<?php } ?>

  </div>
<?php require_once 'footer.php'; ?>