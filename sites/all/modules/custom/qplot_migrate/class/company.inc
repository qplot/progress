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
    $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/data/';
    $items_url = $xml_folder . 'company.xml';
    $item_xpath = "/companies/company";
    $item_ID_xpath = 'id';

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

    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_ID_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);
    $this->addFieldMapping('title', 'name')->xpath('name');
    $this->addFieldMapping('created', 'created')->xpath('created_on');
    // missing author from created_by_id
    $this->addFieldMapping('changed', 'updated')->xpath('updated_on');
    // missing state
    // missing address
    // missing logo
    $this->addFieldMapping('body', 'description')
         ->xpath('note');
    $this->addFieldMapping('body:format')
         ->defaultValue('full_html');
    $this->addFieldMapping('field_company_url', 'url')
         ->xpath('office_homepage');
    $this->addFieldMapping('field_company_migrate_source')
         ->defaultValue(array('DesignHammer'));
    $this->addFieldMapping('field_company_migrate_id', 'id')
         ->xpath('id');
    // $this->addFieldMapping('created', 'date')
    //      ->xpath('publicationDate');
    // $this->addFieldMapping('field_latest_identifier', 'identifier')
    //      ->xpath('identifier[1]');
  }

  public function prepareRow($row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    return TRUE;
  }

}

?>
