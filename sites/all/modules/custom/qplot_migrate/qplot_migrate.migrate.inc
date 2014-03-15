<?php

function qplot_migrate_migrate_api() {
  $api = array(
    'api' => 2,
    'groups' => array(
      'dh' => array(
        'title' => t('DH AC'),
      ),
    ),
    'migrations' => array(
      'Project' => array(
        'class_name' => 'DHProjectMigration',
        'group_name' => 'dh',
      ),
      'Company' => array(
        'class_name' => 'DHCompanyMigration',
        'group_name' => 'dh',
      ),
      'Task' => array(
        'class_name' => 'DHTaskMigration',
        'group_name' => 'dh',
      ),
    ),
  );
  return $api;
}

?>