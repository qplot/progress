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
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view')));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-'.$vars['name'])));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-id-'.$vars['name'])));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-display-id-'.$vars['display_id'])));
}

/**
 * Theme table
 */
function webarch_preprocess_views_view_table(&$vars) {
  // dsm($vars);
  if (!empty($vars['classes_array'])) {
    // replace with custom class
    $vars['classes_array'][0] = 'table';
  }
}

/**
 * Theme table field
 */
function webarch_preprocess_views_view_field(&$vars) {
  if (get_class($vars['field']) == 'views_handler_field_node_link_edit') {
    // dsm($vars['row']);
    // Rerender the link to include edit button
    $vars['output'] = l('<i class="fa fa-edit"></i>', "node/{$vars['row']->nid}/edit", array(
      'attributes' => array('title' => 'edit'), 
      'query' => drupal_get_destination(),
      'html' => TRUE,
    ));
  }
 // $vars['output'] = $vars['field']->advanced_render($vars['row']);
}

