<?php

  $classes = array(
    'status' => 'success',
    'error' => 'error',
    'warning' => '',
  );

// dsm($messages);
?>

<?php foreach ($messages as $type => $msgs): ?>
  <div class="alert alert-<?php echo $classes[$type] ?>">
    <button class="close" data-dismiss="alert"></button>
    <?php $heading = '<b>' . ucfirst($type) . ' : ' . '</b> '; ?>
    <?php if (count($msgs) > 1): ?>
      <ul>
        <?php foreach ($msgs as $message): ?>
          <li><?php $heading . $message ?></li>
        <?php endforeach ?>
      </ul>
    <?php else: ?>
      <?php echo $heading . $msgs[0]; ?>
    <?php endif; ?>
  </div>
<?php endforeach ?>
