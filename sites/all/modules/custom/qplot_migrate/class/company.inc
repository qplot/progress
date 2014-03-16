<?php

class DHCompanyMigration extends XMLMigration {
  public function __construct($arguments) {
    parent::__construct($arguments);

    $fields = array(
      'id' => t('ID'),
      'class' => t('Class'),
      'name' => t('Name'),
      'created' => t('Created On'),
      'user' => t('Created By'),
      'updated' => t('Updated On'),
      'state' => t('Status ?'),
      'address' => t('Office Address'),
      'phone' => t('Office Phone'),
      'fax' => t('Office Fax'),
      'url' => t('URL'),
      'note' => t('Note'),
    );
    // create source

    // multiple records in one file    
    // $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/data/';
    // $items_url = $xml_folder . 'company.xml';
    // $item_xpath = "/companies/company";
    // $item_ID_xpath = 'id';
    // $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_ID_xpath);
    // $this->source = new MigrateSourceMultiItems($items_class, $fields);

    // multiple records in multiple files
    $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/compiled/company';
    $items_url = array();

    if (is_dir($xml_folder)) {
      $directory = new DirectoryIterator($xml_folder);
      foreach ($directory as $fileinfo) {
        if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
          $items_url[] = $fileinfo->getPathname();
        }
      }
    }

    $item_xpath = "/company";
    $item_ID_xpath = 'id';
    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_ID_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);

    // create destination
    $this->destination = new MigrateDestinationNode('company');

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

    $this->addFieldMapping('title', 'name')->xpath('name');
    $this->addFieldMapping('created', 'created')->xpath('created_on');
    // missing author from created_by_id
    $this->addFieldMapping('changed', 'updated')->xpath('updated_on');
    // missing state
    // missing address
    // missing logo
    $this->addFieldMapping('body', 'note')->xpath('note');
    $this->addFieldMapping('body:format')
         ->defaultValue('full_html');
    $this->addFieldMapping('field_company_url', 'url')->xpath('office_homepage');
    $this->addFieldMapping('field_company_migrate_source')
         ->defaultValue(array('DesignHammer'));
    $this->addFieldMapping('field_company_migrate_id', 'id')->xpath('id');
  }

  public function prepareRow($row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    return TRUE;
  }

}

?>
