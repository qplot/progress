<?php

class DHCategoryMigration extends XMLMigration {
  public function __construct($arguments) {
    parent::__construct($arguments);

    $fields = array(
      'id' => t('ID'),
      'class' => t('Class'),
      'name' => t('Name'),
    );
    // create source
    $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/data/';
    $items_url = $xml_folder . 'category.xml';
    $item_xpath = "/categories/category";
    $item_ID_xpath = 'id';

    // create destination
    $this->destination = new MigrateDestinationTerm('project_category');

    // create map
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

    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_ID_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);

    $this->addFieldMapping('name', 'name')->xpath('name');
  }
}

?>
