<?php 
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

//  dsm($company);
?>
<div class="user-info-wrapper">
    <img src="%3C?php%20echo%20$company['logo']%20?%3E" alt="" data-src="<?php echo $company['logo'] ?>" data-src-retina="assets/img/profiles/avatar2x.jpg" height="36px">
    <div class="user-info">
        <div class="greeting"></div>
        <div class="username">
            <?php echo $company['title'] ?>
        </div>
        <div class="status">
            Status<a href="#"></a>
            <div class="status-icon green"></div><?php echo $company['status'] ?>
        </div>
        <?php if ($company['edit']): ?>
          <a href="<?php echo $company['edit'] ?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i></a>
        <?php endif; ?>        
    </div>
</div>