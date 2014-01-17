<?php
global $user;
$user_fields = user_load($user->uid)->name;
$uname = $user_fields;
?>
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse "> 
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
  <div class="header-seperation"> 
    <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">  
      <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" > <div class="iconset top-menu-toggle-white"></div> </a> </li>     
    </ul>
      <!-- BEGIN LOGO --> 
      <?php if ($logo): ?>
       <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="header__logo" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header__logo-image"/></a>
      <?php endif; ?>      
      <!-- END LOGO --> 
      <ul class="nav pull-right notifcation-center">  
        <li class="dropdown" id="header_task_bar"> <a href="<?php print $front_page; ?>" class="dropdown-toggle active" data-toggle=""> <div class="iconset top-home"></div> </a> </li>
        <li class="dropdown" id="header_inbox_bar" > <a href="email.html" class="dropdown-toggle" > <div class="iconset top-messages"></div>  <span class="badge" id="msgs-badge"></span> </a></li>
        <li class="dropdown" id="portrait-chat-toggler" style="display:none"> <a href="#sidr" class="chat-menu-toggle"> <div class="iconset top-chat-white "></div> </a> </li>        
      </ul>
      </div>
      <!-- END RESPONSIVE MENU TOGGLER --> 
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
    <div class="content">  
    <div class="page-title">
      <?php print $messages; ?>  
      <?php if ($title): ?>
        <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
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