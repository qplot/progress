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
                              <td colspan="2">
                                <h5 class="semi-bold no-margin">Overall Phase Progress : </h5>
                              </td>
                              <td>
                                <?php 
                                  $left = intval((100-$phase['progress']) / 100 * $phase['hours']);
                                ?>                                      
                                <h5 class="semi-bold no-margin"><?php echo $phase['hours'] ?> : <small class="semi-bold no-margin"><?php echo $left ?></small></h5>
                              </td>
                              <td colspan="<?php $phase['create_task'] ? 2 : 1 ?>" class="v-align-middle">
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
                                  <th style="width:40%">
                                      Task
                                  </th>
                                  <th style="width:5%">
                                      Hours
                                  </th>
                                  <th style="width:20%">
                                      Progress
                                  </th>
                                  <?php if ($phase['create_task']): ?>
                                    <th style="width:7%">
                                        Edit
                                    </th>
                                  <?php endif ?>
                              </tr>
                          </thead>
                          <tbody>

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
                                <?php if ($phase['create_task']): ?>
                                  <td>
                                  </td>
                                <?php endif ?>
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
                                      <a href="" class="tip" data-toggle="tooltip" title="" data-placement="right">
                                        <?php if ($task['description']): ?>
                                          <i class="fa fa-file-text-o"></i>
                                        <?php endif; ?>
                                        <?php echo $task['title'] ?>
                                      </a>
                                    </td>
                                    <td>
                                      <a href="" class="tip" data-toggle="tooltip" title="Requested by <?php echo !empty($task['request_by']) ? $task['request_by']['first'] : 'N/A' ?> on <?php echo $task['added'] ?>" data-placement="top">
                                        <?php echo $task['hours'] ?>
                                      </a>
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
                                    <?php if ($phase['create_task']): ?>
                                      <td>
                                        <?php if ($task['edit']): ?>
                                          <a href="<?php echo $task['edit'] ?>" class="tip" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <?php endif ?>
                                        <?php if ($task['delete']): ?>        
                                          <a href="<?php echo $task['delete'] ?>" class="tip" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                                        <?php endif ?>
                                      </td>
                                    <?php endif ?>
                                </tr>
                              <?php endforeach ?>
                            <?php endforeach;?>


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