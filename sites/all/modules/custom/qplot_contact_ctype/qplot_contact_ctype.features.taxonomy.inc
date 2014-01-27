<?php
/**
 * @file
 * qplot_contact_ctype.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function qplot_contact_ctype_taxonomy_default_vocabularies() {
  return array(
    'contact_type' => array(
      'name' => 'Contact Type',
      'machine_name' => 'contact_type',
      'description' => 'Use contact type to capture the type of job, ex. agent or developer etc.',
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
