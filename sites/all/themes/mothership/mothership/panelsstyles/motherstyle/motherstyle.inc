<?php
/**
 * Implementation of hook_panels_styles().
 */

$plugin =  array(
  'motherstyle' => array(
    'title' => t('motherstyle'),
    'description'   => t('Motherstyle'),

    'render region' => 'motherstyle_render_region',
    'render pane'   => 'motherstyle_render_pane',

    'settings form' => 'motherstyle_region_settings',
    'pane settings form' => 'motherstyle_settings_pane',

    'hook theme'    => array(

      'motherstyle_pane' => array(
        'template' => 'motherstyle-pane',
         'path'    => drupal_get_path('module', 'mothership') .'/panelsstyles/motherstyle',
         'variables' => array(
           'content' => NULL,
           'settings' => NULL,
           'motherstyles' => NULL,
         ),
       ),

      'motherstyle_minipanel' => array(
        'template' => 'motherstyle-minipanel',
         'path'    => drupal_get_path('module', 'mothership') .'/panelsstyles/motherstyle',
         'variables' => array(
           'content' => NULL,
           'settings' => NULL,
         ),
       ),

      'motherstyle_region' => array(
        'template' => 'motherstyle-region',
         'path' => drupal_get_path('module', 'mothership') .'/panelsstyles/motherstyle',
         'variables' => array(
           'content' => NULL,
         ),
       ),

    ),
  ),
);

// render pane
function theme_motherstyle_render_pane(&$vars) {

  //test for pane type.
  $template = '';

  if (isset($vars['pane']->type)) {
    switch ($vars['pane']->type) {
      case 'panels_mini':
        $template = 'motherstyle_minipanel';
      break;
      default:
        $template = 'motherstyle_pane';
    }
  }

  //variables to send
  $settings = $vars['settings'];
  $content = $vars['content'];
  $pane = $vars['pane'];


  if(!empty($vars['pane']->configuration['override_title'])){
    $title = '' . $vars['pane']->configuration['override_title_text'];
  }else{
    // $title = 'display title' . $vars['display']->title; - we use this so were keeping it in case of trouble;)
    $title = !empty($vars['content']->title) ? $vars['content']->title : '';
  }

  $title = ctools_context_keyword_substitute($title, array(), $vars['display']->context);


  return theme($template, array('content' => $content, 'settings' => $settings, 'pane' => $pane, 'title' => $title));
}

// render region
function theme_motherstyle_render_region($vars) {

  $settings = $vars['settings'];
  $title = $vars['display']->title;
  $motherstyles = theme_get_setting('mothership_styles','mothership');
  $content = '';

  foreach ($vars['panes'] as $pane_id => $pane_output) {
   $content .= $pane_output;
  }
  if (empty($content)) {
    return;
  }

  return theme('motherstyle_region', array('content' => $content, 'settings' => $settings, 'title' => $title));
}


/**
 * Panels Region form settings.
 */
function motherstyle_region_settings($style_settings) {

  //Theme defined styles & markup wrappers
  //get it from the default theme 
  //@TODO: should be a variable but for now hardcoded ftw
  $theme_default = variable_get('theme_default');

  // --- Markup
  $motherstyle_markup =  explode(' ', theme_get_setting('motherstyle_markup', $theme_default));
  $theme_markup = array(t('no markup'));
  foreach ($motherstyle_markup as $key => $value) {
    $theme_markup[$value] =  $value ;
  }

  // --- role
  $motherstyle_role =  explode(' ', theme_get_setting('motherstyle_role', $theme_default));
  $theme_role = array(t('no role'));
  foreach ($motherstyle_role as $key => $value) {
    $theme_role[$value] =  $value ;
  }

  // --- class
  $motherstyle_class =  explode(' ', theme_get_setting('motherstyle_class', $theme_default));
  foreach ($motherstyle_class as $key => $value) {
    $theme_class[$value] =  $value ;
  }
  
  //markup
  $form['markup'] = array(
    '#type' => 'select',
    '#title' => t('markup'),
    '#options' => $theme_markup,
    '#default_value' => (isset($style_settings['markup'])) ? $style_settings['markup'] : '',
  );
  //Role
  $form['role'] = array(
    '#type' => 'select',
    '#title' => t('role:'),
    '#options' => $theme_role,
    '#default_value' => (isset($style_settings['role'])) ? $style_settings['role'] : '',
  );

   // class
  $form['class'] = array(
    '#type' => 'checkboxes',
    '#title' => t('css class:'),
    '#options' => $theme_class,
    '#default_value' => (isset($style_settings['class'])) ? $style_settings['class'] : '',
    '#description' => t('css classes is defined in theme settings')
  );
  // custom class ... cause we know we need it someday
  $form['custom_class'] = array(
    '#type' => 'textfield',
    '#title' => t('custom css class:'),
    '#default_value' => (isset($style_settings['custom_class'])) ? $style_settings['custom_class'] : ''
  );

  return $form;
}

/**
 * Pane setting form settings.
 */
function motherstyle_settings_pane($style_settings) {
  //Theme defined styles & markup wrappers
  //get it from the default theme 
  //@TODO: should be a variable but for now hardcoded ftw
  $theme_default = variable_get('theme_default');

  // --- Markup
  $motherstyle_markup =  explode(' ', theme_get_setting('motherstyle_markup', $theme_default));
  $theme_markup = array(t('no markup'));
  foreach ($motherstyle_markup as $key => $value) {
    $theme_markup[$value] =  $value ;
  }

  // --- role
  $motherstyle_role =  explode(' ', theme_get_setting('motherstyle_role', $theme_default));
  $theme_role = array(t('no role'));
  foreach ($motherstyle_role as $key => $value) {
    $theme_role[$value] =  $value ;
  }

  // --- class
  $motherstyle_class =  explode(' ', theme_get_setting('motherstyle_class', $theme_default));
  foreach ($motherstyle_class as $key => $value) {
    $theme_class[$value] =  $value ;
  }
  
  //markup
  $form['markup'] = array(
    '#type' => 'select',
    '#title' => t('markup'),
    '#options' => $theme_markup,
    '#default_value' => (isset($style_settings['markup'])) ? $style_settings['markup'] : '',
  );
  //Role
  $form['role'] = array(
    '#type' => 'select',
    '#title' => t('role:'),
    '#options' => $theme_role,
    '#default_value' => (isset($style_settings['role'])) ? $style_settings['role'] : '',
  );

   // class
  $form['class'] = array(
    '#type' => 'checkboxes',
    '#title' => t('css class:'),
    '#options' => $theme_class,
    '#default_value' => (isset($style_settings['class'])) ? $style_settings['class'] : '',
    '#description' => t('css classes is defined in theme settings')
  );
  // custom class ... cause we know we need it someday
  $form['custom_class'] = array(
    '#type' => 'textfield',
    '#title' => t('custom css class:'),
    '#default_value' => (isset($style_settings['custom_class'])) ? $style_settings['custom_class'] : ''
  );

  return $form;
}
