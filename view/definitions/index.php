<?php require_once 'header.php'; ?>
        <div class="page-header">
            <h3>All Definitions</h3>
        </div>
<div class="row">
    <table class="table table-striped">
        <tr>
            <th>Categories</th>
            <th>Term</th>
            <th>Definition</th>
        </tr>
    <?php 
    /*
     * create a box for each code that matches the criteria (all)
     * inside the box, a link to category pages for any matching categories
     * then the title of the code
    */
    foreach($definitions as $definition) { ?>
    <tr>
              <td><?php 
                  $cats = $definition['theDefinition']->displayCats($definition['theDefinition']->id);
                  $catList = '';
                  foreach ($cats as $cat) {
                      $catList .= '<a class="btn-info btn-xs" href="?controller=display&action=categories&category=' . $cat .'">'
                              . $cat 
                              . '</a> ';
                  }
                  echo $catList;
                  ?></td>
                  <td>
                  <a href='?controller=definitions&action=show&id=<?php echo $definition['theDefinition']->id; ?>'><?php echo $definition['theDefinition']->term; ?></a>
                  </td>
                  <td><?php echo $definition['theDefinition']->definition; ?></td>
    </tr>
    <?php } ?>
    </table>
</div>
<?php require_once 'footer.php'; ?>