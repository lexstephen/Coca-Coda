<?php require_once 'header.php'; ?>
   <div class="page-header">
        <h3 class="text-center">Definitions tagged <b><?php echo strtoupper($_GET['category']); ?></b></h3>
    </div>
    <div class="row">
    <?php foreach($definitions as $definition) { ?>
        <div class="col-xs-12 col-md-3">
            <div class="thumbnail">
              <div class="caption">
                <?php 
                    $cats = $definition['theDefinition']->displayCats($definition['theDefinition']->id);
                    $catList = '';
                    foreach ($cats as $cat) {
                        $catList .= ' <a class="btn btn-info btn-xs" href="?controller=definitions&action=categories&category=' . $cat .'">'
                                . $cat 
                                . '</a> ';
                    }
                    echo $catList;
                ?>
                <h3>
                    <a href='?controller=definitions&action=show&id=<?php echo $definition['theDefinition']->id; ?>'>
                        <?php echo $definition['theDefinition']->term; ?> <abbr class="pull-right" title="<?php echo $definition['theDefinition']->definition; ?>"><small><span class="caret"></span></small></abbr>
                    </a>
                </h3>
              </div>
            </div>
        </div>
    <?php } ?>

    </div>
<?php require_once 'footer.php'; ?>