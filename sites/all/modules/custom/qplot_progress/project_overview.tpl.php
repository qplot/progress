<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

 dsm($project);
 dsm($items);
?>

 <div class="row tiles-container tiles white spacing-bottom">
  <div class="tile-more-content col-md-4 col-sm-4 no-padding">
    <div class="tiles green">
      <div class="tiles-body">
        <div class="heading">
          <?php echo $project['title'] ?>
        </div>
        <p>
          Status : <?php echo $project['status'] ?>
        </p>
      </div>
      <div class="tile-footer">
        Migrate and redesign stemcell journal site.
      </div>
    </div>
    <div class="tiles-body">
      <ul class="progress-list">
        <?php foreach ($items as $phase): ?>
          <?php 
            $bar = 'success';
            if ($phase['progress'] < 60) $bar = 'failure';
            if ($phase['progress'] < 40) $bar = 'danger';
          ?>
          <li>
            <div class="details-wrapper">
              <div class="name">
                <?php echo $phase['title'] ?>
              </div>
              <div class="description">
                description, need to fix
              </div>
            </div>
            <div class="details-status pull-right">
              <span class="animate-number" data-value="<?php echo $phase['progress'] ?>" data-animation-duration="800"><?php echo $phase['progress'] ?></span>%
            </div>
            <div class="clearfix"></div>
            <div class="progress progress-small no-radius">
              <div class="progress-bar progress-bar-<?=$bar ?> animate-progress-bar" data-percentage="<?php echo $phase['progress'] ?>%"></div>
            </div>
          </li>
        <?php endforeach ?>        
      </ul>
    </div>
  </div>
  <div class="tiles white col-md-8 col-sm-8 no-padding">
    <div class="tiles-chart">
      <div class="controller">
        <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
      </div>
      <div class="tiles-body">
        <div class="tiles-title">
          <?php echo $project['company'] ?>
        </div>
        <div class="heading">
          <!-- 8,545,654 <i class="fa fa-map-marker"></i> -->
        </div>
      </div>
      <div class="">
        <img src="<?php echo $project['photo']; ?>" width="100%" height="auto">
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
