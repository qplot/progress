<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


$theme_path = drupal_get_path('theme', 'webarch');

  include_once './' . $theme_path . '/functions/menu.php';
  include_once './' . $theme_path . '/functions/views.php';
  include_once './' . $theme_path . '/functions/form.php';


/**
 * General preprocess function borrowed from mothership theme
 */
// function mothership_preprocess(&$vars, $hook) {
//   global $theme;
//   global $base_url;
//   $path = drupal_get_path('theme', $theme);

//   if ( $hook == "html" ) {


//   }
// }

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function zen_progress_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  zen_progress_preprocess_html($variables, $hook);
  zen_progress_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function zen_progress_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function webarch_preprocess_page(&$variables, $hook) {
  $variables['path'] = base_path().drupal_get_path('theme', 'webarch').'/';
  // $variables['breadcrumbs'] = array('12','23');
}

/**
 * Returns HTML for status and/or error messages, grouped by type.
 */
function webarch_status_messages($variables) {
  $display = $variables['display'];
  $vars['messages'] = drupal_get_messages($display);
  return theme('qplot_progress_status_messages', $vars);
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function zen_progress_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // zen_progress_preprocess_node_page() or zen_progress_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function zen_progress_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function zen_progress_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function webarch_preprocess_block(&$vars, $hook) {
  // if ($vars['block_html_id'] == 'block-user-login') {
  //   dsm($vars);
  // }

  // remove css
  $vars['id_block'] = "";
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('block')));
  $vars['classes_array'] = preg_grep('/^block-/', $vars['classes_array'], PREG_GREP_INVERT);
  $vars['classes_array'] = array_values(array_diff($vars['classes_array'],array('contextual-links-region')));
  $vars['id_block'] = ' id="' . $vars['block_html_id'] . '"';
  $vars['classes_array'][] = $vars['block_html_id'];

  //adds title class to the block ... OMG!
  $vars['title_attributes_array']['class'][] = 'menu-title';
  $vars['content_attributes_array']['class'][] = 'block-content';
}

/**
 * Override button
 */
function webarch_button($variables) {
  // dsm($variables);
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));

  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }
  $element['#attributes']['class'][] = 'btn';

  return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/**
 * Override link
 */
function webarch_link($variables) {
  // dsm($variables);
  switch ($variables['text']) {
    case 'edit':
      $variables['text'] = '<i class="fa fa-edit"></i>';
      $variables['options']['html'] = TRUE;
      break;

    case 'Add Lead':
      $variables['text'] = '<i class="fa fa-edit"></i>' . $variables['text'];
      $variables['options']['html'] = TRUE;
      break;

    default:
      # code...
      break;
  }
  return '<a href="' . check_plain(url($variables['path'], $variables['options'])) . '"' . drupal_attributes($variables['options']['attributes']) . '>' . ($variables['options']['html'] ? $variables['text'] : check_plain($variables['text'])) . '</a>';
}

/**
 * Override breadcrumb
 */
function webarch_breadcrumb($variables) {
  // dsm($variables);
  // $breadcrumb = $variables['breadcrumbs'];
  // dsm($breadcrumb);

  // if (!empty($breadcrumb)) {
  //   // Provide a navigational heading to give context for breadcrumb links to
  //   // screen-reader users. Make the heading invisible with .element-invisible.
  //   $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

  //   $output .= '<div class="breadcrumb">' . implode(' » ', $breadcrumb) . '</div>';
  //   return $output;
  // }
}