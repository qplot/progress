<?

/**
 * 
 */

function qplot_progress_block_view_main_menu(&$block) {
  global $user;
  // $profile = qplot_progress_user_profile($user->uid);

  $variables['menu'] = array(
    'home' => url(''),
    // 'user' => $profile,
    'user' => $user->uid ? (array)$user : '',
    'logout' => url('user/logout'),
  );

  // if ($profile) {
  //   $variables['menu']['logout'] = $profile['logout'];
  // }

  $block['content'] = theme('qplot_progress_main_menu', $variables);
}

function qplot_progress_block_view_front_dashboard(&$block) {
// find out all projects
  $nids = qplot_api_find_nodes2(
    array(
      'type' => 'project',
    ),
    NULL,
    TRUE,
    5
  );  
  $variables['projects'] = array();
  foreach ($nids as $id) {
    $node = node_load($id);
    $wrapper = entity_metadata_wrapper('node', $node);
    $body = $wrapper->body->value();

    $variables['projects'][] = array(
      'title' => $wrapper->title->value(),
      // 'icon' => $wrapper->field_project_icon->name->value(),
      // 'company' => $wrapper->field_project_company->title->value(),
      'description' => !empty($body) ? $wrapper->body->summary->value() : '',
      'progress' => $wrapper->field_project_progress->value(),
      // 'status' => $wrapper->field_project_status->name->value(),
      // 'view' => url('project/' . $wrapper->getIdentifier()),
    );
  }

  // find tasks
  $tnids = qplot_api_find_nodes2(
    array(
      'type' => 'task',
    ),
    array(
      'changed' => 'DESC'
    ),
    TRUE,
    5        
  );

  $variables['tasks'] = array();
  foreach ($tnids as $id) {
    $node = node_load($id);
    $wrapper = entity_metadata_wrapper('node', $node);
    $body = $wrapper->body->value();
    $user = user_load($node->uid);
    $profile = profile2_load_by_user($node->uid);
    $uwrapper = entity_metadata_wrapper('profile2', $profile['main']);

    $variables['tasks'][] = array(
      'title' => $wrapper->title->value(),
      'datetime' => date('Y-m-d G:i', $wrapper->changed->value()),
      'day' => date('l', $wrapper->changed->value()),
      'time' => date('g:i', $wrapper->changed->value()),
      'am/pm' => date('a', $wrapper->changed->value()),
      'fname' => $uwrapper->field_profile_first->value(),
      'lname' => $uwrapper->field_profile_last->value(),
      'company' => $wrapper->field_task_project->field_project_company->title->value(),
      'description' => !empty($body) ? $wrapper->body->summary->value() : '',
      'hours' => $wrapper->field_task_hours->value(),
      'progress' => $wrapper->field_task_progress->value(),
      'project' => $wrapper->field_task_project->title->value(),
      'phase' => $wrapper->field_task_phase->title->value(),
      'icon' => $wrapper->field_task_project->field_project_icon->name->value(),

    );
  }

  $block['content'] = theme('qplot_progress_front_dashboard', $variables);
}

function qplot_progress_block_view_login_full(&$block) {
  global $user;
  if (!$user->uid) {
    $form = drupal_get_form('user_login_block');
    $variables['form'] = drupal_render($form);
    $block['content'] = theme('qplot_progress_login_full', $variables);
  } else {
    $block['content'] = '';
  }  
}

function qplot_progress_block_view_company_teaser(&$block) {
  // find company info and asoociated properties
  $node = node_load(4);
  $wrapper = entity_metadata_wrapper('node', $node);
  $body = $wrapper->body->value();
  $variables['company'] = array(
    'title' => $wrapper->title->value(),
    'logo' => $wrapper->field_company_logo->file->url->value(),
    'description' => !empty($body) ? $wrapper->body->value->value() : '',
    'status' => 'Active',
    'edit' => url('node/' . $wrapper->getIdentifier() . '/edit', array(
      'query' => drupal_get_destination()
    )),
  );

  $block['content'] = theme('qplot_progress_company_teaser', $variables);
}

