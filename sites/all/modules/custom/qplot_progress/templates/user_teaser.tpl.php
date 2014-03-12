<?php
  // dsm($user);
?>
<div class="user-info-wrapper">
  <div class="profile-wrapper">
    <img src="<?php echo $user['photo'] ?>" alt="" data-src="<?php echo $user['photo'] ?>" data-src-retina="assets/img/profiles/avatar2x.jpg" width="69" height="69">
  </div>
  <div class="user-info">
    <div class="greeting">
      Welcome
    </div>
    <div class="username">
      <?php echo $user['first'] ?> <span class="semi-bold"><?php echo $user['last'] ?></span>
    </div>
    <div class="status">
      Status<a href="#"></a>
      <div class="status-icon green"></div><?php echo $user['status'] ?>
    </div>
  </div>
</div>