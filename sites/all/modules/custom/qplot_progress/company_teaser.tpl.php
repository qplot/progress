<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');
 ?>
<div class="user-info-wrapper">
  <img src="<?=$path ?>/assets/img/logos/alphamed_press.png" alt="" data-src="<?=$path ?>/assets/img/logos/alphamed_press.png" data-src-retina="assets/img/profiles/avatar2x.jpg" height="36px">
  <div class="user-info">
	<div class="greeting"></div>
	<div class="username">
	  AlphaMed Press
	</div>
	<div class="status">
	  Status<a href="#"></a>
	  <div class="status-icon green"></div>Active
	</div>
  </div>
</div>