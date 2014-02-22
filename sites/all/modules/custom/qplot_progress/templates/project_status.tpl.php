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
          <h4>Development <span class="semi-bold">Status</span></h4>
          <p>Indicator of health of project, including the number of hours per week, and the percentage progress of the current work.</p>
          <br>
          <div class="">
            <div id="project-progress" class="easy-pie-custom" data-percent="<?php echo $project['progress'] ?>"><span class="easy-pie-percent"><?php echo $project['progress'] ?>%</span></div>    
            <div id="project-capacity" class="easy-pie-custom" data-percent="<?php echo $project['capacity'] ?>"><span class="easy-pie-percent"><?php echo $project['capacity'] ?> hrs/w</span></div>    
          </div>
          <div class="clearfix"></div>
        </div>

      </div>
    </div>
  </div>
</div>
