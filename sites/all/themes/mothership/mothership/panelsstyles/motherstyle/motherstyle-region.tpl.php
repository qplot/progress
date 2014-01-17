<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!--motherstyle-region.tpl.php-->
<?php } ?>

<?php
  //markup & Role
  $markup = !empty($settings['markup']) ? $settings['markup'] : '';
  $role = !empty($settings['role']) ? 'role="'.$settings['role'].'"' : '';
  
  //css
  $css_regions = implode(' ',array_filter($settings['class']));
  $css_custom = (!empty($settings['custom_class'])) ? ' ' . $settings['custom_class'] : '';
  $css_taste =  $css_regions . $css_custom;
  $css = !empty($css_taste) ? 'class="' . $css_regions .' '. $css_custom .'"' : '';
?>

<?php if (isset($content)): ?>

  <?php if(!empty($markup)){ ?>
  <<?php print $markup .' '. $role . $css ?>>
  <?php } ?>
  
  <?php if (!empty($title)): ?>
   <h2><?php print $title; ?></h2>
  <?php endif ?>

  <?php print render($content); ?>
  
  <?php if(!empty($markup)){ ?>
  </<?php print $markup;?>>
  <?php } ?>  

<?php endif ?>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- /motherstyle-region.tpl.php -->
<?php } ?>
