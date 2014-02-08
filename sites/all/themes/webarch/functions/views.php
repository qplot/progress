<?php
/**
 * Theme table
 */
// function zen_progress_preprocess_views_view(&$vars) {
//   // kpr($variables);
//   // return '<ul>' . $variables['tree'] . '</ul>';
//   // return '<ul class="menu">' . $variables['tree'] . '</ul>';
//   kpr($vars);
// }

/*
template_preprocess_views_view
options to remove css classes from the view
*/
function webarch_preprocess_views_view(&$vars) {
  dsm($vars);
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view')));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-'.$vars['name'])));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-id-'.$vars['name'])));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-display-id-'.$vars['display_id'])));
}

/**
 * theme table
 */
function webarch_preprocess_views_view_table(&$vars) {
  if (!empty($vars['classes_array'])) {
    // replace with custom class
    $vars['classes_array'][0] = 'table';
  }
}