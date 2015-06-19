           <div class="row">
              <div class="col-xs-4 cols-sm-4 col-md-4 col-lg-4 blue">
                  <h5>
                        <?php 
                            $cats = $code->displayCats($code->id);
                            $catList = '';
                            foreach ($cats as $cat) {
                                $catList .= $cat . ', ';
                            }
                            $catList = rtrim($catList,', ');
                            echo $catList;
                        ?>
                  </h5>
              </div>
              <div class="col-xs-4 cols-sm-4 col-md-4 col-lg-4">
                  <h5><?php echo  $code->title; ?></h5>
              </div>
              <div class="col-xs-4 cols-sm-4 col-md-4 col-lg-4 yellow">
                  <h5><small>
                        <?php 
                            $tags = $code->displayTags($code->id);
                            $tagList = '';
                            foreach ($tags as $tag) {
                                $tagList .= $tag . ', ';
                            }
                            $tagList = rtrim($tagList,', ');
                            echo $tagList;
                        ?>
                  </small></h5>
              </div>
              <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12"><?php echo $code->description; ?></div>
              <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12">&nbsp;</div>

              <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12">
                  <iframe id="previewArea" src="index.php?controller=codes&action=codepreview&id=<?php echo $code->id; ?>"></iframe>
              </div>
<!--            
        for ($i = 0; $i < $files; $i++) {-->
              <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12">
                  <h4><?php echo $code->sourcecode00title; ?></h4>
              </div>
              <div class="col-xs-12 cols-sm-12 col-md-12 col-lg-12">
                  <pre class="pre-scrollable"><?php echo $code->sourcecode00; ?></pre>
              </div>

        }
            </div>