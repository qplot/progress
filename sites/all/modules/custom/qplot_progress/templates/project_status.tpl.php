<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

 // dsm($project);


?>

<!-- Project status chart -->
<div class="row spacing-bottom">
  <div class="col-md-12 col-sm-6">
    <div class="tiles white added-margin">
      <div class="tiles-body">
        <div class="controller">
          <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
        </div>
        <div class="tiles-title">
          Project Status
        </div><br>

        <div class="grid-body no-border">
          <?php if ($project['comment']): ?>
            <div class="alert alert-info"><span class="semi-bold">Client Note:</span> <?php echo $project['comment'] ?></div>
          <?php endif ?>
          <h4>Development <span class="semi-bold">Status</span></h4>
          <p>Indicator of health of project, including the number of hours per week, and the percentage progress of the current work.</p>

          <h5>Total hours: <span class="semi-bold"> <?php echo $project['hours'] ?> hours</span></h5>
          <div class="row">
            <div class="col-md-6">
              <p align="center"> Completed </p>
              <div id="project-progress" class="easy-pie-custom" data-percent="<?php echo $project['progress'] ?>"><span class="easy-pie-percent"><?php echo $project['progress'] ?>%</span></div>    
            </div>
            <div class="col-md-6">
              <p align="center"> Capability </p>
              <div id="project-capacity" class="easy-pie-custom" data-percent="<?php echo $project['capacity'] ?>"><span class="easy-pie-percent"><?php echo $project['capacity'] ?> hrs/w</span></div>    
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

      </div>
    </div>
  </div>
</div>
