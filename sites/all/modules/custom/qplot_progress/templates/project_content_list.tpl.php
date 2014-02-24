<?php
  global $base_url;
  $path = $base_url . '/' . drupal_get_path('theme', 'webarch');

  // dsm($members);
?>

<div class="row spacing-bottom">
  <div class="col-md-12 col-sm-6">
    <div class="tiles white added-margin">
      <div class="tiles-body">
        <div class="controller">
          <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a>
        </div>
        <div class="tiles-title">
          Project Content
        </div>
        <div class="grid-body no-border">
          <h4>Major <span class="semi-bold">Content</span></h4>
          <?php if (empty($content)): ?>
            <p>No content has been assigned for this project.</p>
          <?php endif; ?>
          <?php foreach ($content as $value): ?>
            <span class=""><a href="" class="btn btn-mini btn-white" style="margin: 2px"><?php echo $value['title'] ?></a></span>
          <?php endforeach ?>
          <h4>Site <span class="semi-bold">Pages</span></h4>
          <?php if (empty($pages)): ?>
            <p>No page has been assigned for this project.</p>
          <?php endif; ?>
          <?php foreach ($pages as $value): ?>
            <span class=""><a href="" class="btn btn-mini btn-white" style="margin: 2px"><?php echo $value['title'] ?></a></span>
          <?php endforeach ?>

          <div class="clearfix"></div>
        </div>

      </div>
    </div>
  </div>
</div>

