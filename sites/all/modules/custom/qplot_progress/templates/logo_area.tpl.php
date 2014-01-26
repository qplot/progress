<?php
  $logo = theme_get_setting ('logo');
  $front_page = $GLOBALS['base_path'];
?>
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