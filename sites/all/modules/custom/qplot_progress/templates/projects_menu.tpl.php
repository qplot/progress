<?php 
  global $base_url;
  $path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  // dsm($companies);
?>

<div class="side-bar-widgets">

  <p class="menu-title">
    PROJECTS <span class="pull-right"><a href="javascript:;"></a></span>
  </p>
  <ul class="menu">
    <?php foreach ($companies as $company => $projects): ?>      
      <li>
        <a href="javascript:;">
          <i class="fa fa-archive"></i>
          <span class="title"><?php echo $company ?></span>
          <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
          <?php foreach ($projects as $project): ?>
            <li>
              <a href="<?php echo $project['view'] ?>"><span class="title"><?php echo $project['title'] ?></span></a>
            </li>
          <?php endforeach ?>
        </ul>
      </li>
    <?php endforeach ?>
  </ul>
</div>