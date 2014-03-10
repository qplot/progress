<?php 
  global $base_url;
  $path = $base_url . '/' . drupal_get_path('theme', 'webarch') . '/';

  // dsm($menu);
?>

<p class="menu-title">BROWSE <span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>
<ul class="menu">  
  <li class="start active "> 
    <a href="<?php echo $menu['home'] ?>"> 
      <i class="icon-custom-home"></i> 
      <span class="title">Home</span> 
      <span class="selected"></span> 
    </a> 
  </li>
<!--   <li class=""> 
    <a href="master_support.html"> 
      <i class="fa fa-envelope"></i> <span class="title">Support</span>
    </a>
  </li>      
 -->
  <?php if (!empty($menu['project'])): ?>
    <li class=""> 
      <a href="javascript:;"> 
        <i class="fa fa-book"></i> 
        <span class="title">Projects</span> 
        <span class="arrow "></span> 
      </a>
      <ul class="sub-menu">      
        <?php foreach ($menu['user']['project'] as $project): ?>
          <li > <a href="<?php echo $project['view'] ?>"> <?php echo $project['title'] ?> </a> </li>        
        <?php endforeach ?>
      </ul>
    </li>

    <li class=""> 
      <a href="javascript:;"> 
        <i class="icon-custom-portlets"></i> 
        <span class="title">Companies</span> 
        <span class="arrow "></span> 
      </a>
      <ul class="sub-menu">      
        <?php foreach ($menu['user']['company'] as $company): ?>
          <li > <a href="<?php echo $company['view'] ?>"> <?php echo $company['title'] ?> </a> </li>        
        <?php endforeach ?>
      </ul>
    </li>
  <?php endif; ?>

  <?php if ($menu['user']): ?>
    <li class=""> 
      <a href="<?php echo $menu['logout'] ?>"> 
        <i class="fa fa-sign-out"></i> <span class="title">Logout</span>
      </a>
    </li>
  <?php endif; ?>

</ul>