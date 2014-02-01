<?php 
  $class = 'success';
  if ($progress <= 95) $class = 'success';
  if ($progress <= 50) $class = 'warning';
  if ($progress <= 15) $class = 'info';
?>

<div data-percentage="<?php echo $progress ?>%" class="progress-bar progress-bar-<?php echo $class ?> animate-progress-bar"><?php echo !empty($caption) ? $progress : '' ?></div>
