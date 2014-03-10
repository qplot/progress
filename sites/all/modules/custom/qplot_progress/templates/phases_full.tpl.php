<?php
  // dsm($phases);
?>

<div class="row tiles-container tiles white spacing-bottom">
    <div class="tiles-body">
        <div class="controller">
            <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
        </div>        
        <div class="tiles-title">
            Tasks in Phases
        </div>
        <div class="row phases-tab">
          <div class="col-md-10">
            <?php if (count($phases) == 0): ?>
              <p> There are currently no phases for this project. </p>
            <?php endif; ?>
            <ul class="nav nav-pills" id="tab-4">          
              <?php foreach ($phases as $key => &$phase): ?>
                <li class="<?php echo $phase['focus'] ? 'active' : '' ?>">
                    <a href="#phase-<?php echo $key  ?>"><?php echo $phase['title'] ?></a>
                </li>
              <?php endforeach ?>
            </ul>
          </div>
          <div class="col-md-2">
            <?php if ($project['create_phase']): ?>
              <div class="pull-right">
                <a href="<?php echo $project['create_phase'] ?>" class="btn btn-success btn-mini tip" data-toggle="tooltip" data-placement="right" title="New Phase"><i class="fa fa-plus"></i> </a>
              </div>
            <?php endif ?>
          </div>
        </div>
        <div class="tab-content">
          <?php foreach ($phases as $key=> &$phase): ?>
            <div class="tab-pane <?php echo $phase['focus'] ? 'active' : '' ?>" id="phase-<?php echo $key ?>">
                <div class="row">
                  <div class="grid">
                    <div class="grid-body no-border">

                      <p>
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
                      <p class="pull-right">
                        <?php if ($phase['create_task']): ?>
                          <a href="<?php echo $phase['create_task'] ?>" class="btn btn-success" data-togle="tooltip" title="Add New Task"><i class="fa fa-plus"></i>  Task</a>
                        <?php endif; ?>

                      </p>
                      <h3>
                        <?php echo $project['title'] ?>: <span class="semi-bold"><?php echo $phase['title'] ?></span>
                        <?php if ($phase['delete']): ?>
                          <a href="<?php echo $phase['delete'] ?>" class="btn btn-mini tip" data-toggle="tooltip" data-placement="top" title="Delete phase"><i class="fa fa-eraser"></i> delete </a>                        
                        <?php endif ?>
                        <?php if ($phase['edit']): ?>
                          <a href="<?php echo $phase['edit'] ?>" class="btn btn-mini tip" data-toggle="tooltip" data-placement="top" title="Edit phase"><i class="fa fa-pencil"></i> edit </a>
                        <?php endif; ?>
                      </h3>
                      <p class="pull-right">
                      </p>

                      <h5>
                        <?php if (!empty($phase['from'])): ?>
                          <?php echo $phase['from'] . ' - ' . $phase['to'];  ?>
                        <?php endif; ?>
                      </h5>
                      <p>
                        <?php if ($phase['description']): ?>
                          <?php echo $phase['description'] ?>
                        <?php endif; ?>
                      </p>

                      <table class="table no-more-tables">
                          <thead>
                            <tr>
                              <td colspan="3">
                                <h5 class="semi-bold no-margin">Progress : 
                                  <?php echo $phase['hours'] ?>hrs (total), 
                                  <?php echo round((1 - $phase['progress']/100) * $phase['hours']) ?>hrs (left)
                                </h5>
                              </td>
                              <td colspan="2" class="v-align-middle">
                                <div class="progress progress-large active">
                                  <?php
                                    print theme('qplot_progress_progress_widget', array(
                                      'progress' => $phase['progress'],
                                      'caption' => TRUE,
                                    ))
                                  ?>
                                </div>
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
<!-- 
                                  <th style="width:9%">
                                      Added
                                  </th>
 -->                                  
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
                              <?php if (count($phase['group']) <= 1): ?>

                                <?php foreach($phase['tasks'] as $task): ?>
                                  <tr>
                                      <td>
                                        <?php echo $task['ticket'] ?>
                                      </td>
                                      <td class="v-align-middle">
                                          <a href="" class="tip" data-toggle="tooltip" title="<?php echo $task['description'] ?>" data-placement="right"><?php echo $task['title'] ?></a>
                                      </td>
                                      <td>
                                        <?php 
                                          $left = intval((100-$task['progress']) / 100 * $task['hours']);
                                        ?>
                                        <a href="" class="tip" data-toggle="tooltip" title="Requested by <?php echo !empty($task['request_by']) ? $task['request_by']['first'] : 'N/A' ?> on <?php echo $task['added'] ?>" data-placement="top"><?php echo $task['hours'] ?> <small>: <?php echo $left ?></small></a>
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
                                        <?php if ($task['edit']): ?>
                                          <a href="<?php echo $task['edit'] ?>" class="tip" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <?php endif ?>
                                        <?php if ($task['delete']): ?>        
                                          <a href="<?php echo $task['delete'] ?>" class="tip" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></a>
                                        <?php endif ?>
                                      </td>
                                  </tr>
                                <?php endforeach;?>

                              <?php else: ?>

                                <?php foreach($phase['group'] as $group => $g): ?>
                                  <?php 
                                    $tasks = $g['tasks'];
                                  ?>
                                  <tr> 
                                    <td colspan="2">
                                      <h5><?php echo $group ? $group : 'Uncategorized' ?></h5>
                                    </td>
                                    <td>
                                      <?php 
                                        $left = intval((100-$g['progress']) / 100 * $g['hours']);
                                      ?>                                      
                                      <h5><?php echo $g['hours'] ?> : <small><?php echo $left ?></small></h5>
                                    </td>
                                    <td>
                                      <h5><?php echo $g['progress'] ?>%</h5>
                                    </td>
                                    <td>
                                    </td>
                                  </tr>
                                  <?php foreach ($tasks as $id): ?>
                                    <?php 
                                      $task = $phase['tasks'][$id];
                                    ?>
                                    <tr>
                                        <td>
                                          <?php echo $task['ticket'] ?>
                                        </td>
                                        <td class="v-align-middle">
                                            <a href="" class="tip" data-toggle="tooltip" title="<?php echo $task['description'] ?>" data-placement="right"><?php echo $task['title'] ?></a>
                                        </td>
                                        <td>
                                          <a href="" class="tip" data-toggle="tooltip" title="Requested by <?php echo !empty($task['request_by']) ? $task['request_by']['first'] : 'N/A' ?> on <?php echo $task['added'] ?>" data-placement="top"><?php echo $task['hours'] ?></a>
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
                                          <?php if ($task['edit']): ?>
                                            <a href="<?php echo $task['edit'] ?>" class="tip" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                          <?php endif ?>
                                          <?php if ($task['delete']): ?>        
                                            <a href="<?php echo $task['delete'] ?>" class="tip" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-times"></i></a>
                                          <?php endif ?>
                                        </td>
                                    </tr>
                                  <?php endforeach ?>
                                <?php endforeach;?>


                              <?php endif; ?>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          <?php endforeach; ?>
        </div>
    </div>
</div>