<?php
/**
 * @file
 * qplot_project_flag.features.inc
 */

/**
 * Implements hook_flag_default_flags().
 */
function qplot_project_flag_flag_default_flags() {
  $flags = array();
  // Exported flag: "Favorite Projects".
  $flags['favorite_projects'] = array(
    'entity_type' => 'node',
    'title' => 'Favorite Projects',
    'global' => 0,
    'types' => array(
      0 => 'project',
    ),
    'flag_short' => 'Favorite',
    'flag_long' => '',
    'flag_message' => '',
    'unflag_short' => 'UnFavorite',
    'unflag_long' => '',
    'unflag_message' => '',
    'unflag_denied_text' => '',
    'link_type' => 'toggle',
    'weight' => 0,
    'show_in_links' => array(
      'full' => 0,
      'teaser' => 0,
      'rss' => 0,
      'search_index' => 0,
      'search_result' => 0,
      'diff_standard' => 0,
      'token' => 0,
    ),
    'show_as_field' => 0,
    'show_on_form' => 0,
    'access_author' => '',
    'show_contextual_link' => 0,
    'i18n' => 0,
    'api_version' => 3,
    'module' => 'qplot_project_flag',
    'locked' => array(
      0 => 'name',
    ),
  );
  return $flags;

}
