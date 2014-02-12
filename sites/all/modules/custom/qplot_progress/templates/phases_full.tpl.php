<?php
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  // dsm($phases);
?>

<div class="row tiles-container tiles white spacing-bottom">
    <div class="tiles-body">
        <div class="controller">
            <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
        </div>        
        <div class="tiles-title">
            Tasks in Phases
        </div><br>
        
        <ul class="nav nav-pills" id="tab-4">          
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
                        <?php if ($project['create']): ?>
                          <a href="<?php echo $project['create'] ?>" class="btn btn-mini"><i class="fa fa-plus"></i> add </a>
                        <?php endif; ?>
                        <?php if ($phase['delete']): ?>
                          <a href="<?php echo $phase['delete'] ?>" class="btn btn-mini"><i class="fa fa-eraser"></i> delete phase </a>                        
                        <?php endif ?>
                        <?php if ($phase['edit']): ?>
                          <a href="<?php echo $phase['edit'] ?>" class="btn btn-mini"><i class="fa fa-pencil"></i> edit </a>
                        <?php endif; ?>
                      </p>

                      <h3>
                          <?php echo $project['title'] ?>: <span class="semi-bold"><?php echo $phase['title'] ?></span>
                      </h3>
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
                                  <a href="<?php echo $phase['create'] ?>" class="" data-togle="tooltip" title="Add New Task"><i class="fa fa-plus"> New</i></a>
                                <?php endif; ?>
                              </td>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <td colspan="5">
                              </td>
                              <td>
                                <?php if ($phase['create']): ?>
                                  <a href="<?php echo $phase['create'] ?>" class="" data-togle="tooltip" title="Add New Task"><i class="fa fa-plus"> New</i></a>
                                <?php endif; ?>
                              </td>
                            </tr>
                          </tfoot>                                                      
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
                                      <a href="" class="tip" data-toggle="tooltip" title="<?php echo $task['description'] ?>" data-placement="right"><?php echo $task['title'] ?></a>
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
            </div>
          <?php endforeach; ?>
        </div>
    </div>
</div>