<div class="cols-sm-12 col-md-2">
    <h1 class="text-center"><a href="index.php">Coda Cola</a></h1>
    

    <div class="panel-group" id="accordion">  
        <div class="panel panel-default">
            <div class="panel-heading">
                 <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSearch">
                        <div class="row">
                            <div class="col-xs-8">Search</div>
                            <div class="col-xs-4"><span class="caret"></span></div>
                        </div>
                    </a>
                 </h4>
            </div>
            <div id="collapseSearch" class="panel-collapse collapse">
                <div class="panel-body">
                    <form action="index.php" role="search" class=""form-inline">
                        <div class="row">
                            <label class="sr-only" for="q">Search site</label>
                            <div class="col-xs-9">
                                <input type="hidden" name="controller" value="codes"> 
                                <input type="hidden" name="action" value="search">
                                <input type="text" class="form-control" name="term" list="tagSearch">
                            </div>
                            <div class="col-xs-3 text-center">
                                <button type="submit" class="btn btn-info">GO</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                 <h4 class="panel-title">
                        <div class="row">
                            <div class="col-xs-8"><a href="index.php?controller=add&action=index">Add</a></div>
                            <div class="col-xs-4">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseAdd">
                                    <span class="caret"></span>
                                </a>
                            </div>
                        </div>
                 </h4>
            </div>
            <div id="collapseAdd" class="panel-collapse collapse">
                <div class="panel-body">
                    <a href="?controller=add&action=code">Add a Code</a><br>
                    <a href="?controller=add&action=definition">Add Definitions </a><br>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                 <h4 class="panel-title">
                        <div class="row">
                            <div class="col-xs-8"><a href="index.php?controller=display&action=tags&tag=all">Tags</a></div>
                            <div class="col-xs-4">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTags">
                                    <span class="caret"></span>
                                </a>
                            </div>
                        </div>
                 </h4>
            </div>
            <div id="collapseTags" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
                    $used_tags = Application::displayUsedTags();
                        foreach ($used_tags as $a_tag) {
                            echo '<a href="?controller=display&action=tags&tag=' . $a_tag[1] .'">'
                                    . $a_tag[1] 
                                    . '</a><br>';
                        }
                   ?>
                </div>
            </div>
        </div>

    <?php
    // sidebar function is in Code.php, variable is set in codes_controller; returns an array of all codes
    //var_dump($sidebar);
   
            $sidebar = Application::sidebar();
    // build a unique array of categories assigned to codes 
    foreach ($sidebar as $a_code) $the_categories[] = $a_code['category'];   
    // strip duplicates
    $the_categories = array_unique($the_categories);
    // loop through each category in our unique array
    foreach ($the_categories as $the_category) {  
        // print the category title
?>
        <div class="panel panel-default">
            <div class="panel-heading">
                 <h4 class="panel-title">
                        <div class="row">
                            <div class="col-xs-8">
                                <!-- link to the category page displaying all matching codes -->
                                <a href="?controller=display&action=categories&category=<?php echo $the_category; ?>">
                                    <?php echo $the_category; ?>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <!-- link to the toggle list of all matching codes -->
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $the_category; ?>">
                                    <span class="caret"></span>
                                </a>
                            </div>
                        </div>
                 </h4>
            </div>

            <div id="collapse<?php echo $the_category; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                <?php
                    // loop through all the codes 
                    foreach ($sidebar as $a_code) {
                    if($a_code['category'] == $the_category) {
                     $short_code_type = ($a_code['type']=='codes')?'c':'d';
                      echo ' <a class="btn btn-info btn-xs code_type" href="?controller='.$a_code['type'].'&action=index" title="'.$a_code['type'].'">'
                                . $short_code_type
                                . '</a> ';
                        //print_r($a_code);
                    // display a link to codes that match the category in question 
                ?>
                    <a href='?controller=<?php echo $a_code['type']; ?>&action=show&id=<?php echo $a_code['code_id']; ?>'><?php echo $a_code['title']; ?></a><br>
                <?php    
                        } // ends if($a_code['category'] == $the_category)
                ?>
                <?php
                        } // ends foreach ($sidebar as $a_code)
                ?>
                </div>
            </div>
        </div>
        <?php
    } // ends foreach ($the_categories as $the_category)
?>
    </div>
</div>

<div class="col-sm-12 col-md-9">
    <br>
    <div class="row">