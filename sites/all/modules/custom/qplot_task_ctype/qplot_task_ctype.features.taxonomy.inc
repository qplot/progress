<?php
/**
 * @file
 * qplot_task_ctype.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function qplot_task_ctype_taxonomy_default_vocabularies() {
  return array(
    'task_tag' => array(
      'name' => 'Task Tag',
      'machine_name' => 'task_tag',
      'description' => 'Use task tag to assign task to different categories within the phase',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
  );
}
