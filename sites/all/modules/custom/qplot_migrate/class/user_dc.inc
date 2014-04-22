<?php

/**
 * @file
 * MIgrate module file.
 *
 * Migration for User.
 */

class DCUserMigration extends XMLMigration {
  /**
   * Constructor.
   */
  public function __construct($arguments) {
    parent::__construct($arguments);

    // Create source.
    $fields = array(
      'id' => t('ID'),
      'name' => t('Name'),
      'permalink' => t('Link'),
      'created-at' => t('Created On'),
      'last-changed-on' => t('Updated On'),
      'first-name' => t('First Name'),
      'last-name' => t('Last Name'),
      'email-address' => t('Email'),
      'notes' => t('Notes'),
      'title' => t('Title'),
      'phone-number-office' => t('Phone Work'),
      'phone-number-mobile' => t('Phone Mobile'),
      'im_type' => t('IM Type'),
      'im_value' => t('IM Value'),
      'last_visit' => t('Last Visit On'),
      'companyid' => t('Company ID'),
    );

    $xml_folder = PROGRESS_MIGRATE_DATA_DIR . '/compiled/user_dc';
    $items_url = array();

    if (is_dir($xml_folder)) {
      $directory = new DirectoryIterator($xml_folder);
      foreach ($directory as $fileinfo) {
        if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
          $items_url[] = $fileinfo->getPathname();
        }
      }
    }

    $item_xpath = "/people/person";
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
    $this->addFieldMapping('created', 'created-at')->xpath('created-at');
    $this->addFieldMapping('changed', 'last-changed-on')->xpath('last-changed-on');
    $this->addFieldMapping('field_contact_firstname', 'first-name')->xpath('first-name');
    $this->addFieldMapping('field_contact_lastname', 'last-name')->xpath('last-name');
    $this->addFieldMapping('field_contact_title', 'title')->xpath('title');
    $this->addFieldMapping('field_contact_phone', 'phone-number-office')->xpath('phone-number-office');
    $this->addFieldMapping('field_contact_email', 'email-address')->xpath('email-address');
    $this->addFieldMapping('field_contact_company', 'companyid')->xpath('companyid')
         ->sourceMigration('Company_DC');
    $this->addFieldMapping('body', 'notes')->xpath('notes');
    $this->addFieldMapping('body:format')
         ->defaultValue('full_html');
    $this->addFieldMapping('field_contact_migrate_source')
         ->defaultValue(array('DrupalConnect'));
    $this->addFieldMapping('field_contact_migrate_id', 'id')->xpath('id');
  }

}
