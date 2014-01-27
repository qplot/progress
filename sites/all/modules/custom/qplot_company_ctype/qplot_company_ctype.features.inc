<?php
/**
 * @file
 * qplot_company_ctype.features.inc
 */

/**
 * Implements hook_node_info().
 */
function qplot_company_ctype_node_info() {
  $items = array(
    'company' => array(
      'name' => t('Company'),
      'base' => 'node_content',
      'description' => t('Use <em>Company</em> to log company informations'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
