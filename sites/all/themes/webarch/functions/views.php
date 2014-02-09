<?php

/*
 * Theme view
 * One way to add custom element to views as well
 */
function webarch_preprocess_views_view(&$vars) {
  // dsm($vars);
  // Remove css classes from the view
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view')));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-'.$vars['name'])));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-id-'.$vars['name'])));
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('view-display-id-'.$vars['display_id'])));

  // Add button to the top of the views
  $pages = array(
    'leads' => 'lead',
    'contacts' => 'contact',
  );
  $name = $vars['name'];
  switch ($name) {
    case 'contacts':
    case 'leads':
      $vars['header'] = theme('views_link', array(
        'text' => '<i class="fa fa-plus"></i> Add ' . ucfirst($name),
        'path' => 'node/add/' . $pages[$name],
        'query' => drupal_get_destination(),
        'classes' => array('btn', 'btn-success'),
        'parent-classes' => array('pull-right'),
      ));    
      break;
    
    default:
      # code...
      break;
  }
}

/**
 * Theme table
 */
function webarch_preprocess_views_view_table(&$vars) {
  if (!empty($vars['classes_array'])) {
    // replace with custom class
    $vars['classes_array'][0] = 'table';
  }
}

/**
 * Theme table row record
 */
function webarch_preprocess_views_view_fields(&$vars) {
  // kpr($vars);
}

/**
 * Theme table field
 */
function webarch_preprocess_views_view_field(&$vars) {
  if (get_class($vars['field']) == 'views_handler_field_node_link_edit') {
  }
 // $vars['output'] = $vars['field']->advanced_render($vars['row']);
}

/**
 * Theme table exposed form
 */
function webarch_preprocess_views_exposed_form(&$vars) {
  // dsm($vars);
}

/**
 * Theme summary
 */
function webarch_preprocess_views_view_summary(&$vars) {
  dsm($vars);
}