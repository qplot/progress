<?php
/**
 * @file
 * qplot_project_ctype.features.inc
 */

/**
 * Implements hook_node_info().
 */
function qplot_project_ctype_node_info() {
  $items = array(
    'project' => array(
      'name' => t('Project'),
      'base' => 'node_content',
      'description' => t('Use <em>Project</em> to input project information'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
