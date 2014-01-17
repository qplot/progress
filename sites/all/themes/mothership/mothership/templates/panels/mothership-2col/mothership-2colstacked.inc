<?php

// Plugin definition
$plugin = array(
  'title' => t('mothership two columns'),
  'category' => t('Mothership'),
  'icon'  => 'mothership-2col.png',
  'theme' => 'mothership-2col',
  'css'   => 'mothership-2col.admin.css',
  'regions' => array(
    'top'   => t('Top'),
    'left'  => t('Left side'),
    'right' => t('Right side'),
    'bottom'=> t('Bottom')
  ),
);