function qplot_progress_block_view_projects_teaser(&$block) {
  global $user;
  if (empty($user->uid)) return;

  $use_favorites = FALSE;
  if ($use_favorites) {
    // find out all favorites by the current user
    $nids = array();
    $flags = flag_get_user_flags('node');
    if (!empty($flags['favorite_projects'])) {
      $nids = array_reverse(array_keys($flags['favorite_projects']));
    }
    $variables['items'] = array();
    foreach ($nids as $id) {
      $node = node_load($id);
      $wrapper = entity_metadata_wrapper('node', $node);
      $variables['items'][] = array(
        'title' => $wrapper->title->value(),
        'icon' => $wrapper->field_project_icon->name->value(),
        'description' => $wrapper->body->summary->value(),
        'progress' => $wrapper->field_project_progress->value(),
        'status' => $wrapper->field_project_status->name->value(),
        'view' => url('project/' . $wrapper->getIdentifier()),
      );
    }        
  } else {
    $profile = qplot_progress_user_profile($user->uid);
    $variables['items'] = $profile['project'];
  }

  $block['content'] = theme('qplot_progress_projects_teaser', $variables);  
}

function qplot_progress_block_view_projects_menu(&$block) {
  global $user;
  if (empty($user->uid)) return;
  // find out all projects
  $nids = qplot_api_find_nodes(
    array('type' => 'project'),
    array(),
    TRUE,
    NULL,
    array('property' => array(
      'changed' => 'DESC'
    ))
  );
  foreach ($nids as $id) {
    $node = node_load($id);
    $wrapper = entity_metadata_wrapper('node', $node);
    $project_item = array(
      'title' => $wrapper->title->value(),
      'icon' => $wrapper->field_project_icon->name->value(),
      'company' => $wrapper->field_project_company->title->value(),
      // 'description' => $wrapper->body->summary->value(),
      'progress' => $wrapper->field_project_progress->value(),
      'status' => $wrapper->field_project_status->name->value(),
      'view' => url('project/' . $wrapper->getIdentifier()),
    );
    if (empty($project_item['company'])) {
      $project_item['company'] = 'Noname';
    }
    $variables['companies'][$project_item['company']][] = $project_item;
  }

  // $variables['companies'] = array();
  $block['content'] = theme('qplot_progress_projects_menu', $variables);
}

function qplot_progress_block_view_project_overview(&$block) {
  // $nid = 10;
  $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');

  $node = node_load($nid);
  // find project info
  $wrapper = entity_metadata_wrapper('node', $node);
  $body = $wrapper->body->value();
  $photo = $wrapper->field_project_photo->value();

  $variables['project'] = array(
    'title' => $wrapper->title->value(),
    'photo' => !empty($photo) ? $wrapper->field_project_photo->file->url->value() : '',
    'icon' => $wrapper->field_project_icon->name->value(),
    'description' => !empty($body) ? $wrapper->body->summary->value() : '',
    'progress' => $wrapper->field_project_progress->value(),
    'status' => $wrapper->field_project_status->name->value(),
    'flag' => flag_create_link('favorite_projects', $wrapper->getIdentifier()),
    'edit' => node_access('update', $node) ? url('node/' . $wrapper->getIdentifier() . '/edit', array(
      'query' => drupal_get_destination()
    )) : '',
  );

  $company = $wrapper->field_project_company->value();
  $variables['company'] = array(
    'id' => $company->nid,
    'title' => $company->title,
    'view' => url('company/' . $company->nid),
  );

  // find phases info and associate properties
  $variables['items'] = array();
  $nids = qplot_api_find_nodes2(
    array(
      'type' => 'phase',
      'field_phase_project' => array('target_id', $nid, '=')
    ),
    array(
      'changed' => 'DESC'
    ),
    TRUE, 3
  );
  foreach ($nids as $id) {
    $node = node_load($id);
    $wrapper = entity_metadata_wrapper('node', $node);
    $variables['items'][] = array(
      'title' => $wrapper->title->value(),
      'description' => ($wrapper->body->raw()) ? $wrapper->body->summary->value() : '',
      'progress' => $wrapper->field_phase_progress->value(),
    );
  }

  $block['content'] = theme('qplot_progress_project_overview', $variables);
}

