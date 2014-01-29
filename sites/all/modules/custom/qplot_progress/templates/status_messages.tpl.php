<?php

  $classes = array(
    'status' => 'success',
    'error' => 'error',
    'warning' => '',
  );

  // var_dump($messages);
?>

<?php foreach ($messages as $type => $msgs): ?>
  <div class="alert alert-<?php echo $classes[$type] ?>">
    <button class="close" data-dismiss="alert"></button>
    <?php if (count($msgs) > 1): ?>
      <ul>
        <?php foreach ($msgs as $message): ?>
          <li><?php echo $message ?></li>
        <?php endforeach ?>
      </ul>
    <?php else: ?>
      <?php echo $msgs[0]; ?>
    <?php endif; ?>
  </div>
<?php endforeach ?>
