<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

 // dsm($project);
 // dsm($items);
 // dsm($tasks)


?>

 <div class="row tiles-container tiles white spacing-bottom">
  <div class="tile-more-content col-md-4 col-sm-4 no-padding">
    <div class="tiles green">
      <div class="tiles-body">
        <div class="heading">
          <!-- flag -->
          <?php 
            if ($project['flag']):
              // echo $project['flag'];
          ?>
            <a href="" class="pull-right"><i class="fa fa-star-o"></i></a>
          <?php endif; ?>
          <?php echo $project['title'] ?>
        </div>
        <p>
          Status : <?php echo $project['status'] ?>
        </p>

      </div>
      <div class="tile-footer">
        <?php echo $project['description'] ?>
        <?php if ($project['edit']): ?>
        <p>
          <a href="<?php echo $project['edit'] ?>" class="btn btn-mini pull-right"><i class="fa fa-pencil"></i> edit project</a>
          <br />
        </p>
        <?php endif; ?>

      </div>
    </div>
    <div class="tiles-body">
      <?php if (empty($items)): ?>
        <p> No phases and tasks information available. </p>
      <?php endif; ?>

      <ul class="progress-list">
        <?php foreach ($items as $phase): ?>
          <li>
            <div class="details-wrapper">
              <div class="name">
                <?php echo $phase['title'] ?>
              </div>
              <div class="description">
                <?php echo $phase['description'] ?>
              </div>
            </div>
            <div class="details-status pull-right">
              <span class="animate-number" data-value="<?php echo $phase['progress'] ?>" data-animation-duration="800"><?php echo $phase['progress'] ?></span>%
            </div>
            <div class="clearfix"></div>
            <div class="progress progress-small no-radius">
              <?php
                print theme('qplot_progress_progress_widget', array(
                  'progress' => $phase['progress'],
                  'caption' => FALSE,
                ))
              ?>
            </div>
          </li>
        <?php endforeach ?>        
      </ul>
      <?php if ($project['view_company']): ?>
        <p> For more information, visit <a href="<?php echo $project['view_company'] ?>" class="btn btn-mini pull-right"> <i class="fa fa-eye"></i> view company </a> </p>
      <?php endif ?>
    </div>
  </div>
  <div class="tiles white col-md-8 col-sm-8 no-padding">
    <div class="tiles-chart">
      <div class="controller">
        <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
      </div>
      <div class="tiles-body">
        <div class="tiles-title">
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
