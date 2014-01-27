<?php
/**
 * @file
 * qplot_phase_ctype.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function qplot_phase_ctype_taxonomy_default_vocabularies() {
  return array(
    'phase_status' => array(
      'name' => 'Phase Status',
      'machine_name' => 'phase_status',
      'description' => 'Use phase status to indicate the stage of the phase',
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
