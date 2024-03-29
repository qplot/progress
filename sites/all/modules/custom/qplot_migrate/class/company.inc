<?php

/**
 * @file
 * MIgrate module file.
 *
 * Migration for Company.
 */

class DHCompanyMigration extends XMLMigration {
  /**
   * Constructor.
   */
  public function __construct($arguments) {
    parent::__construct($arguments);

    // Create source.
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

    $xml_folder = PROGRESS_MIGRATE_DATA_DIR . '/compiled/company';
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
    $item_id_xpath = 'id';
    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_id_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);

    // Create destination.
    $this->destination = new MigrateDestinationNode('company');

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

    $this->addFieldMapping('title', 'name')->xpath('name');
    $this->addFieldMapping('created', 'created')->xpath('created_on');
    // Missing author from created_by_id.
    $this->addFieldMapping('changed', 'updated')->xpath('updated_on');
    $this->addFieldMapping('field_company_address')
         ->defaultValue('US');
    $this->addFieldMapping('field_company_address:thoroughfare')
         ->defaultValue('stored in data');
    $this->addFieldMapping('field_company_address:data', 'address')->xpath('office_address');
    $this->addFieldMapping('field_company_phone', 'phone')->xpath('office_phone');
    // Missing logo.
    $this->addFieldMapping('body', 'note')->xpath('note');
    $this->addFieldMapping('body:format')
         ->defaultValue('full_html');
    $this->addFieldMapping('field_company_url', 'url')->xpath('office_homepage');
    $this->addFieldMapping('field_company_migrate_source')
         ->defaultValue(array('DesignHammer AC'));
    $this->addFieldMapping('field_company_migrate_id', 'id')->xpath('id');
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

}
