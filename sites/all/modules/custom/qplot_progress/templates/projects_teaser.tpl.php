<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');
  // dsm($items);
?>

<div class="side-bar-widgets">
  <p class="menu-title">
    FAVORATES
  </p>
  <?php foreach($items as $project): ?>
    <?php $bar = ($project['status'] == 'Active') ? 'success' : 'failure'; ?>
    <div class="status-widget">
      <div class="status-widget-wrapper">
        <span class="pull-right"><i class="fa fa-<?=$project['icon'] ?>"></i></span>
        <div class="title">
          <a href="<?=$project['view'] ?>"><?=$project['title'] ?></a>
        </div>
        <?=$project['description']  ?>
        <div class="progress transparent progress-small no-radius no-margin">
          <div data-percentage="<?=$project['progress'] ?>%" class="progress-bar progress-bar-<?=$bar ?> animate-progress-bar"></div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>  
</div>