<div class="cols-sm-12 col-md-3">
    <h1 class="text-center">Coda Cola</h1>
    
    <div class="panel-group" id="accordion">
        
    <div class="panel panel-default">
            <div class="panel-heading">
                 <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSearch">
                                                <div class="row">
                            <div class="col-xs-10">Search</div>
                            <div class="col-xs-2"><span class="caret"></span></div>
                        </div>
                    </a>
                 </h4>
    </div>
            <div id="collapseSearch" class="panel-collapse collapse">
                <div class="panel-body">
        <form action="index.php" role="search" class="form-inline">
            <label class="sr-only" for="q">Search site</label>
            <input type="hidden" name="cc" value=""> 
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-8">
                        <input type="search" class="form-control input-sm" name="q" list="tagSearch"> 
                    </div>
                    <div class="col-xs-4">
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
    </div>
    </div>

    <?php
    // sidebar function is in Code.php, variable is set in codes_controller; returns an array of all codes
    //var_dump($sidebar);
   
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
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $the_category; ?>">
                        <div class="row">
                            <div class="col-xs-10"><?php echo $the_category; ?></div>
                            <div class="col-xs-2"><span class="caret"></span></div>
                        </div>
                    </a>
                 </h4>
            </div>
            
            <div id="collapse<?php echo $the_category; ?>" class="panel-collapse collapse">
                <div class="panel-body">
<?php
        // loop through all the codes 
        foreach ($sidebar as $a_code) {
            if($a_code['category'] == $the_category) {
        // display a link to codes that match the category in question 
?>
                    <a href='?controller=codes&action=show&id=<?php echo $a_code['theCode']->id; ?>'><?php echo $a_code['theCode']->title; ?></a><br>
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
    <div class="row">