function qplot_progress_block_view_project_status(&$block) {
  $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');

  $node = node_load($nid);
  $wrapper = entity_metadata_wrapper('node', $node);      
  // $comment = $wrapper->field_project_comment->value();

  $variables['project'] = array(
    'status' => $wrapper->field_project_status->name->value(),
    'hours' => $wrapper->field_project_hours->value(),
    'progress' => $wrapper->field_project_progress->value(),
    'capacity' => $wrapper->field_project_capacity->value(),
    'comment' => $wrapper->field_project_comment->value(),
  );

  $block['content'] = theme('qplot_progress_project_status', $variables);  
}

function qplot_progress_block_view_company_overview(&$block) {
  // $cid = 4;
  $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');

  // find project info
  $node = node_load($nid);
  // $wrapper = entity_metadata_wrapper('node', $node);
  // $node = $wrapper->field_project_company->value();

  // find company info
  $wrapper = entity_metadata_wrapper('node', $node);
  $body = $wrapper->body->value();
  $logo = $wrapper->field_company_logo->value();
  $variables['company'] = array(
    'title' => $wrapper->title->value(),
    'logo' => !empty($logo) ? $wrapper->field_company_logo->file->url->value() : '',
    'description' => !empty($body) ? $wrapper->body->value->raw() : '',
    'edit' => url('node/' . $wrapper->getIdentifier() . '/edit', array(
      'query' => drupal_get_destination()
    )),
  );

  // find company contacts
  $variables['contacts'] = array();
  foreach ($wrapper->field_company_contacts->getIterator() as $cwrapper) {
    $variables['contacts'][] = array(
      'name' => $cwrapper->title->value(),
      'title' => $cwrapper->field_contact_title->value(),
      'photo' => $cwrapper->field_contact_photo->file->url->value(),
      'email' => $cwrapper->field_contact_email->value(),
      'phone' => $cwrapper->field_contact_phone->value()
    );
  }

  $block['content'] = theme('qplot_progress_company_overview', $variables);
}

