<?php require_once 'header.php'; ?>
   <div class="page-header">
        <h3 class="text-center">Codes tagged <b><?php echo strtoupper($_GET['category']); ?></b></h3>
    </div>
    <div class="row">
    <?php foreach($codes as $code) { ?>
        <div class="col-xs-12 col-md-3">
            <div class="thumbnail">
              <div class="caption">
                <?php 
                    $cats = $code['theCode']->displayCats($code['theCode']->id);
                    $catList = '';
                    foreach ($cats as $cat) {
                        $catList .= ' <a class="btn btn-info btn-xs" href="?controller=codes&action=categories&category=' . $cat .'">'
                                . $cat 
                                . '</a> ';
                    }
                    echo $catList;
                ?>
                <h3>
                    <a href='?controller=codes&action=show&id=<?php echo $code['theCode']->id; ?>'>
                        <?php echo $code['theCode']->title; ?> <abbr class="pull-right" title="<?php echo $code['theCode']->description; ?>"><small><span class="caret"></span></small></abbr>
                    </a>
                </h3>
              </div>
            </div>
        </div>
    <?php } ?>

    </div>
<?php require_once 'footer.php'; ?>