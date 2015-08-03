<?php require_once 'header.php'; ?>

        <div class="page-header">
            <h3 class="text-center"><?php echo $code->title; ?></h3>
            <h6 class="text-center">
                <?php
                
                $cats = $code->displayCats($code->id);
                $catList = '';
                foreach ($cats as $cat) {
                    $catList .= '<a class="btn btn-primary" href="?controller=codes&action=categories&category=' . $cat .'">'
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
?>
        <div class="col-xs-12 col-sm-6">
            <div class="thumbnail">
                <div class="caption">
                    <h6 class="text-center">Preview</h6>
                    <iframe id="previewArea" src="index.php?controller=codes&action=codepreview&id=<?php echo $code->id; ?>"></iframe>
                </div>
            </div>
        </div>
<?php 
    }

    for ($x = 0; $x < $code->files; $x++) {
?>
        <div class="col-xs-12 col-sm-6">
            <div class="thumbnail">
                <div class="caption">
                    <h6 class="text-center"><?php echo $code->sourcecodes[$x]['title']; ?></h6>
                    <pre class="pre-scrollable"><small><?php echo $code->sourcecodes[$x]['code']; ?></small></pre>
                </div>
            </div>
        </div>
<?php
    }
?> 
<?php require_once 'footer.php'; ?>