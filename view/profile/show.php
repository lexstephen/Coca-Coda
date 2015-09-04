<?php require_once 'header.php'; 

$this_username = $users['username'];
$this_first_name = $users['first_name'];
$this_last_name = $users['last_name'];
$this_image = $users['image'];
$this_website = $users['website'];

$codeList = '<ul>';
foreach ($codes as $code) {
    $codeList .= '<li><a href="?controller=codes&action=code&code=' . $code['id'] .'">'
            . $code['title'] 
            . '</a></li>';
}
$codeList .= '</ul>';

$definitionList = '<ul>';
foreach ($definitions as $definition) {
    $definitionList .= '<li><a href="?controller=definitions&action=definition&definition=' . $definition['id'] .'">'
            . $definition['term'] 
            . '</a></li>';
}
$definitionList .= '</ul>';
                
?>
<div class="page-header">
    <h3>User Profile: <?php echo $this_username; ?>
    <small><?php echo $this_first_name; ?> <?php echo $this_last_name; ?></small>
    </h3>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-6">
        <h4>Codes</h4>
        <?php 
            if($codes) echo$codeList;
            else echo $this_username . ' has not submitted any codes.';
        ?>
    </div>
    <div class="col-xs-12 col-sm-6">
        <h4>Definitions</h4>
        <?php 
            if($definitions) echo $definitionList;
            else echo $this_username . ' has not submitted any definitions.';
        ?>
    </div>
</div>


<?php require_once 'footer.php'; ?>