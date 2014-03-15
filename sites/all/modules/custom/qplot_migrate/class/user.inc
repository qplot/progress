<?php

class DHUserMigration extends XMLMigration {
  public function __construct($arguments) {
    parent::__construct($arguments);

    $fields = array(
      'id' => t('ID'),
      'class' => t('Class'),
      'name' => t('Name'),
      'permalink' => t('Link'),
      'created' => t('Created On'),
      'updated' => t('Updated On'),
      'state' => t('Status ?'),
      'first_name' => t('First Name'),
      'last_name' => t('Last Name'),
      'display_name' => t('Display Name'),
      'email' => t('Email'),
      'short_display_name' => t('Short Display Name'),
      'last_visit' => t('Last Visit On'),
      'company_id' => t('Company ID'),
    );
    // create source
    $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/data/';
    $items_url = $xml_folder . 'user.xml';
    $item_xpath = "/users/user";
    $item_ID_xpath = 'id';

    // create destination
    $this->destination = new MigrateDestinationNode('contact');

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
    $this->addFieldMapping('changed', 'updated')->xpath('updated_on');
    $this->addFieldMapping('field_contact_firstname', 'first_name')->xpath('first_name');
    $this->addFieldMapping('field_contact_lastname', 'last_name')->xpath('last_name');
    $this->addFieldMapping('field_contact_email', 'email')->xpath('email');
    $this->addFieldMapping('field_contact_company', 'company_id')->xpath('company_id')
         ->sourceMigration('Company');
    $this->addFieldMapping('field_contact_migrate_source')
         ->defaultValue(array('DesignHammer'));
    $this->addFieldMapping('field_contact_migrate_id', 'id')->xpath('id');
  }

  public function prepareRow($row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    return TRUE;
  }

}

?>
