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
    ),
  );
  return $api;
}

?>