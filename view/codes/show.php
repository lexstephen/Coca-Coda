<div class="col-xs-3 cols-sm-3 col-md-3 col-lg-3">
    <div class="searchHead">Search <span class="caret"></span></div>
    <div>
        <form action="index.php" role="search" class="form-inline">
            <label class="sr-only" for="q">Search site</label>
            <input type="hidden" name="cc" value=""> 
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12">
                        <input type="search" class="form-control input-sm" name="q" list="tagSearch"> 
                        <input type="submit" value="search" class="btn btn-sm input-sm">
                    </div>
                </div>
            </div>
        </form>

        <?php
        // once they hit search, look for query and build a list of results
        if (isset($_GET['q'])) {
            $q = trim($_GET['q']);

            //        $theSearch = new Code();
            //        $searchList = $theSearch->searchTags($q);
        }

        //    $theCats = new Code();
        //    $catList = $theCats->listCats();
        ?>
    </div>

    <!--
    
    WRITE A FUNCTION THAT RETURNS ALL CATEGORIES
    
    for x in categories
        go through all codes and display if its category matches the x
    
    TAGS: 
    instead of extra step checking tag id, put tag name into tagmap column??
    
    -->

    <?php
    // sidebar function is in Code.php
    // variable is set in codes_controller
    // returns an array of all codes
    foreach ($sidebar as $a_code) {
        ?>
        <?php echo $a_code['category'][1]; ?>
        <div class="aCode">
            <a href='?controller=codes&action=show&id=<?php echo $a_code['theCode']->id; ?>'><?php echo $a_code['theCode']->title; ?></a> <span class="caret"></span> <small><?php echo $a_code['theCode']->description; ?></small>
        </div>
    <?php } ?>

</div>
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    <div class="row">
        <div class="col-xs-4 cols-sm-4 col-md-4 col-lg-4 blue">
            <h5>
                <?php
                $cats = $code->displayCats($code->id);
                $catList = '';
                foreach ($cats as $cat) {
                    $catList .= $cat . ', ';
                }
                $catList = rtrim($catList, ', ');
                echo $catList;
                ?>
            </h5>
        </div>
        <div class="col-xs-4 cols-sm-4 col-md-4 col-lg-4">
            <h5><?php echo $code->title; ?></h5>
        </div>
        <div class="col-xs-4 cols-sm-4 col-md-4 col-lg-4 yellow">
            <h5><small>
                    <?php
                    $tags = $code->displayTags($code->id);
                    $tagList = '';
                    foreach ($tags as $tag) {
                        $tagList .= $tag . ', ';
                    }
                    $tagList = rtrim($tagList, ', ');
                    echo $tagList;
                    ?>
                </small></h5>
        </div>
        <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12"><?php echo $code->description; ?></div>
        <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12">&nbsp;</div>

        <?php
        $showMeTheCode = $code->showPreview($code->id);
        if ($showMeTheCode[0] == 1) {
            echo '  <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12">
                         <iframe id="previewArea" src="index.php?controller=codes&action=codepreview&id=' . $code->id . '"></iframe>
                     </div>';
        }
        ?>

        <?php
        for ($x = 0; $x < $code->files; $x++) {
            echo '<div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12">
       <h4>' . $code->sourcecodes[$x]['title'] . '</h4>
   </div>
   <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12">
       <pre class="pre-scrollable">' . $code->sourcecodes[$x]['code'] . '</pre>
   </div>';
        }
        ?> 

    </div>
</div>

