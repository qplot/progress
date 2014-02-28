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
        <?php if ($user): ?>
        <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom"  data-content='' data-toggle="dropdown" data-original-title="Notifications">
          <div class="user-details">
            <div class="username">
              <?php echo $user['first'] ?>
              <span class="bold"><?php echo $user['last'] ?></span>                
            </div>
          </div>
          <div class="iconset top-down-arrow"></div>
        </a>
        <div id="notification-list" style="display:none">
          <div style="width:300px">
          </div>
        </div>
        <div class="profile-pic">
          <img src="<?php echo $user['photo'] ?>"  alt="" width="35" height="35" />
        </div>
        <?php endif ?>
      </div>
      <ul class="nav quick-section ">
        <li class="quicklinks">
          <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
            <div class="iconset top-settings-dark "></div>
          </a>
          <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
            <!-- <li class="divider"></li> -->
            <li><a href="<?php echo $user['logout'] ?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
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
    <div class="content">
    <div class="page-title">
      <?php print render($page['highlighted']); ?>
      <?php print $breadcrumb; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php print render($tabs); ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
    </div>
    <?php print render($page['content']); ?>
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