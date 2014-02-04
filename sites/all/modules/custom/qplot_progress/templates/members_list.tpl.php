<?php
  global $base_url;
  $path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  // dsm($members);
?>

<div class="row">
  <div class="col-md-12 col-sm-6 spacing-bottom">
    <div class="tiles white added-margin">
      <div class="tiles-body">
        <div class="controller">
          <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
        </div>
        <div class="tiles-title">
          Team Members
        </div><br>
        <?php foreach ($members as $user): ?>        
          <div class="friend-list">
            <div class="friend-profile-pic">
              <div class="user-profile-pic-normal">
                <img width="35" height="35" src="<?php echo $user['photo'] ?>" data-src="<?php echo $user['photo'] ?>" data-src-retina="assets/img/profiles/d2x.jpg" alt="">
              </div>
            </div>
            <div class="friend-details-wrapper">
              <div class="friend-name">
                <?php echo $user['first'] ?> <span class="semi-bold"><?php echo $user['last'] ?></span>
              </div>
              <div class="friend-description">
                <?php echo $user['title'] ?>
              </div>
            </div>
            <div class="action-bar pull-right">
              <img src="<?php echo $user['icon'] ?>" alt="" data-src="<?php echo $user['icon'] ?>" data-src-retina="assets/img/profiles/d2x.jpg" width="25" height="25">
            </div>
            <div class="clearfix"></div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>
