<?php
/**
 * @file
 * qplot_phase_ctype.features.inc
 */

/**
 * Implements hook_node_info().
 */
function qplot_phase_ctype_node_info() {
  $items = array(
    'phase' => array(
      'name' => t('Phase'),
      'base' => 'node_content',
      'description' => t('Use <em>Phase</em> to tag project for individual timeframe, either for contract purpose or accounting purpose. One phase can be associated with multiple projects. And normally one project will have multiple phases, ex. phase1, phase2, support1, support 2 etc.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
