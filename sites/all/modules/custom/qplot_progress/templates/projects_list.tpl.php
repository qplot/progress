<div class="row">
  <div class="grid simple ">
    <div class="grid-title no-border">
      <h4>Projects <span class="semi-bold">Tracked</span></h4>
    </div>
    <div class="grid-body no-border">
      <div>
        <ul class="progress-list" >
          <li>
            <?php foreach ($projects as $project): ?>
              <div class="details-wrapper">
                <div class="name"><?php echo $project['title']?></div>
                <div class="description"><?php echo $project['description']?></div>
              </div>
              <div class="details-status pull-right">
                <span class="animate-number" data-value="<?php echo $project['progress']?>" data-animation-duration="800">0</span>%
              </div>
              <div class="clearfix"></div>
              <div class="progress progress-small no-radius" >
                <?php
                  print theme('qplot_progress_progress_widget', array(
                    'progress' => $project['progress'],
                    'caption' => FALSE,
                  ))
                ?>                
              </div>
            <?php endforeach; ?>
          </li>
        </ul>

        <button class="btn btn-lg btn-success pull-right" data-toggle="modal" data-target="#myModal"> Add your project  </button>
        <div class="clearfix"></div>

      </div>
    </div>
  </div>
</div>