function qplot_progress_block_view_phases_full(&$block) {
  // $nid = 10;
  $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');
  $focus_phase = arg(3);

  // fill project info
  $node = node_load($nid);
  $wrapper = entity_metadata_wrapper('node', $node);
  $variables['project'] = array(
    'title' => $wrapper->title->value(),
    'create_phase' => node_access('create', 'phase') ? url('phase/new', array('query' => array_merge(
      array(
        'project' => $nid,
      ), drupal_get_destination()
    ))) : '',
  );
  // find phases info
  $pnids = qplot_api_find_nodes2(
    array(
      'type' => 'phase',
      'field_phase_project' => array('target_id', $nid, '='),
    ),
    array(
      'field_phase_durating' => array('value', 'ASC')
    ),
    TRUE
  );
  $variables['phases'] = array();
  foreach ($pnids as $pid) {
    $phase = node_load($pid);
    $phase_wrapper = entity_metadata_wrapper('node', $phase);
    $body = $phase_wrapper->body->value();
    $duration = $phase_wrapper->field_phase_durating->value();
    $from = new DateTime($duration['value']);
    $to = new DateTime($duration['value2']);
    // $destination = drupal_get_destination();
    $destination = array('destination' => url(
      'project/' . $nid . '/phase/' . $phase_wrapper->getIdentifier()
    ));
    $phase_item = array(
      'id' => $phase_wrapper->getIdentifier(),
      'title' => $phase_wrapper->title->value(),
      'description' => !empty($body) ? htmlspecialchars_decode($body['value']) : '',
      'from' => $from->format('m/d/Y'),
      'to' => $to->format('m/d/Y'),
      'hours' => $phase_wrapper->field_phase_hours->value(),
      'progress' => $phase_wrapper->field_phase_progress->value(),
      'status' => $phase_wrapper->field_phase_status->name->value(),
      'edit' => node_access('update', $phase) ? url('phase/' . $phase_wrapper->getIdentifier() . '/edit', array(
        'query' => array_merge(
          array('project' => $nid),
          $destination
        )
      )) : '',
      'delete' => node_access('delete', $phase) ? url('node/' . $phase_wrapper->getIdentifier() . '/delete', array(
        'query' => $destination
      )) : '',
      'create_task' => node_access('create', 'task') ? url('task/new', array('query' => array_merge(
        array(
          'phase' => $pid,
          'project' => $nid,
        ), $destination
      ))) : '',
      'tasks' => array(),
      'focus' => FALSE,
    );

    // find tasks for this phase
    $tnids = qplot_api_find_nodes2(
      array(
        'type' => 'task',
        'field_task_phase' => array('target_id', $phase_wrapper->getIdentifier(), '='),
        'field_task_project' => array('target_id', $nid, '='),
      ),
      NULL,
      TRUE
    );
    $phase_item['group'] = array();
    foreach ($tnids as $tid) {
      $node = node_load($tid);
      $wrapper = entity_metadata_wrapper('node', $node);
      $body = $wrapper->body->value();
      $url = $wrapper->field_task_url->value();
      $member_id = $wrapper->field_task_requestby->raw();
      $tag = $wrapper->field_task_tag->value();

      $task_item = array(
        'title' => $wrapper->title->value(),
        'description' => !empty($body) ? htmlspecialchars_decode($wrapper->body->value->raw()) : '',
        'phase' => $wrapper->field_task_phase->title->value(),
        'progress' => $wrapper->field_task_progress->value(),
        'hours' => $wrapper->field_task_hours->value(),
        'added' => date('m/d/y', $wrapper->field_task_added->value()),
        'ticket' => !empty($url) ? l(
          $wrapper->field_task_url->title->value(),
          $wrapper->field_task_url->url->value(),
          array('attributes' => array('target' => '_blank'))
        ) : '',
        'tag' => !empty($tag) ? $tag->name : '',
        'request_by' => ($member_id) ? qplot_progress_user_profile($member_id) : '',
        // 'edit' => url('node/' . $wrapper->getIdentifier() . '/edit', array(
        'edit' => node_access('update', $node) ? url('task/' . $wrapper->getIdentifier() . '/edit', array(
          'query' => $destination
        )) : '',
        'delete' => node_access('delete', $node) ? url('node/' . $wrapper->getIdentifier() . '/delete', array(
          'query' => $destination
        )) : '',
      );

      $phase_item['tasks'][] = $task_item;

      // group task using tag
      $group = $task_item['tag'];
      if (!$group) $group = 'Not-categorized';
      // init group
      if (empty($phase_item['group'][$group])) {
        $phase_item['group'][$group] = array(
          'tasks' => array(),
          'hours' => 0,
          'progress' => 0,
        );
      }
      $phase_item['group'][$group]['tasks'][] = count($phase_item['tasks']) - 1;
      $phase_item['group'][$group]['hours'] = $phase_item['group'][$group]['hours'] + $task_item['hours'];
      $phase_item['group'][$group]['progress'] = $phase_item['group'][$group]['progress'] + $task_item['hours'] * $task_item['progress'];
    }
    // update final progress
    foreach ($phase_item['group'] as &$g) {
      if ($g['hours']) {
        $g['progress'] = intval($g['progress'] / $g['hours']);
      } else {
        $g['progress'] = 100;
      }
    }
    // sort group
    ksort($phase_item['group'], SORT_STRING);

    // set current 
    if ($focus_phase == $phase_item['id']) {
      $phase_item['focus'] = TRUE;
    }

    $variables['phases'][] = $phase_item;
  }

  // set current phase if not set
  if (empty($focus_phase)) {
    if (!empty($variables['phases'])) {
      $variables['phases'][0]['focus'] = TRUE;
    }
  }

  $block['content'] = theme('qplot_progress_phases_full', $variables);
}

