<!DOCTYPE html><html lang="en-US">
<head>
    <meta name="author" content="<?php echo $metaAuthor; ?>">
    <meta name="description" content="<?php echo $metaTitle; ?>">
    <meta name="keywords" content="<?php echo $metaKeywords; ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $siteTitle; ?> | <?php echo $metaTitle; ?></title>
    <link rel="stylesheet" href="bower_components/custom_bootstrap/style.css">
</head>

<body>
    <div id="container">
        <div class="row">
            <?php require_once 'routes.php'; ?>
        </div>
    </div>

    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script>

    $(".searchHead").click(
        function () {
            $(this).next().toggle();
        }
    ).next().show(); 

    $(".sidebarHead").click(
        function () {
            $(this).next().toggle();
        }
    ).next().hide(); 
    
    $(".aCode > .caret").click(
        function () {
            $(this).next().toggle();
        }
    ).next().hide(); 

    </script>
</body>
</html>