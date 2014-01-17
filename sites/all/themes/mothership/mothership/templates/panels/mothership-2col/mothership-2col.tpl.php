<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- tpl:  mothership-2col.tpl.php -->
<?php } ?>

<?php
/* Use Drupals basic markup for the backend  */
if (arg(0) =="admin"){
?>

<div class="panel-display" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

  <div class="panel-panel panel-col-100">
    <div class="inside"><?php print $content['top']; ?></div>
  </div>


  <div class="panel-panel panel-col-100">
    <div class="panel-panel panel-col-50">
      <div class="inside"><?php print $content['left']; ?></div>
    </div>
    <div class="panel-panel panel-col-50">
      <div class="inside"><?php print $content['right']; ?></div>
    </div>
  </div>

    <div class="panel-panel panel-col-100">
      <div class="inside"><?php print $content['bottom']; ?></div>
    </div>

  </div>

</div>


<?php
}else{
/*  and a clean mean markup for the frontend w*/
?>
<?php
  $css_sneaky = !empty($settings['sneaky_class']) ? ' '.$settings['sneaky_class'] : '';
?>
<article class="<?php print $css_sneaky; ?>" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <?php if(!empty($variables['display']->title)){ ?>
    <header>
    <h2><?php print $variables['display']->title; ?></h2>
    </header>
  <?php } ?>
  
  <div class="l-top"><?php print $content['top']; ?></div>
  
  <div class="">
    <div class="l-left"><?php print $content['left']; ?></div>
    <div class="l-right"><?php print $content['right']; ?></div>
  </div>
  
  <div class="l-bottom"><?php print $content['bottom']; ?></div>
</article>
<?php } ?>

<?php if( theme_get_setting('mothership_poorthemers_helper') ){ ?>
<!-- / tpl: mothership-2col.tpl.php -->
<?php } ?>


