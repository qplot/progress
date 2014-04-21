<?php
/**
 * @file
 * qplot_lead_ctype.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function qplot_lead_ctype_taxonomy_default_vocabularies() {
  return array(
    'lead_status' => array(
      'name' => 'Lead Status',
      'machine_name' => 'lead_status',
      'description' => 'Use lead status to see if lead has been responded',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
    ),
  );
}
