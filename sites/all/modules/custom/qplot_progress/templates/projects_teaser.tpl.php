<?php
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');
  // dsm($items);
?>

  <p class="menu-title">
    FAVORATES
  </p>
  <?php foreach($items as $project): ?>
    <?php //$bar = ($project['status'] == 'Active') ? 'success' : 'failure'; ?>
    <div class="status-widget">
      <div class="status-widget-wrapper">
        <span class="pull-right"><i class="fa fa-<?=$project['icon'] ?>"></i></span>
        <div class="title">
          <a href="<?=$project['view'] ?>"><?=$project['title'] ?></a>
        </div>
        <?=$project['description']  ?>
        <div class="progress transparent progress-small no-radius no-margin">
          <?php
            print theme('qplot_progress_progress_widget', array(
              'progress' => $project['progress'],
              'caption' => FALSE,
            ))
          ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
