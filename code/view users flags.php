$view = new view();
$view->name = 'flag_bookmarks_tab';
$view->description = 'Provides a tab on all users\' profile pages containing bookmarks for that user.';
$view->tag = 'flag';
$view->base_table = 'node';
$view->human_name = '';
$view->core = 0;
$view->api_version = '3.0';
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

/* Display: Defaults */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->display->display_options['title'] = 'User Follows';
$handler->display->display_options['use_more_always'] = FALSE;
$handler->display->display_options['access']['type'] = 'perm';
$handler->display->display_options['access']['perm'] = 'flag bookmarks';
$handler->display->display_options['cache']['type'] = 'none';
$handler->display->display_options['query']['type'] = 'views_query';
$handler->display->display_options['query']['options']['distinct'] = TRUE;
$handler->display->display_options['exposed_form']['type'] = 'basic';
$handler->display->display_options['pager']['type'] = 'none';
$handler->display->display_options['style_plugin'] = 'table_megarows';
$handler->display->display_options['style_options']['grouping'] = array(
  0 => array(
    'field' => 'title',
    'rendered' => 1,
    'rendered_strip' => 0,
  ),
);
$handler->display->display_options['style_options']['columns'] = array(
  'type' => 'title',
  'name_1' => 'title',
  'count' => 'title',
  'title' => 'title',
);
$handler->display->display_options['style_options']['default'] = '-1';
$handler->display->display_options['style_options']['info'] = array(
  'type' => array(
    'sortable' => 0,
    'default_sort_order' => 'asc',
    'align' => '',
    'separator' => '',
    'empty_column' => 0,
  ),
  'name_1' => array(
    'sortable' => 0,
    'default_sort_order' => 'asc',
    'align' => '',
    'separator' => '',
    'empty_column' => 0,
  ),
  'count' => array(
    'sortable' => 0,
    'default_sort_order' => 'asc',
    'align' => '',
    'separator' => '',
    'empty_column' => 0,
  ),
  'title' => array(
    'sortable' => 0,
    'default_sort_order' => 'asc',
    'align' => '',
    'separator' => '',
    'empty_column' => 0,
  ),
);
$handler->display->display_options['style_options']['scroll_padding'] = '120';
$handler->display->display_options['row_plugin'] = 'fields';
/* No results behavior: Global: Text area */
$handler->display->display_options['empty']['text']['id'] = 'area';
$handler->display->display_options['empty']['text']['table'] = 'views';
$handler->display->display_options['empty']['text']['field'] = 'area';
$handler->display->display_options['empty']['text']['content'] = 'This user has not yet bookmarked any content.';
$handler->display->display_options['empty']['text']['format'] = 'plain_text';
/* Relationship: Flags: bookmarks */
$handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
$handler->display->display_options['relationships']['flag_content_rel']['table'] = 'node';
$handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
$handler->display->display_options['relationships']['flag_content_rel']['label'] = 'bookmarks';
$handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'bookmarks';
$handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
/* Relationship: Content: Author */
$handler->display->display_options['relationships']['uid_1']['id'] = 'uid_1';
$handler->display->display_options['relationships']['uid_1']['table'] = 'node';
$handler->display->display_options['relationships']['uid_1']['field'] = 'uid';
/* Relationship: Flags: User */
$handler->display->display_options['relationships']['uid']['id'] = 'uid';
$handler->display->display_options['relationships']['uid']['table'] = 'flagging';
$handler->display->display_options['relationships']['uid']['field'] = 'uid';
$handler->display->display_options['relationships']['uid']['relationship'] = 'flag_content_rel';
$handler->display->display_options['relationships']['uid']['label'] = 'bookmarks_user';
$handler->display->display_options['relationships']['uid']['required'] = TRUE;
/* Field: Content: Type */
$handler->display->display_options['fields']['type']['id'] = 'type';
$handler->display->display_options['fields']['type']['table'] = 'node';
$handler->display->display_options['fields']['type']['field'] = 'type';
/* Field: Content: Title */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
/* Field: User: Name */
$handler->display->display_options['fields']['name']['id'] = 'name';
$handler->display->display_options['fields']['name']['table'] = 'users';
$handler->display->display_options['fields']['name']['field'] = 'name';
$handler->display->display_options['fields']['name']['relationship'] = 'uid_1';
$handler->display->display_options['fields']['name']['label'] = 'Author';
/* Field: Content: Comment count */
$handler->display->display_options['fields']['comment_count']['id'] = 'comment_count';
$handler->display->display_options['fields']['comment_count']['table'] = 'node_comment_statistics';
$handler->display->display_options['fields']['comment_count']['field'] = 'comment_count';
$handler->display->display_options['fields']['comment_count']['label'] = 'Replies';
/* Field: Content: Last comment time */
$handler->display->display_options['fields']['last_comment_timestamp']['id'] = 'last_comment_timestamp';
$handler->display->display_options['fields']['last_comment_timestamp']['table'] = 'node_comment_statistics';
$handler->display->display_options['fields']['last_comment_timestamp']['field'] = 'last_comment_timestamp';
$handler->display->display_options['fields']['last_comment_timestamp']['label'] = 'Last Post';
/* Sort criterion: Flags: Flagged time */
$handler->display->display_options['sorts']['timestamp']['id'] = 'timestamp';
$handler->display->display_options['sorts']['timestamp']['table'] = 'flagging';
$handler->display->display_options['sorts']['timestamp']['field'] = 'timestamp';
$handler->display->display_options['sorts']['timestamp']['relationship'] = 'flag_content_rel';
$handler->display->display_options['sorts']['timestamp']['order'] = 'DESC';
/* Contextual filter: User: Uid */
$handler->display->display_options['arguments']['uid']['id'] = 'uid';
$handler->display->display_options['arguments']['uid']['table'] = 'users';
$handler->display->display_options['arguments']['uid']['field'] = 'uid';
$handler->display->display_options['arguments']['uid']['relationship'] = 'uid';
$handler->display->display_options['arguments']['uid']['default_action'] = 'empty';
$handler->display->display_options['arguments']['uid']['exception']['title_enable'] = TRUE;
$handler->display->display_options['arguments']['uid']['title_enable'] = TRUE;
$handler->display->display_options['arguments']['uid']['title'] = '%1\'s bookmarks';
$handler->display->display_options['arguments']['uid']['default_argument_type'] = 'fixed';
$handler->display->display_options['arguments']['uid']['summary']['format'] = 'default_summary';
$handler->display->display_options['arguments']['uid']['specify_validation'] = TRUE;
/* Filter criterion: Content: Published */
$handler->display->display_options['filters']['status']['id'] = 'status';
$handler->display->display_options['filters']['status']['table'] = 'node';
$handler->display->display_options['filters']['status']['field'] = 'status';
$handler->display->display_options['filters']['status']['value'] = 1;
$handler->display->display_options['filters']['status']['group'] = '0';
$handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
/* Filter criterion: Content: Type */
$handler->display->display_options['filters']['type']['id'] = 'type';
$handler->display->display_options['filters']['type']['table'] = 'node';
$handler->display->display_options['filters']['type']['field'] = 'type';
$handler->display->display_options['filters']['type']['value'] = array(
  'project' => 'project',
);

