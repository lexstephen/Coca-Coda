<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="<?php echo $metaAuthor; ?>">
    <meta name="description" content="<?php echo $metaTitle; ?>">
    <meta name="keywords" content="<?php echo $metaKeywords; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $siteTitle; ?> | <?php echo $metaTitle; ?></title>
    <link rel="stylesheet" href="bower_components/custom_bootstrap/style.css">
    <style type="text/css">
    .sourceCodeBox, .tagBox, .categoryBox, .courseBox {
        display: none;
    }
    </style>
</head>

<body>
    <div id="container-fluid">
        <div class="row">
            <?php require_once 'routes.php'; ?>
        </div>
    </div>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/bootstrap/js/collapse.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            
            // show the course boxes
            if($(this).attr("id")=="courseRadio00"){
                $(".courseBox").not(".newCourse00").hide();
                $(".newCourse00").show();
            }
            if($(this).attr("id")=="courseRadio01"){
                $(".courseBox").not(".newCourse00").hide();
                $(".newCourse00").show();
                $(".newCourse01").show();
            }
            if($(this).attr("id")=="courseRadio02"){
                $(".courseBox").not(".newCourse02").hide();
                $(".newCourse00").show();
                $(".newCourse01").show();
                $(".newCourse02").show();
            }
            if($(this).attr("id")=="courseRadio03"){
                $(".courseBox").not(".newCourse03").hide();
                $(".newCourse00").show();
                $(".newCourse01").show();
                $(".newCourse02").show();
                $(".newCourse03").show();
            }
            if($(this).attr("id")=="courseRadio04"){
                $(".courseBox").not(".newCourse04").hide();
                $(".newCourse00").show();
                $(".newCourse01").show();
                $(".newCourse02").show();
                $(".newCourse03").show();
                $(".newCourse04").show();
            }
            // show the category boxes
            if($(this).attr("id")=="categoryRadio00"){
                $(".categoryBox").not(".newCategory00").hide();
                $(".newCategory00").show();
            }
            if($(this).attr("id")=="categoryRadio01"){
                $(".categoryBox").not(".newCategory00").hide();
                $(".newCategory00").show();
                $(".newCategory01").show();
            }
            if($(this).attr("id")=="categoryRadio02"){
                $(".categoryBox").not(".newCategory02").hide();
                $(".newCategory00").show();
                $(".newCategory01").show();
                $(".newCategory02").show();
            }
            if($(this).attr("id")=="categoryRadio03"){
                $(".categoryBox").not(".newCategory03").hide();
                $(".newCategory00").show();
                $(".newCategory01").show();
                $(".newCategory02").show();
                $(".newCategory03").show();
            }
            if($(this).attr("id")=="categoryRadio04"){
                $(".categoryBox").not(".newCategory04").hide();
                $(".newCategory00").show();
                $(".newCategory01").show();
                $(".newCategory02").show();
                $(".newCategory03").show();
                $(".newCategory04").show();
            }
            // show the tag boxes
            if($(this).attr("id")=="tagRadio00"){
                $(".tagBox").not(".newTag00").hide();
                $(".newTag00").show();
            }
            if($(this).attr("id")=="tagRadio01"){
                $(".tagBox").not(".newTag01").hide();
                $(".newTag00").show();
                $(".newTag01").show();
            }
            if($(this).attr("id")=="tagRadio02"){
                $(".tagBox").not(".newTag02").hide();
                $(".newTag00").show();
                $(".newTag01").show();
                $(".newTag02").show();
            }
            if($(this).attr("id")=="tagRadio03"){
                $(".tagBox").not(".newTag03").hide();
                $(".newTag00").show();
                $(".newTag01").show();
                $(".newTag02").show();
                $(".newTag03").show();
            }
            if($(this).attr("id")=="tagRadio04"){
                $(".tagBox").not(".newTag04").hide();
                $(".newTag00").show();
                $(".newTag01").show();
                $(".newTag02").show();
                $(".newTag03").show();
                $(".newTag04").show();
            }
            if($(this).attr("id")=="tagRadio05"){
                $(".tagBox").not(".newTag05").hide();
                $(".newTag00").show();
                $(".newTag01").show();
                $(".newTag02").show();
                $(".newTag03").show();
                $(".newTag04").show();
                $(".newTag05").show();
            }
            if($(this).attr("id")=="tagRadio06"){
                $(".tagBox").not(".newTag06").hide();
                $(".newTag00").show();
                $(".newTag01").show();
                $(".newTag02").show();
                $(".newTag03").show();
                $(".newTag04").show();
                $(".newTag05").show();
                $(".newTag06").show();
            }
            if($(this).attr("id")=="tagRadio07"){
                $(".tagBox").not(".newTag07").hide();
                $(".newTag00").show();
                $(".newTag01").show();
                $(".newTag02").show();
                $(".newTag03").show();
                $(".newTag04").show();
                $(".newTag05").show();
                $(".newTag06").show();
                $(".newTag07").show();
            }
            if($(this).attr("id")=="tagRadio08"){
                $(".tagBox").not(".newTag08").hide();
                $(".newTag00").show();
                $(".newTag01").show();
                $(".newTag02").show();
                $(".newTag03").show();
                $(".newTag04").show();
                $(".newTag05").show();
                $(".newTag06").show();
                $(".newTag07").show();
                $(".newTag08").show();
            }
            if($(this).attr("id")=="tagRadio09"){
                $(".tagBox").not(".newTag09").hide();
                $(".newTag00").show();
                $(".newTag01").show();
                $(".newTag02").show();
                $(".newTag03").show();
                $(".newTag04").show();
                $(".newTag05").show();
                $(".newTag06").show();
                $(".newTag07").show();
                $(".newTag08").show();
                $(".newTag09").show();
            }
            
            
            // show the source code boxes
            if($(this).attr("id")=="sourceCodeRadio00"){
                $(".sourceCodeBox").not(".sourceCode00").hide();
                $(".sourceCode00").show();
            }
            if($(this).attr("id")=="sourceCodeRadio01"){
                $(".sourceCodeBox").not(".sourceCode01").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
            }
            if($(this).attr("id")=="sourceCodeRadio02"){
                $(".sourceCodeBox").not(".sourceCode02").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
            }
            if($(this).attr("id")=="sourceCodeRadio03"){
                $(".box").not(".sourceCode03").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
                $(".sourceCode03").show();
            }
            if($(this).attr("id")=="sourceCodeRadio04"){
                $(".sourceCodeBox").not(".sourceCode04").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
                $(".sourceCode03").show();
                $(".sourceCode04").show();
            }
            if($(this).attr("id")=="sourceCodeRadio05"){
                $(".sourceCodeBox").not(".sourceCode05").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
                $(".sourceCode03").show();
                $(".sourceCode04").show();
                $(".sourceCode05").show();
            }
            if($(this).attr("id")=="sourceCodeRadio06"){
                $(".sourceCodeBox").not(".sourceCode06").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
                $(".sourceCode03").show();
                $(".sourceCode04").show();
                $(".sourceCode05").show();
                $(".sourceCode06").show();
            }
            if($(this).attr("id")=="sourceCodeRadio07"){
                $(".box").not(".sourceCode07").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
                $(".sourceCode03").show();
                $(".sourceCode04").show();
                $(".sourceCode05").show();
                $(".sourceCode06").show();
                $(".sourceCode07").show();
            }
            if($(this).attr("id")=="sourceCodeRadio08"){
                $(".sourceCodeBox").not(".sourceCode08").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
                $(".sourceCode03").show();
                $(".sourceCode04").show();
                $(".sourceCode05").show();
                $(".sourceCode06").show();
                $(".sourceCode07").show();
                $(".sourceCode08").show();
            }
            if($(this).attr("id")=="sourceCodeRadio09"){
                $(".sourceCodeBox").not(".sourceCode09").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
                $(".sourceCode03").show();
                $(".sourceCode04").show();
                $(".sourceCode05").show();
                $(".sourceCode06").show();
                $(".sourceCode07").show();
                $(".sourceCode08").show();
                $(".sourceCode09").show();
            }
            if($(this).attr("id")=="sourceCodeRadio10"){
                $(".box").not(".sourceCode10").hide();
                $(".sourceCode00").show();
                $(".sourceCode01").show();
                $(".sourceCode02").show();
                $(".sourceCode03").show();
                $(".sourceCode04").show();
                $(".sourceCode05").show();
                $(".sourceCode06").show();
                $(".sourceCode07").show();
                $(".sourceCode08").show();
                $(".sourceCode09").show();
                $(".sourceCode10").show();
            }
        });
    });
    </script>
</body>
</html>