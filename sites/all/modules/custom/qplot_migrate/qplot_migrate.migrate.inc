<?php

/**
 * @file
 * MIgrate module file.
 *
 * Migration.
 */

/**
 * Migrate API.
 */
function qplot_migrate_migrate_api() {
  $api = array(
    'api' => 2,
    'groups' => array(
      'dh' => array(
        'title' => t('DH AC'),
      ),
      'dc' => array(
        'title' => t('DC TW'),
      )
    ),
    'migrations' => array(
      'Preprocess' => array(
        'class_name' => 'DHPreprocessMigration',
        'group_name' => 'dh',
      ),
      'Company' => array(
        'class_name' => 'DHCompanyMigration',
        'group_name' => 'dh',
        'soft_dependencies' => array('Preprocess')
      ),
      'User' => array(
        'class_name' => 'DHUserMigration',
        'group_name' => 'dh',
        'soft_dependencies' => array('Preprocess', 'Company')
      ),
      'Category' => array(
        'class_name' => 'DHCategoryMigration',
        'group_name' => 'dh',
        'soft_dependencies' => array('Preprocess')
      ),
      'Project' => array(
        'class_name' => 'DHProjectMigration',
        'group_name' => 'dh',
        'soft_dependencies' => array('Preprocess', 'Company', 'Category')
      ),
      'Milestone' => array(
        'class_name' => 'DHMilestoneMigration',
        'group_name' => 'dh',
        'soft_dependencies' => array('Preprocess', 'Project')
      ),
      'Task' => array(
        'class_name' => 'DHTaskMigration',
        'group_name' => 'dh',
        'soft_dependencies' => array('Preprocess', 'Project', 'Milestone')
      ),
      'Company' => array(
        'class_name' => 'DCCompanyMigration',
        'group_name' => 'dc',
      ),
    ),
  );
  return $api;
}
