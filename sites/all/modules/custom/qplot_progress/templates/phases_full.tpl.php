<?php
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  // dsm($phases);
?>

<div class="row tiles-container spacing-bottom">
    <div class="tiles-body">
        <div class="controller">
            <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
        </div>
<!--         
        <div class="tiles-title">
            Tasks in Phases
        </div><br>
 -->        
        <?php if ($project['create']): ?>
          <div class="pull-right">
            <a href="<?php echo $project['create'] ?>" class="btn btn-large btn-link"><i class="fa fa-plus"> Add new phase</i></a>
          </div>
        <?php endif; ?>

        <ul class="nav nav-tabs" id="tab-4">          
          <?php foreach ($phases as $key => &$phase): ?>
            <li class="<?php echo $phase['focus'] ? 'active' : '' ?>">
                <a href="#phase-<?php echo $key  ?>"><?php echo $phase['title'] ?></a>
            </li>
          <?php endforeach ?>

        </ul>
        <div class="tab-content">
          <?php foreach ($phases as $key=> &$phase): ?>
            <div class="tab-pane <?php echo $phase['focus'] ? 'active' : '' ?>" id="phase-<?php echo $key ?>">
                <div class="row">
                    <div class="col-md-12">
                      <p class="pull-right">
                        <?php
                          $classes = array(
                            'Proposed' => 'warning',
                            'Approved' => 'important',
                            'Canceled' => 'inverse',
                            'Paid' => '',
                          );
                        ?>
                        <span class="label label-<?php echo $classes[$phase['status']] ?>"><?php echo $phase['status'] ?></span>
                      </p>
                      <h3>
                          Phase: <span class="semi-bold"><?php echo $phase['title'] ?></span>
                          <?php if ($phase['edit']): ?>
                            <a href="<?php echo $phase['edit'] ?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i></a>
                          <?php endif; ?>
                      </h3>
                      <h4>
                      <?php if ($phase['description']): ?>
                        <?php echo $phase['description'] ?>
                      <?php endif; ?>
                      </h4>
                      <hr />

                      <table class="table no-more-tables">
                          <thead>
                            <tr>
                              <td></td>
                              <td>
                                <h4 class="semi-bold no-margin">Progress : </h4>
                              </td>
                              <td></td>
                              <td>
                                <h4 class="semi-bold no-margin"><?php echo $phase['hours'] ?></h4>
                              </td>
                              <td class="v-align-middle">
                                <div class="progress progress-large progress-striped active">
                                  <?php
                                    print theme('qplot_progress_progress_widget', array(
                                      'progress' => $phase['progress'],
                                      'caption' => TRUE,
                                    ))
                                  ?>
                                </div>
                              </td>
                              <td>
                                <?php if ($phase['create']): ?>
                                  <a href="<?php echo $phase['create'] ?>" class="" data-togle="tooltip" title="Add New Task"><i class="fa fa-plus"> New </i></a>
                                <?php endif; ?>
                              </td>
                            </tr>
                          </thead>
                          <thead>
                              <tr>
                                  <th style="width:1%">
                                      ID
                                  </th>
                                  <th style="width:23%">
                                      Task
                                  </th>
                                  <th style="width:9%">
                                      Added
                                  </th>
                                  <th style="width:2%">
                                      Hours
                                  </th>
                                  <th style="width:10%">
                                      Progress
                                  </th>
                                  <th style="width:7%">
                                      Edit
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach($phase['tasks'] as $task): ?>
                              <tr>
                                  <td>
                                    <?php echo $task['ticket'] ?>
                                  </td>
                                  <td class="v-align-middle">
                                      <?php echo $task['title'] ?>
                                  </td>
                                  <td class="v-align-middle">
                                      <span class="muted">
                                        <?php echo $task['added'] ?>
                                      </span>
                                  </td>
                                  <td>
                                      <span class="muted"><?php echo $task['hours'] ?></span>
                                  </td>
                                  <td class="v-align-middle">
                                      <div class="progress">
                                        <?php
                                          print theme('qplot_progress_progress_widget', array(
                                            'progress' => $task['progress'],
                                            'caption' => TRUE,
                                          ))
                                        ?>
                                      </div>
                                  </td>
                                  <td>
                                    <a href="<?php echo $task['edit'] ?>" title="edit"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo $task['delete'] ?>" title="delete"><i class="fa fa-eraser"></i></a>
                                  </td>
                              </tr><?php endforeach;?>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
          <?php endforeach; ?>
        </div>
    </div>
</div>