<?php
/**
 * @file
 * qplot_contact_ctype.features.inc
 */

/**
 * Implements hook_node_info().
 */
function qplot_contact_ctype_node_info() {
  $items = array(
    'contact' => array(
      'name' => t('Contact'),
      'base' => 'node_content',
      'description' => t('Use <em>Contact</em> to capture more information about the person, ex. title, email, phone etc. '),
      'has_title' => '1',
      'title_label' => t('Name'),
      'help' => '',
    ),
  );
  return $items;
}
