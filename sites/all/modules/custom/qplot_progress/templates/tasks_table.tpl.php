<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  //dsm($tasks);
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
            <li class="active">
                <a href="#tab4hellowWorld">1/1/14</a>
            </li>
            <li>
                <a href="#tab4FollowUs">12/12/13</a>
            </li>
            <li>
                <a href="#tab4Inspire">Phase II</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab4hellowWorld">
                <div class="row">
                    <div class="grid">
                        <div class="grid-body no-border">
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
                                    <?php foreach($tasks as $task): ?>
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
            <div class="tab-pane" id="tab4FollowUs">
                <div class="row">
                    <div class="col-md-12">
                        2
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab4Inspire">
                <div class="row">
                    <div class="col-md-12">
                        3
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>