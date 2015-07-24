<?php foreach($codes as $code) { ?>
  <p>
    <a href='?controller=codes&action=show&id=<?php echo $code->id; ?>'><?php echo $code->title; ?></a>
  </p>
<?php } ?>