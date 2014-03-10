<?php 
  $class = 'success';
  if ($progress <= 95) $class = 'success';
  if ($progress <= 80) $class = 'warning';
  if ($progress <= 15) $class = 'danger';
?>

<div data-percentage="<?php echo ($progress < 5) ? 5 : $progress ?>%" class="progress-bar progress-bar-<?php echo $class ?> animate-progress-bar"><?php echo !empty($caption) ? ($progress < 20 ? '' : $progress ) : '' ?></div>
