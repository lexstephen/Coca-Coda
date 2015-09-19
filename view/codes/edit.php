<?php require_once 'header.php';
if ($loggedIn) {
  if (isset($_POST['author']))
  {
      
      Code::editCode($code->id);
  }
      
      ?><?php print_r($_POST); ?>
<div class="row">
         <div class="page-header">
            <h3>Add Code</h3>
        </div>
        <form action="index.php?controller=codes&action=edit&id=<?php echo $code->id; ?>" method="post">
                        
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="addAuthor">Author</label>
                        <input type="text" name="author" class="form-control" id="addAuthor" value="<?php echo $code->author; ?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="addTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="addTitle" value="<?php echo $code->title; ?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="addDescription">Description</label>
                        <input type="text" name="description" class="form-control" id="addDescription" value="<?php echo $code->description; ?>">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="addImage">Image</label>
                        <input type="file" name="image" id="addImage" value="<?php echo $code->image; ?>">
                        <p class="help-block">Image should be a square</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>Existing Courses</label>
                        <select multiple class="form-control" id="addCourse" name="courses[]">
                        <?php
                            foreach ($available_courses as $a_course) 
                                $checked = (in_array($a_course[0], $code->codeCourses))?'selected':'';
                                echo "<option value=".$a_course[0]." ".$checked.">".$a_course[0].' - '.$a_course[1]."</option>";
                        ?>
                        </select>
                        <p class="help-block">CTRL+Click to select more than one</p>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="addNewCourse">Add new courses?</label>

                        <div class="form-group">
                            <label class="radio-inline"><input type="radio" name="newCourses" id="courseRadio000" value="0" checked> 0</label>
                            <label class="radio-inline"><input type="radio" name="newCourses" id="courseRadio00" value="1"> 1</label>
                            <label class="radio-inline"><input type="radio" name="newCourses" id="courseRadio01" value="2"> 2</label>
                            <label class="radio-inline"><input type="radio" name="newCourses" id="courseRadio02" value="3"> 3</label>
                            <label class="radio-inline"><input type="radio" name="newCourses" id="courseRadio03" value="4"> 4</label>
                            <label class="radio-inline"><input type="radio" name="newCourses" id="courseRadio04" value="5"> 5</label>
                        </div>
                        
                        <!-- hidden Course inputs -->
                        <div class="courseTable">
                        <table class="table table-condensed">
                            <caption>
                                <span class="help-block pull-right">CTRL+Click to assign course to more than one category</span>
                            </caption>
                            <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Categories</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="newCourse00 courseBox">
                                <td><input type="text" name="newCourseCode[]" class="form-control" id="addNewCourse00" placeholder="Course Code"> </td>
                                <td><input type="text" name="newCourseName[]" class="form-control" id="addNewCourse00" placeholder="Course Name"> </td>
                                <td><select multiple class="form-control" id="addCat" name="newCourseCategories[]">
                            <?php
                                foreach ($available_categories as $a_category) 
                                    echo "<option value=".$a_category[0].">".$a_category[1]."</option>";
                            ?>
                                    </select></td>
                            </tr>
                            <tr class="newCourse01 courseBox">
                                <td><input type="text" name="newCourseCode[]" class="form-control" id="addNewCourse01" placeholder="Course Code"> </td>
                                <td><input type="text" name="newCourseName[]" class="form-control" id="addNewCourse01" placeholder="Course Name"> </td>
                                <td><select multiple class="form-control" id="addCat" name="newCourseCategories[]">
                            <?php
                                foreach ($available_categories as $a_category) 
                                    echo "<option value=".$a_category[0].">".$a_category[1]."</option>";
                            ?>
                                    </select></td>
                            </tr>
                            <tr class="newCourse02 courseBox">
                                <td><input type="text" name="newCourseCode[]" class="form-control" id="addNewCourse02" placeholder="Course Code"> </td>
                                <td><input type="text" name="newCourseName[]" class="form-control" id="addNewCourse02" placeholder="Course Name"> </td>
                                <td><select multiple class="form-control" id="addCat" name="newCourseCategories[]">
                            <?php
                                foreach ($available_categories as $a_category) 
                                    echo "<option value=".$a_category[0].">".$a_category[1]."</option>";
                            ?>
                                    </select></td>
                            </tr>
                            <tr class="newCourse03 courseBox">
                                <td><input type="text" name="newCourseCode[]" class="form-control" id="addNewCourse03" placeholder="Course Code"> </td>
                                <td><input type="text" name="newCourseName[]" class="form-control" id="addNewCourse03" placeholder="Course Name"> </td>
                                <td><select multiple class="form-control" id="addCat" name="newCourseCategories[]">
                            <?php
                                foreach ($available_categories as $a_category) 
                                    echo "<option value=".$a_category[0].">".$a_category[1]."</option>";
                            ?>
                                    </select></td>
                            </tr>
                            <tr class="newCourse04 courseBox">
                                <td><input type="text" name="newCourseCode[]" class="form-control" id="addNewCourse04" placeholder="Course Code"> </td>
                                <td><input type="text" name="newCourseName[]" class="form-control" id="addNewCourse04" placeholder="Course Name"> </td>
                                <td><select multiple class="form-control" id="addCat" name="newCourseCategories[]">
                            <?php
                                foreach ($available_categories as $a_category) 
                                    echo "<option value=".$a_category[0].">".$a_category[1]."</option>";
                            ?>
                                    </select></td>
                            </tr>
                            </tbody>
                        </table>
                                
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label>Existing Categories</label>
                        <select multiple class="form-control" id="addCat" name="categories[]">
                        <?php
                            foreach ($available_categories as $a_category) 
                                echo "<option value=".$a_category[0].">".$a_category[1]."</option>";
                        ?>
                        </select>
                        <p class="help-block">CTRL+Click to select more than one</p>
                    </div>
                    <div class="form-group">
                        <label for="addNewCategory">Add new categories?</label>
                        <div class="form-group">
                            <label class="radio-inline"><input type="radio" name="newCategories" id="categoryRadio000" value="0" checked> 0</label>
                            <label class="radio-inline"><input type="radio" name="newCategories" id="categoryRadio00" value="1"> 1</label>
                            <label class="radio-inline"><input type="radio" name="newCategories" id="categoryRadio01" value="2"> 2</label>
                            <label class="radio-inline"><input type="radio" name="newCategories" id="categoryRadio02" value="3"> 3</label>
                            <label class="radio-inline"><input type="radio" name="newCategories" id="categoryRadio03" value="4"> 4</label>
                            <label class="radio-inline"><input type="radio" name="newCategories" id="categoryRadio04" value="5"> 5</label>
                        </div>
                        <!-- hidden Category inputs -->
                        <div class="form-group newCategory00 categoryBox"><input type="text" name="newCategory[]" class="form-control" id="addNewCategory00" placeholder="Category Name"></div>
                        <div class="form-group newCategory01 categoryBox"><input type="text" name="newCategory[]" class="form-control" id="addNewCategory01" placeholder="Category Name"></div>
                        <div class="form-group newCategory02 categoryBox"><input type="text" name="newCategory[]" class="form-control" id="addNewCategory02" placeholder="Category Name"></div>
                        <div class="form-group newCategory03 categoryBox"><input type="text" name="newCategory[]" class="form-control" id="addNewCategory03" placeholder="Category Name"></div>
                        <div class="form-group newCategory04 categoryBox"><input type="text" name="newCategory[]" class="form-control" id="addNewCategory04" placeholder="Category Name"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="form-group">
                        <label for="addTags">Existing Tags</label>
                        <select multiple class="form-control" id="addCat" name="tags[]">
                        <?php
                            foreach ($available_tags as $a_tag) 
                                echo "<option value=".$a_tag[0].">".$a_tag[1]."</option>";
                        ?>
                        </select>
                        <p class="help-block">CTRL+Click to select more than one</p>
                    </div>
                    <div class="form-group">
                        <label for="addNewTag">Add new tags?</label>
                        <div class="form-group">
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio000" value="0" checked> 0</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio00" value="1"> 1</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio01" value="2"> 2</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio02" value="3"> 3</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio03" value="4"> 4</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio04" value="5"> 5</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio05" value="6"> 6</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio06" value="7"> 7</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio07" value="8"> 8</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio08" value="9"> 9</label>
                            <label class="radio-inline"><input type="radio" name="newTags" id="tagRadio09" value="10"> 10</label>
                        </div>
                    </div>
                    <!-- hidden Tag inputs -->
                    <div class="form-group newTag00 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag00" placeholder="Tag Name"></div>
                    <div class="form-group newTag01 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag01" placeholder="Tag Name"></div>
                    <div class="form-group newTag02 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag02" placeholder="Tag Name"></div>
                    <div class="form-group newTag03 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag03" placeholder="Tag Name"></div>
                    <div class="form-group newTag04 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag04" placeholder="Tag Name"></div>
                    <div class="form-group newTag05 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag05" placeholder="Tag Name"></div>
                    <div class="form-group newTag06 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag06" placeholder="Tag Name"></div>
                    <div class="form-group newTag07 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag07" placeholder="Tag Name"></div>
                    <div class="form-group newTag08 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag08" placeholder="Tag Name"></div>
                    <div class="form-group newTag09 tagBox"><input type="text" name="newTag[]" class="form-control" id="addNewTag09" placeholder="Tag Name"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                    <label>Number of files in this Code: </label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio00" value="1"> 1</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio01" value="2"> 2</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio02" value="3"> 3</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio03" value="4"> 4</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio04" value="5"> 5</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio05" value="6"> 6</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio06" value="7"> 7</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio07" value="8"> 8</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio08" value="9"> 9</label>
                        <label class="radio-inline"><input type="radio" name="files" id="sourceCodeRadio09" value="10"> 10</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 sourceCode00 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode00Title">Source Code #1 Title</label>
                        <input type="text" name="sourcecode00title" class="form-control" id="addSourceCode00Title" value="<?php echo $code->sourcecodes[0]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode00Title">Source Code #1</label>
                        <textarea name="sourcecode00" class="form-control" id="addSourceCode01" value="<?php echo $code->sourcecode00; ?>"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 sourceCode01 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode01Title">Source Code #2 Title</label>
                        <input type="text" name="sourcecode01title" class="form-control" id="addSourceCode01Title" value="<?php echo $code->sourcecodes[1]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode01Title">Source Code #2</label>
                        <textarea name="sourcecode01" class="form-control" id="addSourceCode01" value="<?php echo $code->sourcecode01; ?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 sourceCode02 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode02Title">Source Code #3 Title</label>
                        <input type="text" name="sourcecode02title" class="form-control" id="addSourceCode02Title" value="<?php echo $code->sourcecodes[2]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode02Title">Source Code #3</label>
                        <textarea name="sourcecode02" class="form-control" id="addSourceCode01" value="<?php echo $code->sourcecode02; ?>"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 sourceCode03 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode03Title">Source Code #4 Title</label>
                        <input type="text" name="sourcecode03title" class="form-control" id="addSourceCode03Title" value="<?php echo $code->sourcecodes[3]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode03Title">Source Code #4</label>
                        <textarea name="sourcecode03" class="form-control" id="addSourceCode01" value="<?php echo $code->sourcecode03; ?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 sourceCode04 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode04Title">Source Code #5 Title</label>
                        <input type="text" name="sourcecode04title" class="form-control" id="addSourceCode04Title" value="<?php echo $code->sourcecodes[4]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode04Title">Source Code #5</label>
                        <textarea name="sourcecode04" class="form-control" id="addSourceCode04" value="<?php echo $code->sourcecode04; ?>"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 sourceCode05 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode05Title">Source Code #6 Title</label>
                        <input type="text" name="sourcecode05title" class="form-control" id="addSourceCode05Title" value="<?php echo $code->sourcecodes[5]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode05Title">Source Code #6</label>
                        <textarea name="sourcecode05" class="form-control" id="addSourceCode05" value="<?php echo $code->sourcecode05; ?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 sourceCode06 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode06Title">Source Code #7 Title</label>
                        <input type="text" name="sourcecode06title" class="form-control" id="addSourceCode06Title" value="<?php echo $code->sourcecodes[6]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode06Title">Source Code #7</label>
                        <textarea name="sourcecode06" class="form-control" id="addSourceCode06" value="<?php echo $code->sourcecode06; ?>"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 sourceCode07 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode07Title">Source Code #8 Title</label>
                        <input type="text" name="sourcecode07title" class="form-control" id="addSourceCode07Title" value="<?php echo $code->sourcecodes[7]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode07Title">Source Code #8</label>
                        <textarea name="sourcecode07" class="form-control" id="addSourceCode07" value="<?php echo $code->sourcecode07; ?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 sourceCode08 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode08Title">Source Code #9 Title</label>
                        <input type="text" name="sourcecode08title" class="form-control" id="addSourceCode08Title" value="<?php echo $code->sourcecodes[8]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode08Title">Source Code #9</label>
                        <textarea name="sourcecode08" class="form-control" id="addSourceCode08" value="<?php echo $code->sourcecode08; ?>"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 sourceCode09 sourceCodeBox">
                    <div class="form-group">
                        <label for="addSourceCode09Title">Source Code #10 Title</label>
                        <input type="text" name="sourcecode09title" class="form-control" id="addSourceCode09Title" value="<?php echo $code->sourcecodes[9]['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="addSourceCode09Title">Source Code #10</label>
                        <textarea name="sourcecode09" class="form-control" id="addSourceCode09" value="<?php echo $code->sourcecode09; ?>"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </div>
        </form>
</div>
<?php } else { ?>

            <div class="row">
                <div class="col-xs-12">
                    <p>Sorry, you must be logged in to edit a code.</p>
                </div>
            </div>
<?php } require_once 'footer.php'; ?>