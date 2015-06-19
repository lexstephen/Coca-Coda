<p>Here is a list of all codes:</p>

<?php foreach($codes as $code) { ?>
  <p>
    <?php echo $code->title; ?>
    <a href='?controller=codes&action=show&id=<?php echo $code->id; ?>'>See content</a>
  </p>
<?php } ?>