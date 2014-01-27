<?php
/**
 * @file
 * qplot_lead_ctype.features.inc
 */

/**
 * Implements hook_node_info().
 */
function qplot_lead_ctype_node_info() {
  $items = array(
    'lead' => array(
      'name' => t('Lead'),
      'base' => 'node_content',
      'description' => t('Use <em>Lead</em> to capture marketing info.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
