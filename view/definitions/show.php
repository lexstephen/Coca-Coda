<?php require_once 'header.php'; ?>

        <div class="page-header">
            <h3><?php 
                $courses = $definition->displayCourses($definition->id);
                $courseList = '';
                foreach ($courses as $course) {
                    $courseList .= '<a class="btn btn-info course" href="?controller=codes&action=course&course=' . $course .'">'
                            . $course 
                            . '</a> ';
                }
                echo $courseList;
                
                
                
                $cats = $definition->displayCats($definition->id);
                $catList = '';
                foreach ($cats as $cat) {
                    $catList .= '<a class="btn btn-info" href="?controller=definitions&action=categories&category=' . $cat .'">'
                            . $cat 
                            . '</a> ';
                }
                echo $catList;
                
                echo $definition->term; ?></h3>
            <p><?php echo $definition->definition; ?>
            <small>
                <?php
                
                
                $tags = $definition->displayTags($definition->id);
                $tagList = '';
                foreach ($tags as $tag) {
                    $tagList .= '<a href="?controller=definitions&action=tags&tag=' . $tag .'">'
                            . $tag 
                            . '</a>, ';
                }
                $tagList = rtrim($tagList, ', ');
                echo '<br>tagged under: ' . $tagList;
                
                ?></p>
            <p>
                added by 
                <?php $users = $definition->displayUser($definition->id);
                $userList = '';
                foreach ($users as $user) {
                    $userList .= '<a href="?controller=users&action=show&user=' . $user .'">'
                            . $user 
                            . '</a> ';
                }
                echo $userList; ?>
            </p>
            </small>
        </div>

<?php require_once 'footer.php'; ?>