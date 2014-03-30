<?php

/**
 * @file
 * MIgrate module file.
 *
 * Migration for User.
 */

class DHUserMigration extends XMLMigration {
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
      'permalink' => t('Link'),
      'created' => t('Created On'),
      'updated' => t('Updated On'),
      'state' => t('Status ?'),
      'first_name' => t('First Name'),
      'last_name' => t('Last Name'),
      'display_name' => t('Display Name'),
      'office' => t('Office Address'),
      'owner' => t('Is Owner'),
      'email' => t('Email'),
      'short_display_name' => t('Short Display Name'),
      'title' => t('Title'),
      'phone_work' => t('Phone Work'),
      'phone_mobile' => t('Phone Mobile'),
      'im_type' => t('IM Type'),
      'im_value' => t('IM Value'),
      'last_visit' => t('Last Visit On'),
      'company_id' => t('Company ID'),
    );

    $xml_folder = PROGRESS_MIGRATE_DATA_DIR . '/compiled/user';
    $items_url = array();

    if (is_dir($xml_folder)) {
      $directory = new DirectoryIterator($xml_folder);
      foreach ($directory as $fileinfo) {
        if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
          $items_url[] = $fileinfo->getPathname();
        }
      }
    }

    $item_xpath = "/user";
    $item_id_xpath = 'id';
    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_id_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);

    // Create destination.
    $this->destination = new MigrateDestinationNode('contact');

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
    $this->addFieldMapping('title', 'name')->xpath('name');
    $this->addFieldMapping('created', 'created')->xpath('created_on');
    $this->addFieldMapping('changed', 'updated')->xpath('updated_on');
    $this->addFieldMapping('field_contact_firstname', 'first_name')->xpath('first_name');
    $this->addFieldMapping('field_contact_lastname', 'last_name')->xpath('last_name');
    $this->addFieldMapping('field_contact_title', 'title')->xpath('title')
         ->callbacks(array($this, 'fixEmpty'));
    $this->addFieldMapping('field_contact_phone', 'phone_work')->xpath('phone_work');
    // Missing mobile phone.
    // Missing messager.
    $this->addFieldMapping('field_contact_email', 'email')->xpath('email');
    $this->addFieldMapping('field_contact_company', 'company_id')->xpath('company_id')
         ->sourceMigration('Company');
    $this->addFieldMapping('field_contact_migrate_source')
         ->defaultValue(array('DesignHammer AC'));
    $this->addFieldMapping('field_contact_migrate_id', 'id')->xpath('id');
  }

  /**
   * Preapre Row.
   */
  public function prepareRow($row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Fix Empty.
   */
  protected function fixEmpty($value) {
    if ($value) {
      return $value;
    }
    else {
      return NULL;
    }
  }

}