/* Display: Page */
$handler = $view->new_display('page', 'Page', 'page');
$handler->display->display_options['path'] = 'user/%/bookmarks';
$handler->display->display_options['menu']['type'] = 'tab';
$handler->display->display_options['menu']['title'] = 'Bookmarks';
$handler->display->display_options['menu']['weight'] = '0';

/* Display: Page */
$handler = $view->new_display('page', 'Page', 'page_1');
$handler->display->display_options['defaults']['relationships'] = FALSE;
/* Relationship: Flags: follow_this_project */
$handler->display->display_options['relationships']['flag_content_rel']['id'] = 'flag_content_rel';
$handler->display->display_options['relationships']['flag_content_rel']['table'] = 'node';
$handler->display->display_options['relationships']['flag_content_rel']['field'] = 'flag_content_rel';
$handler->display->display_options['relationships']['flag_content_rel']['label'] = 'follows';
$handler->display->display_options['relationships']['flag_content_rel']['flag'] = 'follow_this_project';
$handler->display->display_options['relationships']['flag_content_rel']['user_scope'] = 'any';
/* Relationship: Content: Author */
$handler->display->display_options['relationships']['uid_1']['id'] = 'uid_1';
$handler->display->display_options['relationships']['uid_1']['table'] = 'node';
$handler->display->display_options['relationships']['uid_1']['field'] = 'uid';
/* Relationship: Flags: User */
$handler->display->display_options['relationships']['uid']['id'] = 'uid';
$handler->display->display_options['relationships']['uid']['table'] = 'flagging';
$handler->display->display_options['relationships']['uid']['field'] = 'uid';
$handler->display->display_options['relationships']['uid']['relationship'] = 'flag_content_rel';
$handler->display->display_options['relationships']['uid']['label'] = 'follow_user';
$handler->display->display_options['relationships']['uid']['required'] = TRUE;
/* Relationship: Flags: follow_this_project counter */
$handler->display->display_options['relationships']['flag_count_rel']['id'] = 'flag_count_rel';
$handler->display->display_options['relationships']['flag_count_rel']['table'] = 'node';
$handler->display->display_options['relationships']['flag_count_rel']['field'] = 'flag_count_rel';
$handler->display->display_options['relationships']['flag_count_rel']['flag'] = 'follow_this_project';
$handler->display->display_options['defaults']['fields'] = FALSE;
/* Field: User: Name */
$handler->display->display_options['fields']['name_1']['id'] = 'name_1';
$handler->display->display_options['fields']['name_1']['table'] = 'users';
$handler->display->display_options['fields']['name_1']['field'] = 'name';
$handler->display->display_options['fields']['name_1']['relationship'] = 'uid';
$handler->display->display_options['fields']['name_1']['label'] = 'Follower';
/* Field: Flags: Flag counter */
$handler->display->display_options['fields']['count']['id'] = 'count';
$handler->display->display_options['fields']['count']['table'] = 'flag_counts';
$handler->display->display_options['fields']['count']['field'] = 'count';
$handler->display->display_options['fields']['count']['relationship'] = 'flag_count_rel';
$handler->display->display_options['fields']['count']['label'] = 'Follow';
$handler->display->display_options['fields']['count']['exclude'] = TRUE;
/* Field: Content: Title */
$handler->display->display_options['fields']['title']['id'] = 'title';
$handler->display->display_options['fields']['title']['table'] = 'node';
$handler->display->display_options['fields']['title']['field'] = 'title';
$handler->display->display_options['fields']['title']['label'] = 'Project';
$handler->display->display_options['fields']['title']['exclude'] = TRUE;
$handler->display->display_options['fields']['title']['alter']['alter_text'] = TRUE;
$handler->display->display_options['fields']['title']['alter']['text'] = '[title] ([count] follow)';
$handler->display->display_options['fields']['title']['link_to_node'] = FALSE;
/* Field: Content: Nid */
$handler->display->display_options['fields']['nid']['id'] = 'nid';
$handler->display->display_options['fields']['nid']['table'] = 'node';
$handler->display->display_options['fields']['nid']['field'] = 'nid';
$handler->display->display_options['fields']['nid']['label'] = '';
$handler->display->display_options['fields']['nid']['exclude'] = TRUE;
$handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
/* Field: User: Uid */
$handler->display->display_options['fields']['uid']['id'] = 'uid';
$handler->display->display_options['fields']['uid']['table'] = 'users';
$handler->display->display_options['fields']['uid']['field'] = 'uid';
$handler->display->display_options['fields']['uid']['relationship'] = 'uid';
$handler->display->display_options['fields']['uid']['label'] = '';
$handler->display->display_options['fields']['uid']['alter']['alter_text'] = TRUE;
$handler->display->display_options['fields']['uid']['alter']['text'] = 'unfollow';
$handler->display->display_options['fields']['uid']['alter']['make_link'] = TRUE;
$handler->display->display_options['fields']['uid']['alter']['path'] = 'admin/unfollow/[nid]/[uid]';
$handler->display->display_options['fields']['uid']['alter']['absolute'] = TRUE;
$handler->display->display_options['fields']['uid']['alter']['alt'] = 'unfollow';
$handler->display->display_options['fields']['uid']['alter']['link_class'] = 'btn';
$handler->display->display_options['fields']['uid']['element_label_colon'] = FALSE;
$handler->display->display_options['fields']['uid']['link_to_user'] = FALSE;
$handler->display->display_options['defaults']['arguments'] = FALSE;
$handler->display->display_options['qtip_instance'] = '';
$handler->display->display_options['path'] = 'user_follows';
$handler->display->display_options['menu']['type'] = 'tab';
$handler->display->display_options['menu']['title'] = 'Bookmarks';
$handler->display->display_options['menu']['weight'] = '0';
