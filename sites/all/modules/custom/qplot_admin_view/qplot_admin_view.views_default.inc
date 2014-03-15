<?php
/**
 * @file
 * qplot_admin_view.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function qplot_admin_view_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'companies';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'companies';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Companies';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'role';
  $handler->display->display_options['access']['role'] = array(
    3 => '3',
  );
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['exposed_form']['options']['reset_button'] = TRUE;
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '20';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['default_row_class'] = FALSE;
  $handler->display->display_options['style_options']['row_class_special'] = FALSE;
  $handler->display->display_options['style_options']['columns'] = array(
    'title' => 'title',
    'created' => 'created',
    'field_company_address_name_line' => 'field_company_address_name_line',
    'field_company_url' => 'field_company_url',
    'edit_node' => 'edit_node',
  );
  $handler->display->display_options['style_options']['default'] = '-1';
  $handler->display->display_options['style_options']['info'] = array(
    'title' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'created' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_company_address_name_line' => array(
      'sortable' => 1,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'field_company_url' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
    'edit_node' => array(
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  /* Header: Global: Text area */
  $handler->display->display_options['header']['area']['id'] = 'area';
  $handler->display->display_options['header']['area']['table'] = 'views';
  $handler->display->display_options['header']['area']['field'] = 'area';
  $handler->display->display_options['header']['area']['empty'] = TRUE;
  $handler->display->display_options['header']['area']['format'] = 'full_html';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'Company';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Post date */
  $handler->display->display_options['fields']['created']['id'] = 'created';
  $handler->display->display_options['fields']['created']['table'] = 'node';
  $handler->display->display_options['fields']['created']['field'] = 'created';
  $handler->display->display_options['fields']['created']['date_format'] = 'custom';
  $handler->display->display_options['fields']['created']['custom_date_format'] = 'm.d.y';
  /* Field: Content: Address - Full name */
  $handler->display->display_options['fields']['field_company_address_name_line']['id'] = 'field_company_address_name_line';
  $handler->display->display_options['fields']['field_company_address_name_line']['table'] = 'field_data_field_company_address';
  $handler->display->display_options['fields']['field_company_address_name_line']['field'] = 'field_company_address_name_line';
  $handler->display->display_options['fields']['field_company_address_name_line']['label'] = 'Contact';
  $handler->display->display_options['fields']['field_company_address_name_line']['element_type'] = '0';
  $handler->display->display_options['fields']['field_company_address_name_line']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_company_address_name_line']['element_default_classes'] = FALSE;
  /* Field: Content: URL */
  $handler->display->display_options['fields']['field_company_url']['id'] = 'field_company_url';
  $handler->display->display_options['fields']['field_company_url']['table'] = 'field_data_field_company_url';
  $handler->display->display_options['fields']['field_company_url']['field'] = 'field_company_url';
  $handler->display->display_options['fields']['field_company_url']['label'] = 'Homepage';
  $handler->display->display_options['fields']['field_company_url']['element_type'] = '0';
  $handler->display->display_options['fields']['field_company_url']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_company_url']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_company_url']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_company_url']['click_sort_column'] = 'url';
  $handler->display->display_options['fields']['field_company_url']['type'] = 'link_short';
  $handler->display->display_options['fields']['field_company_url']['field_api_classes'] = TRUE;
  /* Field: Content: Edit link */
  $handler->display->display_options['fields']['edit_node']['id'] = 'edit_node';
  $handler->display->display_options['fields']['edit_node']['table'] = 'views_entity_node';
  $handler->display->display_options['fields']['edit_node']['field'] = 'edit_node';
  $handler->display->display_options['fields']['edit_node']['label'] = 'Edit';
  /* Sort criterion: Content: Updated date */
  $handler->display->display_options['sorts']['changed']['id'] = 'changed';
  $handler->display->display_options['sorts']['changed']['table'] = 'node';
  $handler->display->display_options['sorts']['changed']['field'] = 'changed';
  $handler->display->display_options['sorts']['changed']['order'] = 'DESC';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'company' => 'company',
  );
  /* Filter criterion: Content: Title */
  $handler->display->display_options['filters']['title']['id'] = 'title';
  $handler->display->display_options['filters']['title']['table'] = 'node';
  $handler->display->display_options['filters']['title']['field'] = 'title';
  $handler->display->display_options['filters']['title']['operator'] = 'word';
  $handler->display->display_options['filters']['title']['exposed'] = TRUE;
  $handler->display->display_options['filters']['title']['expose']['operator_id'] = 'title_op';
  $handler->display->display_options['filters']['title']['expose']['label'] = 'Search by name';
  $handler->display->display_options['filters']['title']['expose']['description'] = 'Company title contains';
  $handler->display->display_options['filters']['title']['expose']['operator'] = 'title_op';
  $handler->display->display_options['filters']['title']['expose']['identifier'] = 'title';
  $handler->display->display_options['filters']['title']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
  );
  /* Filter criterion: Content: Address - Full name */
  $handler->display->display_options['filters']['field_company_address_name_line']['id'] = 'field_company_address_name_line';
  $handler->display->display_options['filters']['field_company_address_name_line']['table'] = 'field_data_field_company_address';
  $handler->display->display_options['filters']['field_company_address_name_line']['field'] = 'field_company_address_name_line';
  $handler->display->display_options['filters']['field_company_address_name_line']['operator'] = 'word';
  $handler->display->display_options['filters']['field_company_address_name_line']['exposed'] = TRUE;
  $handler->display->display_options['filters']['field_company_address_name_line']['expose']['operator_id'] = 'field_company_address_name_line_op';
  $handler->display->display_options['filters']['field_company_address_name_line']['expose']['label'] = 'Search by contact';
  $handler->display->display_options['filters']['field_company_address_name_line']['expose']['description'] = 'Primary contact name contains';
  $handler->display->display_options['filters']['field_company_address_name_line']['expose']['operator'] = 'field_company_address_name_line_op';
  $handler->display->display_options['filters']['field_company_address_name_line']['expose']['identifier'] = 'field_company_address_name_line';
  $handler->display->display_options['filters']['field_company_address_name_line']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
  );

  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'page');
  $handler->display->display_options['path'] = 'companies';
  $export['companies'] = $view;

  $view = new view();
  $view->name = 'contacts';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Contacts';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['title'] = 'Contacts';
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'some';
  $handler->display->display_options['pager']['options']['items_per_page'] = '10';
  $handler->display->display_options['style_plugin'] = 'table';
  /* Header: Global: Text area */
  $handler->display->display_options['header']['area']['id'] = 'area';
  $handler->display->display_options['header']['area']['table'] = 'views';
  $handler->display->display_options['header']['area']['field'] = 'area';
  $handler->display->display_options['header']['area']['empty'] = TRUE;
  $handler->display->display_options['header']['area']['format'] = 'full_html';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Job Title */
  $handler->display->display_options['fields']['field_contact_title']['id'] = 'field_contact_title';
  $handler->display->display_options['fields']['field_contact_title']['table'] = 'field_data_field_contact_title';
  $handler->display->display_options['fields']['field_contact_title']['field'] = 'field_contact_title';
  $handler->display->display_options['fields']['field_contact_title']['element_type'] = '0';
  $handler->display->display_options['fields']['field_contact_title']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_contact_title']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_contact_title']['type'] = 'text_plain';
  $handler->display->display_options['fields']['field_contact_title']['field_api_classes'] = TRUE;
  /* Field: Content: Company */
  $handler->display->display_options['fields']['field_contact_company']['id'] = 'field_contact_company';
  $handler->display->display_options['fields']['field_contact_company']['table'] = 'field_data_field_contact_company';
  $handler->display->display_options['fields']['field_contact_company']['field'] = 'field_contact_company';
  $handler->display->display_options['fields']['field_contact_company']['element_type'] = '0';
  $handler->display->display_options['fields']['field_contact_company']['element_wrapper_type'] = '0';
  $handler->display->display_options['fields']['field_contact_company']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_contact_company']['settings'] = array(
    'link' => 0,
  );
  $handler->display->display_options['fields']['field_contact_company']['field_api_classes'] = TRUE;
  /* Field: Content: Edit link */
  $handler->display->display_options['fields']['edit_node']['id'] = 'edit_node';
  $handler->display->display_options['fields']['edit_node']['table'] = 'views_entity_node';
  $handler->display->display_options['fields']['edit_node']['field'] = 'edit_node';
  $handler->display->display_options['fields']['edit_node']['label'] = 'Edit';
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'contact' => 'contact',
  );
  /* Filter criterion: Content: Title */
  $handler->display->display_options['filters']['title']['id'] = 'title';
  $handler->display->display_options['filters']['title']['table'] = 'node';
  $handler->display->display_options['filters']['title']['field'] = 'title';
  $handler->display->display_options['filters']['title']['operator'] = 'word';
  $handler->display->display_options['filters']['title']['exposed'] = TRUE;
  $handler->display->display_options['filters']['title']['expose']['operator_id'] = 'title_op';
  $handler->display->display_options['filters']['title']['expose']['label'] = 'Name';
  $handler->display->display_options['filters']['title']['expose']['operator'] = 'title_op';
  $handler->display->display_options['filters']['title']['expose']['identifier'] = 'title';
  $handler->display->display_options['filters']['title']['expose']['remember_roles'] = array(
    2 => '2',
    1 => 0,
    3 => 0,
  );

  /* Display: Page */
  $handler = $view->new_display('page', 'Page', 'page');
  $handler->display->display_options['path'] = 'contacts';
  $handler->display->display_options['menu']['type'] = 'normal';
  $handler->display->display_options['menu']['title'] = 'Contacts';
  $handler->display->display_options['menu']['name'] = 'main-menu';
  $export['contacts'] = $view;

  return $export;
}
