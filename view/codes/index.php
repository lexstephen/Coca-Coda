<?php require_once 'header.php'; ?>
        <div class="page-header">
            <h3>All Codes</h3>
        </div>
<div class="row">
    <?php 
    /*
     * create a box for each code that matches the criteria (all)
     * inside the box, a link to category pages for any matching categories
     * then the title of the code
    */
    foreach($codes as $code) { ?>
    <div class="col-xs-12 col-md-6">
        <div class="thumbnail">
              
            <div class="caption">            
              <?php 
                  $cats = $code['theCode']->displayCats($code['theCode']->id);
                  $catList = '';
                  foreach ($cats as $cat) {
                      $catList .= '<a class="btn-info btn-xs" href="?controller=codes&action=categories&category=' . $cat .'">'
                              . $cat 
                              . '</a> ';
                  }
                  echo $catList;
                  ?>
                  <a href='?controller=codes&action=show&id=<?php echo $code['theCode']->id; ?>'><?php echo $code['theCode']->title; ?> <abbr class="pull-right" title="<?php echo $code['theCode']->description; ?>"><small><span class="caret"></span></small></abbr></a>

            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php require_once 'footer.php'; ?>