<?php

class DHProjectMigration extends XMLMigration {
  public function __construct($arguments) {
    parent::__construct($arguments);

    // create source
    $fields = array(
      'id' => t('ID'),
      'class' => t('Class'),
      'name' => t('Name'),
      'completed' => t('Is Completed'),
      'category_id' => t('Category ID'),
      'created' => t('Created On'),
      'updated' => t('Updated On'),
      'state' => t('Status ?'),
      'slug' => t('Slug'),
      'company_id' => t('Company ID'),
      'overview' => t('Overview'),
      'percent_done' => t('Progress'),
      'total_tasks' => t('Total Tasks'),
      'open_tasks' => t('Open Tasks'),
      'budget' => t('Budget'),
      'cost' => t('Cost Summarized'),
    );

    $xml_folder = DRUPAL_ROOT . '/' . drupal_get_path('module', 'qplot_migrate') . '/compiled/project';
    $items_url = array();

    if (is_dir($xml_folder)) {
      $directory = new DirectoryIterator($xml_folder);
      foreach ($directory as $fileinfo) {
        if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
          $items_url[] = $fileinfo->getPathname();
        }
      }
    }

    $item_xpath = "/project";
    $item_ID_xpath = 'id';
    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_ID_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);

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
    $this->addFieldMapping('field_project_old_id', 'id')->xpath('id');
    $this->addFieldMapping('title', 'name')->xpath('name');
    $this->addFieldMapping('created', 'created')->xpath('created_on');
    $this->addFieldMapping('changed', 'updated')->xpath('updated_on');
    $this->addFieldMapping('field_project_company', 'company_id')->xpath('company_id')
         ->sourceMigration('Company');
    $this->addFieldMapping('body', 'overview')->xpath('overview');
    $this->addFieldMapping('body:format')
         ->defaultValue('full_html');
    $this->addFieldMapping('field_project_progress', 'percent_done')->xpath('progress/percent_done');
    $this->addFieldMapping('field_project_category', 'category_id')->xpath('category_id')
         ->sourceMigration('Category');
    $this->addFieldMapping('field_project_category:source_type')
         ->defaultValue('tid');
    $this->addFieldMapping('field_project_status', 'completed')->xpath('is_completed')
         ->callbacks(array($this, 'assignCompleted'));
    // missing project avatar
    // missing leader id

    $this->addFieldMapping('field_project_icon')
         ->defaultValue('adjust');
    $this->addFieldMapping('field_project_budget', 'budget')->xpath('budget');
    $this->addFieldMapping('field_project_cost', 'cost')->xpath('cost_summarized');

    $this->addFieldMapping('field_project_migrate_source')
         ->defaultValue(array('DesignHammer AC'));
    $this->addFieldMapping('field_project_migrate_id', 'id')->xpath('id');
  }

  public function prepareRow($row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    return TRUE;
  }  

  protected function assignCompleted($value) {
    if ($value) {
      return 'Completed';
    } else {
      return NULL;
    }
  }

}

?>
