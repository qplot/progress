<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  // dsm($projects);
?>

<?php foreach ($projects as $project): ?>
    
    <div class="row">
      <div class="col-md-12">
        <div class="grid simple ">
          <div class="grid-title no-border">
            <h4> <i class="fa fa-<?=$project['icon'] ?>"></i><span class="semi-bold"><?php echo $project['title'] ?></span></h4>
            <div class="tools"> 
              <a href="javascript:;" class="collapse"></a>
              <a href="#grid-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a>
            </div>
          </div>
          <div class="grid-body no-border">
            <a href="<?php echo $project['create_phase'] ?>" class="pull-right btn btn-mini"> <i class="fa fa-plus"></i> New Phase</a>
            <h3><?php echo count($project['phases']) ?> <span class="semi-bold">Phases</span></h3>
            <table class="table no-more-tables">
              <thead>
                <tr>
                  <th style="width:1%" >ID</th>
                  <th style="width:9%">Phase</th>                              
                  <th style="width:9%">Deadline</th>
                  <th style="width:9%">Hours</th>
                  <th style="width:10%">Progress</th>
                  <th style="width:10%">Actions</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($project['phases'] as $value): ?>                
                <tr>
                  <td>1</td>
                  <td><a href="<?php echo $value['view'] ?>"><?php echo $value['title'] ?></a></td>
                  <td><?php echo $value['to'] ?></td>
                  <td><?php echo $value['hours'] ?> hrs</td>
                  <td class="v-align-middle">
                    <div class="progress active">
                      <?php
                        print theme('qplot_progress_progress_widget', array(
                          'progress' => $value['progress'],
                          'caption' => TRUE,
                        ))
                      ?>
                    </div>
                  </td>
                  <td>
                    <a href="<?php echo $value['edit'] ?>"><i class="fa fa-edit"></i></a>
                    <a href="<?php echo $value['delete'] ?>"><i class="fa fa-eraser"></i></a>
                  </td>                                
                </tr>
                <?php endforeach ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<?php endforeach ?>