function qplot_progress_block_view_phases_table(&$block) {
  $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');

  // find projects list
  $pnids = qplot_api_find_nodes(
    array('type' => 'project'),
    array('field_project_company' => array(
      'target_id', $nid, '='
    )),
    TRUE,
    NULL,
    array('property' => array(
      'changed' => 'DESC'
    ))
  );
  $variables['projects'] = array();
  foreach ($pnids as $pid) {
    // get project info
    $project = node_load($pid);
    $project_wrapper = entity_metadata_wrapper('node', $project);
    
    // find phases list
    $phnids = qplot_api_find_nodes(
      array('type' => 'phase'),
      array('field_phase_project' => array(
        'target_id', $pid, '='
      )),
      TRUE,
      NULL,
      array('property' => array(
        'changed' => 'DESC'
      ))
    );

    $phases = array();
    foreach ($phnids as $phid) {
      $phase = node_load($phid);
      $phase_wrapper = entity_metadata_wrapper('node', $phase);
      $duration = $phase_wrapper->field_phase_durating->value();
      $from = new DateTime($duration['value']);
      $to = new DateTime($duration['value2']);

      $phases[] = array(
        'title' => $phase_wrapper->title->value(),
        'progress' => $phase_wrapper->field_phase_progress->value(),
        'from' => $from->format('H j'),
        'to' => $to->format('F j'),
        'hours' => $phase_wrapper->field_phase_hours->value(),
        'view' => url('project/' . $pid),
        'edit' => url('phase/' . $phase_wrapper->getIdentifier() . '/edit', array(
          'query' => array_merge(
            array('project' => $pid),
            drupal_get_destination()
          )
        )),
        'delete' => url('node/' . $phase_wrapper->getIdentifier() . '/delete', array(
          'query' => drupal_get_destination()
        )),
      );
    }
    $variables['projects'][] = array(
      'id' => $pid,
      'title' => $project_wrapper->title->value(),
      'icon' => $project_wrapper->field_project_icon->name->value(),
      'phases' => $phases,
      'create_phase' => url('phase/new', array('query' => array_merge(
        array(
          'project' => $pid,
        ), drupal_get_destination()
      ))),
    );
  }

  $block['content'] = theme('qplot_progress_phases_table', $variables);
}

function qplot_progress_block_view_tasks_table(&$block) {
  // find tasks of one phase for now
  $variables['tasks'] = array();
  $tnids = qplot_api_find_nodes(
    array('type' => 'task'),
    array('field_task_phase' => array(
      'target_id', 16, '='
    )),
    TRUE
  );
  foreach ($tnids as $tid) {
    $node = node_load($tid);
    $wrapper = entity_metadata_wrapper('node', $node);
    $variables['tasks'][] = array(
      'title' => $wrapper->title->value(),
      // 'description' => $wrapper->body->value()->value(),
      'phase' => $wrapper->field_task_phase->title->value(),
      'progress' => $wrapper->field_task_progress->value(),
      'hours' => $wrapper->field_task_hours->value(),
      'added' => date('m/d/y', $wrapper->field_task_added->value()),
      'edit' => url('node/' . $wrapper->getIdentifier() . '/edit', array(
        'query' => drupal_get_destination()
      )),
    );
  }

  $block['content'] = theme('qplot_progress_tasks_table', $variables);
}

function qplot_progress_block_view_members_list(&$block) {
 $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');

  // find project info
  $node = node_load($nid);
  // $wrapper = entity_metadata_wrapper('node', $node);
  // $node = $wrapper->field_project_company->value();

  // find company info
  $cwrapper = entity_metadata_wrapper('node', $node);
  $icon = $cwrapper->field_company_icon->value();

  // find members list
  $uids = qplot_api_find_nodes(
    NULL,
    array('og_user_node' => array(
      'target_id', $cwrapper->getIdentifier(), '='
    )),
    TRUE,
    array('entity_type' => 'user')
  );
  $variables['members'] = array();
  foreach ($uids as $uid) {
    $profile = profile2_load_by_user($uid);
    // dsm($profile);
    $wrapper = entity_metadata_wrapper('profile2', $profile['main']);
    $photo = $wrapper->field_profile_photo->value();

    $variables['members'][] = array(
      'id' => $uid,
      'first' => $wrapper->field_profile_first->value(),
      'last' => $wrapper->field_profile_last->value(),
      'title' => $wrapper->field_profile_title->value(),
      'photo' => !empty($photo) ? $wrapper->field_profile_photo->file->url->value() : '',
      'icon' => !empty($icon) ? $cwrapper->field_company_icon->file->url->value() : '',
    );
  }

  $block['content'] = theme('qplot_progress_members_list', $variables);
}

function qplot_progress_block_view_project_members(&$block) {
  $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');
  $node = node_load($nid);

  // find project info
  $variables['project'] = array(
    'invite' => node_access('create', 'project') ? url("group/node/$nid/admin/people/add-user", array(
      'query' => drupal_get_destination()
    )) : '',
    'manage' => node_access('create', 'project') ? url("group/node/$nid/admin/people") : '',
  );

  $variables['members'] = qplot_progress_project_members($nid);
  $block['content'] = theme('qplot_progress_project_members', $variables);
}

