<?php
global $user;
$user_fields = user_load($user->uid)->name;
$uname = $user_fields;
?>
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse ">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <?php echo theme('qplot_progress_logo_area'); ?>
    <div class="header-quick-nav" >
      <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="pull-left">
        <ul class="nav quick-section">
          <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
            <div class="iconset top-menu-toggle-dark"></div>
            </a> </li>
        </ul>
        <ul class="nav quick-section">
          <li class="quicklinks"> <a href="#" class="" >
            <div class="iconset top-reload"></div>
            </a> </li>
          <li class="quicklinks"> <span class="h-seperate"></span></li>
          <li class="quicklinks"> <a href="#" class="" >
            <div class="iconset top-tiles"></div>
            </a> </li>
      <li class="m-r-10 input-prepend inside search-form no-boarder">
        <span class="add-on"> <span class="iconset top-search"></span></span>
         <input name="" type="text"  class="no-boarder " placeholder="Search Dashboard" style="width:250px;">
      </li>
      </ul>
    </div>
   <!-- END TOP NAVIGATION MENU -->
   <!-- BEGIN CHAT TOGGLER -->
    <div class="pull-right">
      <div class="chat-toggler">
        <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom"  data-content='' data-toggle="dropdown" data-original-title="Notifications">
          <div class="user-details">
            <div class="username">
              <?=$uname;?> <span class="bold"></span>
            </div>
          </div>
          <div class="iconset top-down-arrow"></div>
        </a>
        <div id="notification-list" style="display:none">
          <div style="width:300px">
          </div>
        </div>
        <?php if(!empty($uname)): ?>
          <div class="profile-pic">
            <img src="<?=$path?>assets/img/profiles/avatar_small.jpg"  alt="" data-src="<?=$path?>assets/img/profiles/avatar_small.jpg" data-src-retina="<?=$path?>assets/img/profiles/avatar_small2x.jpg" width="35" height="35" />
          </div>
        <?php endif; ?>
      </div>
      <ul class="nav quick-section ">
        <li class="quicklinks">
          <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
            <div class="iconset top-settings-dark "></div>
          </a>
          <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
            <li><a href="user"> My Account</a></li>
            <li><a href="calender.html">My Calendar</a></li>
            <li><a href="email.html"> My Inbox&nbsp;&nbsp;<span class="badge badge-important animated bounceIn"></span></a></li>
            <li class="divider"></li>
            <li><a href="user/logout"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
          </ul>
        </li>
        <li class="quicklinks"> <span class="h-seperate"></span></li>
        <li class="quicklinks">
        <a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" ><div class="iconset top-chat-dark "><span class="badge badge-important hide" id="chat-message-count"></span></div>
        </a>
        </li>
      </ul>
    </div>
     <!-- END CHAT TOGGLER -->
    </div>
      <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar" id="main-menu">
    <?php print render($page['sidebar_first']); ?>
  </div>
  <div class="footer-widget">
    <div class="pull-right">
      <a href="user/logout"><i class="fa fa-power-off"></i></a>
    </div>
    <div><?php print render($page['footer']); ?></div>
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN PAGE CONTAINER-->


  <div class="page-content">
    <div class="clearfix"></div>
    <div class="page-title">
      <?php print render($page['highlighted']); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
    </div>
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true" id="grid-config">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="clearfix"></div>
    <div class="content">
      <div class="page-title"> <i class="fa fa-home"></i>
        <h3>Welcome to - <span class="semi-bold">QPLOT Progress</span></h3 >
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="grid simple ">
            <div class="grid-title no-border">
              <h4>New <span class="semi-bold">Features</span></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="grid-body no-border">
              <div class="row">
                <div class="col-md-4">
                  <h3>Track <span class="semi-bold">Progress</span></h3>
                  <p>Task description and progress can be a helpful way to stay on track when every of team member are working on various component of a large project. QPLOT Progress, other than other tracking application, try to focus more on the higher level while facing hundreds tasks in the daily basis. </p>
                </div>
                <div class="col-md-4">
                  <h3>Accounting <span class="semi-bold">Status</span></h3>
                  <p>For shareholder and general contractor to move the project forward, the most important thing are serious of accounting status, which includes the proposal and approval status of task list, payment status and the development availability status. Ever imaging to find out all status on one page ? </p>
                  <br>
                </div>
                <div class="col-md-4">
                  <h3>Better <span class="semi-bold">Decisions</span></h3>
                  <p>Aware of the progress in the higher level and then dive in the granulation of detail is a strategic step to make better and prompt decisions in refining deadline, reserving budget and allocating resources.</p>
                  <br>
                  <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#myModal"> Try progress today ! </button>
                  <!-- Modal -->
                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <br>
                          <i class="icon-credit-card icon-7x"></i>
                          <h4 id="myModalLabel" class="semi-bold">We need your billing info.</h4>
                          <p class="no-margin">You'll be charged $29/Month and get immediate access to new plan </p>
                          <br>
                        </div>
                        <div class="modal-body">
                          <div class="row form-row">
                            <div class="col-md-8">
                              <input type="text" class="form-control" placeholder="Your Card Number">
                            </div>
                            <div class="col-md-4">
                              <input type="text" class="form-control" placeholder="CVS">
                            </div>
                          </div>
                          <div class="row form-row">
                            <div class="col-md-12">
                              <input type="text" class="form-control" placeholder="Card Holder's Name">
                            </div>
                          </div>
                          <div class="row form-row">
                            <div class="col-md-6">
                              <input type="text" class="form-control" placeholder="Month">
                            </div>
                            <div class="col-md-6">
                              <input type="text" class="form-control" placeholder="Year">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!-- Latest Task  -->
      <div class="row">
        <div class="col-md-8">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Latest <span class="semi-bold">Task</span></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="grid-body no-border">
              <div class="row-fluid">
                <div >
                  <h3>With <span class="semi-bold">QPLOT Progress</span></h3>
                  <h4><span class="semi-bold">Tracking is</span>, Easy , <span class="semi-bold">Fun</span> , <i>and Stay focused</i></h4>
                  <div class="row">
                    <div class="col-md-12 col-vlg-7">
                      <ul class="cbp_tmtimeline">
                        <li>
                          <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                            <span class="date">today</span>
                            <span class="time">10:05 <span class="semi-bold">am</span></span>
                          </time>
                          <div class="cbp_tmicon primary animated bounceIn"> <i class="fa fa-comments"></i> </div>
                          <div class="cbp_tmlabel">
                            <div class="p-t-10 p-l-30 p-r-20 p-b-20 xs-p-r-10 xs-p-l-10 xs-p-t-5">
                              <h4 class="pull-right"> Task <span class="semi-bold">Completed</span> </h4>
                              <h4 class="inline m-b-5"><span class="text-success semi-bold">Jane smith</span> </h4>
                              <h5 class="inline muted semi-bold m-b-5">@qplot</h5>
                              <div class="muted">Completed</div>
                              <p class="m-t-5 dark-text"> Client Admin has ability to push out reminders</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="tiles grey p-t-10 p-b-10 p-l-20">
                              <ul class="action-links">
                                <li>5 hours</li>
                                <li>40%</li>
                                <li>Project: Oncologist</li>
                                <li>Phase: 12/22/13</li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </li>
                        <li>
                          <time class="cbp_tmtime" datetime="2013-04-10 18:30">
                            <span class="date">yesterday</span>
                            <span class="time">1:30 <span class="semi-bold">pm</span></span>
                          </time>
                          <div class="cbp_tmicon info animated bounceIn"> <i class="fa fa-quote-left"></i> </div>
                          <div class="cbp_tmlabel">
                            <div class="p-t-10 p-l-30 p-r-20 p-b-20 xs-p-r-10 xs-p-l-10 xs-p-t-5">
                              <h4 class="pull-right"> New Project <span class="semi-bold">Added</span> </h4>
                              <h4 class="inline m-b-5"><span class="text-success semi-bold">John smith</span> </h4>
                              <h5 class="inline muted semi-bold m-b-5">@ duke</h5>
                              <div class="muted">Created</div>
                              <div class="m-t-5 dark-text">
                                Ask member whether they are willing to share attachment within PGH community.
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="tiles grey p-t-10 p-b-10 p-l-20">
                              <ul class="action-links">
                                <li>200 hours</li>
                                <li>0%</li>
                                <li>Project: AlphaTrinity</li>
                                <li>Phase: N/A</li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="grid simple ">
            <div class="grid-title no-border">
              <h4>Projects <span class="semi-bold">Tracked</span></h4>
            </div>
            <div class="grid-body no-border">
              <div>
                <ul class="progress-list" >
                  <li>
                    <div class="details-wrapper">
                      <div class="name">AHP Hospital</div>
                      <div class="description">Redesign and support</div>
                    </div>
                    <div class="details-status pull-right">
                      <span class="animate-number" data-value="89" data-animation-duration="800">0</span>%
                    </div>
                    <div class="clearfix"></div>
                    <div class="progress progress-small no-radius" >
                      <div class="progress-bar progress-bar-success animate-progress-bar" data-percentage="89%" ></div>
                    </div>
                  </li>
                  <li>
                    <div class="details-wrapper">
                      <div class="name">Oscar Medium</div>
                      <div class="description">Forum survey app</div>
                    </div>
                    <div class="details-status pull-right">
                       <span class="animate-number" data-value="45" data-animation-duration="600">0</span>%
                    </div>
                    <div class="clearfix"></div>
                    <div class="progress progress-small no-radius ">
                      <div class="progress-bar progress-bar-warning animate-progress-bar" data-percentage="45%" ></div>
                    </div>
                  </li>
                  <li>
                    <div class="details-wrapper">
                      <div class="name">Super 8 Publisher</div>
                      <div class="description">Multisite deployment</div>
                    </div>
                    <div class="details-status pull-right">
                      <span class="animate-number" data-value="12" data-animation-duration="200">0</span>%
                    </div>
                    <div class="clearfix"></div>
                    <div class="progress progress-small no-radius">
                      <div class="progress-bar progress-bar-danger animate-progress-bar" data-percentage="12%" ></div>
                    </div>
                  </li>         
                </ul>

                <button class="btn btn-lg btn-success pull-right" data-toggle="modal" data-target="#myModal"> Add your project  </button>
                <div class="clearfix"></div>

              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="grid simple ">
            <div class="grid-title no-border">
              <h4>Trusted <span class="semi-bold">by</span></h4>
            </div>
            <div class="grid-body no-border">

              <div class="user-comment-wrapper col-mid-12">
                <div>
                  <img src="<?php echo $path ?>assets/img/logos/qplot_small.png" width="35" height="35" title="QPLOT">
                  <img src="<?php echo $path ?>assets/img/logos/alphamed_small.jpg" width="35" height="35">
                  <img src="<?php echo $path ?>assets/img/logos/plusdelta_small.png" width="35" height="35">
                  <img src="<?php echo $path ?>assets/img/logos/duke_small2.jpg" height="35">

                </div>
                <div class="comment">
                  <div class="user-name">
                  . <span class="semi-bold">.</span>
                  </div>  
                  <div class="preview-wrapper">
                    Most talented architecture work
                  </div>
                  <div class="more-details-wrapper">
                    <div class="more-details">
                    <i class="icon-time"></i> 12 mins ago
                    </div>
                    <div class="more-details">
                    <i class="icon-map-marker"></i> Still tracking
                    </div>
                  </div>
                </div>

                <div class="clearfix"></div>
              </div>

            </div>
          </div>
        </div>              
      </div>
    </div>
  </div>

</div>
<!-- END CONTAINER -->
<!-- BEGIN SIDEBAR 2 -->
<div id="sidr" class="chat-window-wrapper">
  <div id="main-chat-wrapper" >
  <div class="chat-window-wrapper fadeIn" id="chat-users" >
    <div class="side-widget fadeIn">
    <div class="side-widget">
      <?php print render($page['sidebar_second']); ?>
    </div>
    </div>
  </div>
  <a href="#" class="scrollup">Scroll</a>
  <div class="clearfix"></div>
  </div>
</div>
<!-- END SIDEBAR 2 -->
<!-- END CONTAINER -->
</body>
</html>