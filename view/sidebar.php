
      <a href='?controller=posts&action=index'>Posts</a>
          
          <?php
    echo '<div class="searchHead">Search <span class="caret"></span></div>';
echo '<div>
    <form action="index.php" role="search" class="form-inline">
        <label class="sr-only" for="q">Search site</label>
        <input type="hidden" name="cc" value="'.$cc.'"> 
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12">
                    <input type="search" class="form-control input-sm" name="q" list="tagSearch"> 
                    <input type="submit" value="search" class="btn btn-sm input-sm">
                </div>
            </div>
        </div>
    </form>';
            
// once they hit search, look for query and build a list of results
	if(isset($_GET['q'])) {
		$q = trim($_GET['q']);
            
//        $theSearch = new Code();
//        $searchList = $theSearch->searchTags($q);
    }
    echo '</div>';
    
//    $theCats = new Code();
//    $catList = $theCats->listCats();