<?php

/**
 * @file
 * MIgrate module file.
 *
 * Migration for Company.
 */

class DCCompanyMigration extends XMLMigration {
  /**
   * Constructor.
   */
  public function __construct($arguments) {
    parent::__construct($arguments);

    // Create source.
    $fields = array(
      'id' => t('ID'),
      'name' => t('Name'),
      'address_one' => t('Address'),
      'address_two' => t('Address second'),
      'city' => t('City'),
      'state' => t('State'),
      'country' => t('Country'),
      'zip' => t('Postal code'),
      'email_one' => t('Email'),
      'phone' => t('Office Phone'),
      'fax' => t('Office Fax'),
      'website' => t('URL'),
    );

    $xml_folder = PROGRESS_MIGRATE_DATA_DIR . '/data/company_dc';
    $items_url = array();

    if (is_dir($xml_folder)) {
      $directory = new DirectoryIterator($xml_folder);
      foreach ($directory as $fileinfo) {
        if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
          $items_url[] = $fileinfo->getPathname();
        }
      }
    }

    $item_xpath = "/companies/company";
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
    $this->addFieldMapping('field_company_address')
         ->defaultValue('US');
    $this->addFieldMapping('field_company_address:thoroughfare', 'address_one')->xpath('address_one');
    $this->addFieldMapping('field_company_address:locality', 'city')->xpath('city');
    $this->addFieldMapping('field_company_address:administrative_area', 'state')->xpath('state');
    $this->addFieldMapping('field_company_address:postal_code', 'zip')->xpath('zip');
    $this->addFieldMapping('field_company_email', 'email_one')->xpath('email_one');
    $this->addFieldMapping('field_company_phone', 'phone')->xpath('office_phone');
    $this->addFieldMapping('field_company_url', 'website')->xpath('website');
    $this->addFieldMapping('field_company_migrate_source')
         ->defaultValue(array('DrupalConnect'));
    $this->addFieldMapping('field_company_migrate_id', 'id')->xpath('id');
  }

}
