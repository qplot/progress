<?php

/**
 * @file
 * The theme system, which controls the output of Drupal.
 *
 * The theme system allows for nearly all output of the Drupal system to be
 * customized by user themes.
 */

/**
 * Task Migration.
 */
class DHMilestoneMigration extends XMLMigration {
  /**
   * Construct.
   */
  public function __construct($arguments) {
    parent::__construct($arguments);

    // Define fields.
    $fields = array(
      'id' => t('ID'),
      'class' => t('Class'),
      'name' => t('Name'),
      'permalink' => t('Link'),
      'created' => t('Created On'),
      'updated' => t('Updated On'),
      'state' => t('Status ?'),
      'is_completed' => t('Is Completed'),
      'comments_count' => t('Comments Count'),
      'attachments_count' => t('Attachments Count'),
      'start_on' => t('Start Date'),
      'due_on' => t('Due Date'),
      'project_id' => t('Project ID'),
    );
    // Create source.
    $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/data/milestone';
    $items_url = array();

    if (is_dir($xml_folder)) {
      $directory = new DirectoryIterator($xml_folder);
      foreach ($directory as $fileinfo) {
        if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
          $items_url[] = $fileinfo->getPathname();
        }
      }
    }

    $item_xpath = "/milestones/milestone";
    $item_id_xpath = 'id';
    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_id_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);

    // Create destination.
    $this->destination = new MigrateDestinationNode('phase');

    // Create map.
    $this->map = new MigrateSQLMap($this->machineName,
      array(
        'id' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
        )
      ),
      MigrateDestinationNode::getKeySchema()
    );

    // Fields mapping.
    $this->addFieldMapping('title', 'name')->xpath('name');
    $this->addFieldMapping('created', 'created')->xpath('created_on');
    $this->addFieldMapping('changed', 'updated')->xpath('updated_on');
    $this->addFieldMapping('field_phase_project', 'project_id')->xpath('project_id')
         ->sourceMigration('Project');
    $this->addFieldMapping('field_phase_durating:value', 'start_on')->xpath('start_on');
    $this->addFieldMapping('field_phase_durating:to', 'due_on')->xpath('due_on');
  }

  /**
   * Prepare Row.
   */
  public function prepareRow($row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Prepare.
   */
  public function prepare($node, stdClass $row) {
    if (!empty($row->start_on)) {
      $node->field_phase_durating['und'][0] = array(
        'value' => !empty($row->start_on) ? $row->start_on . ' 00:00:00' : '',
        'value2' => !empty($row->due_on) ? $row->due_on . ' 00:00:00' : '',
        'date_type' => 'datetime',
      );
    }
  }

}
