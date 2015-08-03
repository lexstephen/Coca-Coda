<?php require_once 'header.php'; ?>

        <div class="page-header">
            <h3 class="text-center"><?php echo $code->title; ?></h3>
            <h6 class="text-center">
                <?php
                
                $cats = $code->displayCats($code->id);
                $catList = '';
                foreach ($cats as $cat) {
                    $catList .= '<a class="btn btn-info" href="?controller=codes&action=categories&category=' . $cat .'">'
                            . $cat 
                            . '</a> ';
                }
                echo $catList;
                
                $tags = $code->displayTags($code->id);
                $tagList = '';
                foreach ($tags as $tag) {
                    $tagList .= '<a href="?controller=codes&action=tags&tag=' . $tag .'">'
                            . $tag 
                            . '</a>, ';
                }
                $tagList = rtrim($tagList, ', ');
                echo $tagList;
                
                ?>
            </h6>
        </div>
        
        <div class="col-xs-12">
            <p><?php echo $code->description; ?></p>
        </div>

<?php
    $showMeTheCode = $code->showPreview($code->id);
    if ($showMeTheCode[0] == 1) {
        $colSize = 12;
?>
        <div class="col-xs-12 col-sm-12">
            <div class="thumbnail">
                <div class="caption">
                    <div class="text-center text-primary"><h4>Preview</h4></div>
                    <iframe id="previewArea" src="index.php?controller=codes&action=codepreview&id=<?php echo $code->id; ?>"></iframe>
                </div>
            </div>
        </div>
<?php 
    } else {
        // change the size of the code areas if there are fewer files displayed
        if ($code->files > 1)
            $colSize = 6;
        else 
            $colSize = 12;
    }
    for ($x = 0; $x < $code->files; $x++) {
?>
        <div class="col-xs-12 col-sm-<?php echo $colSize; ?>">
            <div class="thumbnail">
                <div class="caption">
                    <div class="text-center text-primary"><h4><?php echo $code->sourcecodes[$x]['title']; ?></h4></div>
                    <pre class="pre-scrollable"><small><?php echo $code->sourcecodes[$x]['code']; ?></small></pre>
                </div>
            </div>
        </div>
<?php
    }
?> 
<?php require_once 'footer.php'; ?>