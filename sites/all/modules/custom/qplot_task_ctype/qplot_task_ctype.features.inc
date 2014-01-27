<?php
/**
 * @file
 * qplot_task_ctype.features.inc
 */

/**
 * Implements hook_node_info().
 */
function qplot_task_ctype_node_info() {
  $items = array(
    'task' => array(
      'name' => t('Task'),
      'base' => 'node_content',
      'description' => t('Use <em>Task</em> to assign task to project and phase. Task needs to be specific on which project and which phase it belongs to.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
