<?php
/**
 * @file
 * qplot_content_ctype.features.inc
 */

/**
 * Implements hook_node_info().
 */
function qplot_content_ctype_node_info() {
  $items = array(
    'content' => array(
      'name' => t('Content'),
      'base' => 'node_content',
      'description' => t('Use <em>Content</em> to list all major content types which has been used by the project'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
