<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

 // dsm($project);
 // dsm($items);
?>

 <div class="row tiles-container tiles white spacing-bottom">
  <div class="tile-more-content col-md-4 col-sm-4 no-padding">
    <div class="tiles green">
      <div class="tiles-body">
        <div class="heading">
          <?php echo $project['title'] ?>
        </div>
        <p>
          Status : <?php echo $project['status'] ?>
        </p>
      </div>
      <div class="tile-footer">
        Migrate and redesign stemcell journal site.
        <?php if ($project['edit']): ?>
          <a href="<?php echo $project['edit'] ?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i></a>
        <?php endif; ?>
      </div>
    </div>
    <div class="tiles-body">
      <ul class="progress-list">
        <?php foreach ($items as $phase): ?>
          <?php 
            $bar = 'success';
            if ($phase['progress'] < 60) $bar = 'failure';
            if ($phase['progress'] < 40) $bar = 'danger';
          ?>
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
              <div class="progress-bar progress-bar-<?=$bar ?> animate-progress-bar" data-percentage="<?php echo $phase['progress'] ?>%"></div>
            </div>
          </li>
        <?php endforeach ?>        
      </ul>
    </div>
  </div>
  <div class="tiles white col-md-8 col-sm-8 no-padding">
    <div class="tiles-chart">
      <div class="controller">
        <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
      </div>
      <div class="tiles-body">
        <div class="tiles-title">
          <?php echo $project['company'] ?>
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

            <!-- BEGIN TASKS BLOCk -->

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
          <!-- 
                          <h3>
                            Basic <span class="semi-bold">Table</span>
                          </h3>
           --> 
                          <table class="table no-more-tables">
                            <thead>
                              <tr>
                                <th style="width:9%">
                                  Project Name
                                </th>
                                <th style="width:22%">
                                  Description
                                </th>
                                <th style="width:6%">
                                  Price
                                </th>
                                <th style="width:10%">
                                  Progress
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="v-align-middle">
                                  Early Bird
                                </td>
                                <td class="v-align-middle">
                                  <span class="muted">Redesign project template</span>
                                </td>
                                <td>
                                  <span class="muted">$4,500</span>
                                </td>
                                <td class="v-align-middle">
                                  <div class="progress">
                                    <div data-percentage="79%" class="progress-bar progress-bar-success animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Angry Birds&nbsp;&nbsp;&nbsp;<span class="label label-important">ALERT!</span>
                                </td>
                                <td>
                                  <span class="muted">Something goes here</span>
                                </td>
                                <td>
                                  <span class="muted">$9,000</span>
                                </td>
                                <td>
                                  <div class="progress">
                                    <div data-percentage="10%" class="progress-bar progress-bar-danger animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  PHP Login page
                                </td>
                                <td class="v-align-middle">
                                  <span class="muted">A project in business and science is typically defined</span>
                                </td>
                                <td>
                                  <span class="muted">$5,400</span>
                                </td>
                                <td>
                                  <div class="progress">
                                    <div data-percentage="65%" class="progress-bar progress-bar-info animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Zombies
                                </td>
                                <td class="v-align-middle">
                                  <span class="muted">frequently involving research or design</span>
                                </td>
                                <td>
                                  <span class="muted">$6,000</span>
                                </td>
                                <td>
                                  <div class="progress">
                                    <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                  Early Bird
                                </td>
                                <td class="v-align-middle">
                                  <span class="muted">Redesign project template</span>
                                </td>
                                <td>
                                  <span class="muted">$4,500</span>
                                </td>
                                <td class="v-align-middle">
                                  <div class="progress">
                                    <div data-percentage="79%" class="progress-bar progress-bar-success animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Angry Birds&nbsp;&nbsp;&nbsp;<span class="label label-important">ALERT!</span>
                                </td>
                                <td>
                                  <span class="muted">Something goes here</span>
                                </td>
                                <td>
                                  <span class="muted">$9,000</span>
                                </td>
                                <td>
                                  <div class="progress">
                                    <div data-percentage="10%" class="progress-bar progress-bar-danger animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  PHP Login page
                                </td>
                                <td class="v-align-middle">
                                  <span class="muted">A project in business and science is typically defined</span>
                                </td>
                                <td>
                                  <span class="muted">$5,400</span>
                                </td>
                                <td>
                                  <div class="progress">
                                    <div data-percentage="65%" class="progress-bar progress-bar-info animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="v-align-middle">
                                  Early Bird
                                </td>
                                <td class="v-align-middle">
                                  <span class="muted">Redesign project template</span>
                                </td>
                                <td>
                                  <span class="muted">$4,500</span>
                                </td>
                                <td class="v-align-middle">
                                  <div class="progress">
                                    <div data-percentage="79%" class="progress-bar progress-bar-success animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  Angry Birds&nbsp;&nbsp;&nbsp;<span class="label label-important">ALERT!</span>
                                </td>
                                <td>
                                  <span class="muted">Something goes here</span>
                                </td>
                                <td>
                                  <span class="muted">$9,000</span>
                                </td>
                                <td>
                                  <div class="progress">
                                    <div data-percentage="10%" class="progress-bar progress-bar-danger animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  PHP Login page
                                </td>
                                <td class="v-align-middle">
                                  <span class="muted">A project in business and science is typically defined</span>
                                </td>
                                <td>
                                  <span class="muted">$5,400</span>
                                </td>
                                <td>
                                  <div class="progress">
                                    <div data-percentage="65%" class="progress-bar progress-bar-info animate-progress-bar"></div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="tab-pane" id="tab4FollowUs">
                    <div class="row">
                      <div class="col-md-12">2
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab4Inspire">
                    <div class="row">
                      <div class="col-md-12">3
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- END TASKS BLOCk -->