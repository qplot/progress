<?php

class DHProjectMigration extends XMLMigration {
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
      'budget' => t('Budget'),
    );
    // create source
    $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/data/';
    $items_url = $xml_folder . 'project.xml';
    $item_xpath = "/projects/project";
    $item_ID_xpath = 'id';

    // create destination
    $this->destination = new MigrateDestinationNode('project');

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
    // missing state from state
    // missing is completed
    // missing project avatar
    // missing category
    // missing company id from company_id
    // missing leader id
    $this->addFieldMapping('field_project_budget', 'budget')->xpath('budget');

    // $this->addFieldMapping('body', 'description')
    //      ->xpath('description');
    // $this->addFieldMapping('body:format')
    //      ->defaultValue('full_html');
    // $this->addFieldMapping('field_latest_link', 'link')
    //      ->xpath('link');
    // $this->addFieldMapping('created', 'date')
    //      ->xpath('publicationDate');
    // $this->addFieldMapping('field_latest_identifier', 'identifier')
    //      ->xpath('identifier[1]');
  }

  public function prepareRow($row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    dsm($row);
    // $row->identifier = str_replace('info:doi/', '', $row->identifier);

    return TRUE;
  }

}

?>
