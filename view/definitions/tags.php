<?php require_once 'header.php'; ?>
<div class="page-header">
    <h3 class="text-center">Posts tagged <b><?php echo strtoupper($_GET['tag']); ?></b></h3>
</div>
<div class="row">
<?php 
/*
 * create a box for each code that matches the criteria (tag)
 * inside the box, a link to category pages for any matching categories
 * then the title of the code
*/
foreach($codes as $code) { ?>
<div class="col-xs-12 col-md-3">
    <div class="thumbnail">
      <div class="caption">
        <?php 
            $cats = $code['theCode']->displayCats($code['theCode']->id);
            $catList = '';
            foreach ($cats as $cat) {
                $catList .= '<a class="btn btn-info btn-xs" href="?controller=codes&action=categories&category=' . $cat .'">'
                        . $cat 
                        . '</a> ';
            }
            echo $catList;
            
        ?>
      <h3>
          <a href='?controller=codes&action=show&id=<?php echo $code['theCode']->id; ?>'>
              <?php echo $code['theCode']->title; ?> <abbr class="pull-right" title="<?php echo $code['theCode']->description; ?>"><small><span class="caret"></span></small></abbr>
          </a>
          <h6><?php 
            $tags = $code['theCode']->displaytags($code['theCode']->id);
            $tagList = '';
            foreach ($tags as $tag) {
                $tagList .= '<a href="?controller=codes&action=tags&tag=' . $tag .'">'
                        . $tag 
                        . '</a>, ';
            }
            
                $tagList = rtrim($tagList, ', ');
            echo $tagList;
            ?></h6>  
      </h3>
      </div>
    </div>
</div>
<?php } ?>
</div>
<?php require_once 'footer.php'; ?>