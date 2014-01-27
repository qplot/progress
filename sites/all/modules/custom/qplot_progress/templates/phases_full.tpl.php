<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  dsm($phases);
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
                            <p class="pull-right"> 
                              <?php 
                                $classes = array(
                                  'Proposed' => '',
                                  'Approved' => 'important',
                                  'Paid' => 'inverse',
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
                            <?php echo $phase['description'] ?>

                            <table class="table no-more-tables">
                                <thead>
                                    <tr>
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
                                                <div data-percentage="<?php echo $task['progress'] ?>%" class="progress-bar progress-bar-success animate-progress-bar"></div>
                                            </div>
                                        </td>
                                        <td>
                                          <a href="<?php echo $task['edit'] ?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i></a>
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