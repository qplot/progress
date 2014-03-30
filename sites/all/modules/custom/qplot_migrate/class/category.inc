<?php

/**
 * @file
 * MIgrate module file.
 *
 * Migration for Project Category.
 */

class DHCategoryMigration extends XMLMigration {
  /**
   * Constructor.
   */
  public function __construct($arguments) {
    parent::__construct($arguments);

    $fields = array(
      'id' => t('ID'),
      'class' => t('Class'),
      'name' => t('Name'),
    );
    // Create source.
    $xml_folder = PROGRESS_MIGRATE_DATA_DIR;
    $items_url = $xml_folder . '/data/category/category.xml';
    $item_xpath = "/categories/category";
    $item_id_xpath = 'id';

    // Create destination.
    $this->destination = new MigrateDestinationTerm('project_category');

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

    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_id_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);

    $this->addFieldMapping('name', 'name')->xpath('name');
  }
}
