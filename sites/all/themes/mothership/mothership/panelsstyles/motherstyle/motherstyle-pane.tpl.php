<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- tpl: motherstyle-pane.tpl.php -->
<?php } ?>

<?php
  //id
  $css_id = !empty($content->css_id) ? ' id="'.$content->css_id.'"' : '';

  //markup & Role
  $markup = !empty($settings['markup']) ? $settings['markup'] : '';
  $role = !empty($settings['role']) ? 'role="'.$settings['role'].'"' : '';
  
  //css
  $css_regions = implode(' ',array_filter($settings['class']));
  $css_custom = (!empty($settings['custom_class'])) ? ' ' . $settings['custom_class'] : '';
  $css_taste =  $css_regions . $css_custom . $content->css_class;
  $css = !empty($css_taste) ? 'class="' . $css_regions .' '. $css_custom . ' ' . $content->css_class .'"' : '';
?>
 

<?php if(!empty($markup)){ ?>
<<?php print $markup .' '. $role .' '. $css . $css_id ?>>
<?php } ?>

  <?php if (isset($admin_links)): ?>
    <?php print $admin_links; ?>
  <?php endif; ?>

  <?php if (!empty($title)): ?>
    <h2><?php print $title; ?></h2>
  <?php endif ?>

  <?php if (isset($content->content)): ?>
    <?php print render($content->content); ?>
  <?php endif ?>

<?php if(!empty($markup)){ ?>
</<?php print $markup;?>>
<?php } ?>  


<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- /tpl: motherstyle-pane.tpl.php -->
<?php } ?>
