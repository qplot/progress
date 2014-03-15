<?php

class DHTaskMigration extends XMLMigration {
  public function __construct($arguments) {
    parent::__construct($arguments);

    $fields = array(
      'id' => t('ID'),
      'class' => t('Class'),
      'name' => t('Name'),
      'permalink' => t('Link'),
      'created' => t('Created On'),
      'user' => t('Created By'),
      'updated' => t('Updated On'),
      'state' => t('Status ?'),
      'completed' => t('Is Completed'),
      'comments_count' => t('Comments Count'),
      'attachments_count' => t('Attachments Count'),
      'assignee' => t('Assigned By'),
      'category' => t('Category'),
      'url' => t('URL'),
      'note' => t('Note'),
      'project' => t('Project'),
      'milestone' => t('Milestone'),
      'task' => t('Task ID'),
    );
    // create source
    $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/data/';
    $items_url = $xml_folder . 'task_6.xml';
    $item_xpath = "/tasks/task";
    $item_ID_xpath = 'id';

    // create destination
    $this->destination = new MigrateDestinationNode('task');

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
    $this->addFieldMapping('field_task_project', 'project')->xpath('project_id')
         ->sourceMigration('Project');
    // missing date added from created_on
    // missing progress
    // missing hours
    // missing body
    // missing tag
    $this->addFieldMapping('field_task_url', 'permalink')
         ->xpath('permalink');
    $this->addFieldMapping('field_task_url:title', 'task')
         ->xpath('task');

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
