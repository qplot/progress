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
    'lead_type' => array(
      'name' => 'Lead Type',
      'machine_name' => 'lead_type',
      'description' => 'Use lead type to decide the business sector that the lead is coming from',
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
