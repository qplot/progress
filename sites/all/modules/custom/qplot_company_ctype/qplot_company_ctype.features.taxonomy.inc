<?php
/**
 * @file
 * qplot_company_ctype.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function qplot_company_ctype_taxonomy_default_vocabularies() {
  return array(
    'company_type' => array(
      'name' => 'Company Type',
      'machine_name' => 'company_type',
      'description' => 'Use company type to category the company industry',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
    ),
    'lead_source' => array(
      'name' => 'Lead Source',
      'machine_name' => 'lead_source',
      'description' => 'Use lead source to identify the lead origin',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
    ),
    'migrate_source' => array(
      'name' => 'Migrate Source',
      'machine_name' => 'migrate_source',
      'description' => 'Use migrate source to identify where the migration is coming from',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
    ),
  );
}
