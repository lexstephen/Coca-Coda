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
            <div class="col-xs-3 cols-sm-3 col-md-3 col-lg-3">
                <?php require_once 'view/sidebar.php'; ?>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <?php require_once 'routes.php'; ?>
            </div>
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

    </script>
</body>
</html>