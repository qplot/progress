<?php
	global $base_url;
	$path = $base_url . '/' . drupal_get_path('theme', 'webarch');

 // dsm($company);
 // dsm($contacts);
?>

<div class="row spacing-bottom">
  <div class="col-md-12 white col-sm-6">
    <div class="tiles purple added-margin" style="">
      <div class="tiles-body">
        <div class="controller">
          <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
        </div>
        <img src="<?php echo $company['logo'] ?>" alt="" data-src="<?php echo $company['logo'] ?>" data-src-retina="assets/img/profiles/avatar2x.jpg" height="36px">
        <p>
          <?php echo $company['title'] ?>
          <?php if ($company['edit']): ?>
            <a href="<?php echo $company['edit'] ?>" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-edit"></i></a>
          <?php endif; ?>
        </p>
        <?php echo !empty($company['description']) ? $company['description'] : 'No company description'; ?>
      </div>
    </div>
    <div class="tiles white added-margin">
      <div class="tiles-body">
        <?php foreach ($contacts as $contact): ?>
          <div class="row">
            <div class="user-comment-wrapper col-mid-12">
              <div class="profile-wrapper">
                <img src="<?php echo $contact['photo'] ?>" alt="" data-src="<?php echo $contact['photo'] ?>" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
              </div>
              <div class="comment">
                <div class="user-name">
                  <?php echo $contact['name']; ?>
                  <!-- Ann <span class="semi-bold">Murphy</span> Ph.D -->
                </div>
                <div class="preview-wrapper">
                  <?php echo $contact['title'] ?>
                </div>
                <div class="more-details-wrapper">
                  <div class="more-details">
                    <?php echo $contact['phone'] ?>
                  </div>
                  <div class="more-details">
                    <?php echo $contact['email'] ?>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>