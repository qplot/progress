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

  switch ($vars['name']) {
    case 'leads':
      // $vars['header'] = '<div class="pull-right">' . l('<i class="fa fa-plus"></i> Add Leads', 'node/add/lead', array(
      //   'attributes' => array('class' => array('btn', 'btn-success')),
      //   'query' => drupal_get_destination(),
      //   'html' => TRUE,
      // )) . '</div>';  
      $vars['header'] = theme('views_link', array(
        'text' => '<i class="fa fa-plus"></i> Add Leads',
        'path' => 'node/add/lead',
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
    // dsm($vars['row']);
    // Rerender the link to include edit button
    // $vars['output'] = l('<i class="fa fa-edit"></i>', "node/{$vars['row']->nid}/edit", array(
    //   'attributes' => array('title' => 'edit'), 
    //   'query' => drupal_get_destination(),
    //   'html' => TRUE,
    // ));
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