function qplot_progress_block_view_projects_full(&$block) {

  $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');

  // find company info
  $node = node_load($nid);
  $wrapper = entity_metadata_wrapper('node', $node);
  $variables['company'] = array(
    'id' => $nid,
    'title' => $wrapper->title->value(),
    'create_project' => url('project/new', array('query' => array_merge(
      array(
        'company' => $nid,
      ), drupal_get_destination()
    ))),
  );

  // find projects list
  $pnids = qplot_api_find_nodes(
    array('type' => 'project'),
    array('field_project_company' => array(
      'target_id', $nid, '='
    )),
    TRUE,
    NULL,
    array('property' => array(
      'changed' => 'DESC'
    ))
  );
  $variables['projects'] = array();
  foreach ($pnids as $pid) {
    $project = node_load($pid);
    $project_wrapper = entity_metadata_wrapper('node', $project);
    $body = $project_wrapper->body->value();

    $variables['projects'][] = array(
      'title' => $project_wrapper->title->value(),
      'created' => date('F j, Y', $project_wrapper->created->value()),
      'icon' => $project_wrapper->field_project_icon->name->value(),
      'description' => !empty($body) ? $project_wrapper->body->summary->value() : '',
      'progress' => $project_wrapper->field_project_progress->value(),
      'status' => $project_wrapper->field_project_status->name->value(),
      'capacity' => $project_wrapper->field_project_capacity->value(),
      'view' => url('project/' . $project_wrapper->getIdentifier()),
      'edit' => url('project/' . $project_wrapper->getIdentifier() . '/edit', array(
        'query' => array_merge(
          array('company' => $nid),
          drupal_get_destination()
        )
      )),
      'delete' => url('node/' . $project_wrapper->getIdentifier() . '/delete', array(
        'query' => drupal_get_destination()
      )),
    );
  }

  $block['content'] = theme('qplot_progress_projects_full', $variables);
}

function qplot_progress_block_view_content_list(&$block) {
  $nid = arg(1);
  if (empty($nid) || !is_numeric($nid)) return array('content' => '');

  // find contents
  $ids = qplot_api_find_nodes(
    array('type' => 'content'),
    array('field_content_project' => array(
      'target_id', $nid, '='
    )),
    TRUE,
    NULL,
    array('property' => array(
      'created' => 'ASC'
    ))
  );

  $variables['content'] = array();
  foreach ($ids as $id) {
    $node = node_load($id);
    $variables['content'][] = array(
      'title' => $node->title,
      'edit' => url('node/' . $id . '/edit', array(
        'query' => array_merge(
          array('field_content_project' => $id),
          drupal_get_destination()
        )
      )),          
    );
  }

  $project = node_load($nid);
  $wrapper = entity_metadata_wrapper('node', $project);
  $variables['pages'] = array();
  foreach ($wrapper->field_project_pages->getIterator() as $term) {
    $variables['pages'][] = array(
      'title' => $term->name->value(),
    );
  }

  $variables['project'] = array(
    'create_content' => node_access('create', 'project') ? url('node/add/content', array('query' => array_merge(
      array(
        'field_content_project' => $nid,
      ), drupal_get_destination()
    ))) : '',
  );

  $block['content'] = theme('qplot_progress_content_list', $variables);
}

function qplot_progress_block_view_project_list(&$block) {
  // find out all projects
  $nids = qplot_api_find_nodes2(
    array(
      'type' => 'project',
    ),
    NULL,
    TRUE        
  );
  $variables['projects'] = array();
  foreach ($nids as $id) {
    $node = node_load($id);
    $wrapper = entity_metadata_wrapper('node', $node);
    $body = $wrapper->body->value();

    $variables['projects'][] = array(
      'title' => $wrapper->title->value(),
      // 'icon' => $wrapper->field_project_icon->name->value(),
      // 'company' => $wrapper->field_project_company->title->value(),
      'description' => !empty($body) ? $wrapper->body->summary->value() : '',
      'progress' => $wrapper->field_project_progress->value(),
      // 'status' => $wrapper->field_project_status->name->value(),
      // 'view' => url('project/' . $wrapper->getIdentifier()),
    );
  }

  $block['content'] = theme('qplot_progress_project_list', $variables);
}