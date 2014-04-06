<?php

/**
 * @file
 * The theme system, which controls the output of Drupal.
 *
 * The theme system allows for nearly all output of the Drupal system to be
 * customized by user themes.
 */

/**
 * Task Migration.
 */
class DHTaskMigration extends XMLMigration {
  /**
   * Construct.
   */
  public function __construct($arguments) {
    parent::__construct($arguments);

    // Define fields.
    $fields = array(
      'id' => t('ID'),
      'class' => t('Class'),
      'name' => t('Name'),
      'permalink' => t('Link'),
      'created' => t('Created On'),
      'user' => t('Created By'),
      'updated' => t('Updated On'),
      'state' => t('Status ?'),
      'is_completed' => t('Is Completed'),
      'comments_count' => t('Comments Count'),
      'attachments_count' => t('Attachments Count'),
      'assignee' => t('Assigned By'),
      'label_id' => t('Label ID'),
      'label' => t('Label'),
      'object_time' => t('Hours'),
      'category_id' => t('Category ID'),
      'category' => t('Category'),
      'body_formatted' => t('Formatted Body'),
      'project_id' => t('Project ID'),
      'milestone' => t('Milestone'),
      'milestone_id' => t('Milestone ID'),
      'task_id' => t('Task Ordered ID'),
    );
    // Create source.
    $xml_folder = PROGRESS_MIGRATE_DATA_DIR . '/compiled/task';
    $items_url = array();

    if (is_dir($xml_folder)) {
      $directory = new DirectoryIterator($xml_folder);
      foreach ($directory as $fileinfo) {
        if (preg_match('/\.xml$/', $fileinfo->getFilename())) {
          $items_url[] = $fileinfo->getPathname();
        }
      }
    }

    $item_xpath = "/task";
    $item_id_xpath = 'id';
    $items_class = new MigrateItemsXML($items_url, $item_xpath, $item_id_xpath);
    $this->source = new MigrateSourceMultiItems($items_class, $fields);

    // Create destination.
    $this->destination = new MigrateDestinationNode('task');

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

    // Fields mapping.
    $this->addFieldMapping('title', 'name')->xpath('name');
    $this->addFieldMapping('created', 'created')->xpath('created_on');
    // Missing author from created_by_id.
    $this->addFieldMapping('field_task_added', 'created')->xpath('created_on');
    $this->addFieldMapping('changed', 'updated')->xpath('updated_on');
    $this->addFieldMapping('field_task_project', 'project_id')->xpath('project_id')
         ->sourceMigration('Project');
    $this->addFieldMapping('field_task_tag', 'category')->xpath('category/name');
    $this->addFieldMapping('field_task_tag:create_term')
         ->defaultValue(TRUE);
    $this->addFieldMapping('body', 'body_formatted')->xpath('body_formatted');
    $this->addFieldMapping('body:format')
         ->defaultValue('full_html');
    $this->addFieldMapping('field_task_progress', 'is_completed')->xpath('is_completed')
         ->callbacks(array($this, 'assignProgress'));
    $this->addFieldMapping('field_task_hours', 'object_time')->xpath('object_time');
    $this->addFieldMapping('field_task_url', 'permalink')
         ->xpath('permalink');
    $this->addFieldMapping('field_task_url:title', 'task_id')
         ->xpath('task_id');
    $this->addFieldMapping('field_task_phase', 'milestone_id')->xpath('milestone_id')
         ->sourceMigration('Milestone');
    $this->addFieldMapping('field_migrate_source')
         ->defaultValue(array('DesignHammer AC'));
    $this->addFieldMapping('field_migrate_id', 'id')->xpath('id');
  }

  /**
   * Assign Progress.
   */
  protected function assignProgress($value) {
    return $value ? 100 : 0;
  }

  /**
   * Prepare.
   */
  public function prepare($node, stdClass $row) {
    if ($row->milestone_id) {
      return;
    }
    $milestone = 'Default';
    $project_id = $node->field_task_project['und'][0]['target_id'];
    // Find phase or create one for this application.
    if (!($pid = qplot_api_find_nodes2(array(
        'type' => 'phase',
        'field_phase_project' => array('target_id', $project_id, '='),
        'title' => $milestone,
    )))) {
      // Create a new phase.
      $phase = entity_create('node', array('type' => 'phase'));
      $phase_wrapper = entity_metadata_wrapper('node', $phase);
      $phase_wrapper->title->set($milestone);
      $phase->field_phase_project['und'][0]['target_id'] = $project_id;
      $phase_wrapper->save();
      $pid = $phase_wrapper->getIdentifier();
    }
    $node->field_task_phase['und'][0]['target_id'] = $pid;
  }

}
