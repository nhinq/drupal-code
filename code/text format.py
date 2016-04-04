<?php
/**
 * @file
 * Drupal needs this blank file.
 */

function cmicnt_init() {
  drupal_add_js(drupal_get_path('module', 'cmicnt') . '/jquery.validate.js'); 
  drupal_add_js(drupal_get_path('module', 'cmicnt') . '/jquery.cmicnt.js');   
  drupal_add_js(drupal_get_path('module', 'cmicnt') . '/ajax.cmicnt.js');  
  drupal_add_css(drupal_get_path('module', 'cmicnt') . '/cmicnt.css');
 	drupal_add_css(drupal_get_path('module', 'cmicnt') .'/fancybox/jquery.fancybox-1.3.4.css');
  drupal_add_js(drupal_get_path('module', 'cmicnt') .'/fancybox/jquery.fancybox-1.3.4.pack.js');
}

function cmicnt_overlay_paths_alter(&$paths) {
  // All user pages should appear in the overlay.
  $paths['user'] = TRUE;
  $paths['user/*'] = TRUE;
  $paths['user/*/edit'] = FALSE;
}

function cmicnt_menu() {
  $items = array();

  // config section
  $items['admin/config/cmicnt'] = array(
    'title' => t('CMIS'),
    'description' => t('Report download file'),
    'page callback' => 'cmicnt_admin_links',
    'access arguments' => array('access content overview'),
    'type' => MENU_NORMAL_ITEM,
  );
  
  $items['admin/config/cmicnt/config'] = array(
    'title' => t('CMI Config'),
    'description' => t('Provides download specific protected documents on a web site.'),
    'page callback' => 'drupal_get_form',
    'page arguments' => array('cmicnt_config_form'),
    'access arguments' => array('access content overview'),
    'type' => MENU_NORMAL_ITEM,
  );
  
  $items['admin/config/cmicnt/report'] = array(
    'title' => t('CMI Report'),
    'description' => t('Report download file'),
    'page callback' => 'cmicnt_viewreport',
    'access arguments' => array('access content overview'),
    'type' => MENU_NORMAL_ITEM,
  );
  
  $items['admin/config/cmicnt/report/cmi-csv'] = array(
    'title' => t('CMI csv'),
    'page callback' => 'cmicnt_export_csv',
    'access arguments' => array('access content overview'),
    'type' => MENU_NORMAL_ITEM,
  );

  
  return $items;
}


function cmicnt_block_info() {

  // Block with three links (login, register, restore password).
  $blocks['cmicnt_login_block'] = array(
    'info' => t('Popup Login'),
    'cache' => DRUPAL_CACHE_GLOBAL,
  );

  return $blocks;
}

/**
 * Implements hook_block_configure().
 */
function cmicnt_block_configure($delta = '') {
  
  $links = array(
     '0' => array( 'title' => t('Request new password'), 'href' => 'user/password'),
     '1' => array( 'title' => ('I want to create an account'), 'href' => 'user/register' ),
    );
  $user_link = theme_links(array('links' => $links, 'attributes' => array('class'=>'user-login'), 'heading' => ''));  
  $popup_header  = variable_get('cmicntloginblock_popup_header_'  . $delta, $user_link);
  $popup_footer  = variable_get('cmicntloginblock_popup_footer_'  . $delta, 'Chouinard & Myhre, Inc.');

  $form['cmicntloginblock_popup_header_' . $delta] = array(
    '#type' => 'text_format',
    '#title' => t('CMi Login Popup Header'),
    '#default_value' => $popup_header['value'],
    '#description' => t('Entering text for a header'),
    '#format' => $popup_header['format'],
   
  );
  
  $form['cmicntloginblock_popup_footer_' . $delta] = array(
    '#type' => 'text_format',
    '#title' => t('CMi Login Popup Footer'),
    '#default_value' => $popup_footer['value'],
    '#description' => t('Entering text for a footer'), 
    '#format' => $popup_footer['format'],   
    
  );
  
  return $form;
}

/**
 * Implements hook_block_save().
 */
function cmicnt_block_save($delta = '', $edit = array()) {
  variable_set('cmicntloginblock_popup_header_'  . $delta, $edit['cmicntloginblock_popup_header_' . $delta]);
  variable_set('cmicntloginblock_popup_footer_'   . $delta, $edit['cmicntloginblock_popup_footer_' . $delta]);
}


/**
 * Implements hook_block_view().
 */
function cmicnt_block_view($delta = '') {
  $links = array(
     '0' => array( 'title' => t('Request new password'), 'href' => 'user/password'),
     '1' => array( 'title' => ('I want to create an account'), 'href' => 'user/register' ),
    );
  $user_link = theme_links(array('links' => $links, 'attributes' => array('class'=>'user-login'), 'heading' => ''));  
  $popup_header  = variable_get('cmicntloginblock_popup_header_'  . $delta, $user_link);
  $popup_footer  = variable_get('cmicntloginblock_popup_footer_'  . $delta, 'Chouinard & Myhre, Inc.');
  $popup_header = '<div class="popups popup-header">'.$popup_header['value'].'</div>';
  $popup_footer = '<div class="popups popup-footer">'.$popup_footer['value'].'</div>';
  // Show links only to anonymous users.
  if (user_is_anonymous()) {
    
    $block['content'] = '<div id="cmi-login">'.$popup_header.drupal_render(drupal_get_form('user_login')).$popup_footer.'</div>';

    return $block;
  }
}


//Implementation of hook_form_alter()
function cmicnt_form_alter(&$form, &$form_state, $form_id) {
    if($form_id == 'user_login') {
    
    $destination = $_GET['q'];
    $form['destination'] = array(
            '#type' => 'hidden',
            '#value' => $destination,
          );
         
    $form['#submit'][] = '_cmicnt_perform_submit';
   
    }
    
}
/**
 * Sets shutdown function to perform redirects later.
 */
function _cmicnt_perform_submit(&$form, &$form_state) {
  if (isset($form_state['values']['destination'])) { 
    $destination = check_plain(filter_xss($form_state['values']['destination']));
    drupal_register_shutdown_function('_cmicnt_perform_redirect', $destination);
    
  }
}

/**
 * Perform redirects.
 */
function _cmicnt_perform_redirect($destination) {
  drupal_goto(url($destination), array('external' => TRUE));
}


function cmicnt_post_render($html, $build) {

  $html = _filter_cmicnt($html);
  return $html;
}

/**
 * Parse whole node data and filter valid anchor tags
 */
function _filter_cmicnt($text) {
 
  // 1. cross-platform line breaks to UNIX line breaks
  $text = str_replace(array("\r\n", "\r"), "\n", $text);     
  // 2. convert anchor tag
  $text = preg_replace('/(<a.*?>)(.*?)(<\/a>)/ise', "_cmicnt_replace_anchor_url('$0', '$1', '$2', '$3')", $text);

  return $text;
}

function _cmicnt_replace_anchor_url($all, $str1, $str2, $str3) {

  global $user;
  $save_history = variable_get('pubdlcnt_save_history', 1);

  $all   = str_replace('\"','"',$all);
  $str1  = str_replace('\"','"',$str1); 
  $str2  = str_replace('\"','"',$str2); 
  $str3  = str_replace('\"','"',$str3); 

  // if (preg_match('/\s*?rel=["\']lightbox.*["\']/i', $str1)) {
  if (preg_match('/\s*?rel=["\'](lightbox|thickbox|shadowbox).*["\']/i', $str1)) {
    // skip lightbox handled image file anchor tag
    return $all;
   
  }

  preg_match('/(<a.*?href=["\'])(.*?)(["\'].*?>)/ise', $str1, $matches);


  if(!isset($matches[2])) {
    return $all;   // e.g: <a id="XXXX"></a>
  }

  // extract file name and file extension from the URL
  $path = explode("?", $matches[2]);
  if (isset($path[1])) {
    // URL has query string -- skip conversion
    return $all;
  }
  if (preg_match('/\/$/', $matches[2])) {
    // URL does not has file name (URL end with /)
    return $all;
  }
  if (strstr($matches[2], "/system/files")) {
    // anchor to a file under private file system
    return $all;
  }

  $filename = basename($matches[2]);

  $extension = explode(".", $filename);
  $num = count($extension);
  if ($num > 1) {
    $ext = $extension[$num-1];
  }
  else {
    // No extension
    return $all;
  }

  $valid_extensions = variable_get('cmicnt_valid_extensions', 'mp3 wmv pdf doc docx xls xlsx csv tar zip');

  // check if the extension is a valid extension or not (case insensitive)
  $s_valid_extensions = strtolower($valid_extensions);
  $s_ext = strtolower($ext);
  $s_valid_ext_array = explode(" ", $s_valid_extensions);
  if (!in_array($s_ext, $s_valid_ext_array)) {
    return $all;
  }
  
  $uid = $user->uid;
  $matches[2] = base_path() . drupal_get_path('module', 'cmicnt') .
          "/cmicnt.php?file=/$matches[2]&uid=$uid";

  $out = $matches[1] . $matches[2] . $matches[3] . $str2.'</a>';

  return $out;  
}
/**
 * Implements hook_node_view_alter().
 */
function cmicnt_node_view_alter(&$build) {

  $nodenid = $build['#node']->nid;
  
  $supported_nodenid = variable_get('cmicnt_supported_nodenids', array());
  
  if(!empty($supported_nodenid)){
   $supported_nodenids = explode(' ', $supported_nodenid);
   $supported_nodenid_all = array();   
    if(is_array($supported_nodenids)){
      foreach ($supported_nodenids as $value) {
        $supported_nodenid_all[$value] = $value;    
      }
    }
    
  }

  if ($nodenid == $supported_nodenid || !empty($supported_nodenid_all[$nodenid])) {
    if($build['#view_mode'] == 'full' || $build['#view_mode'] == 'teaser') {
      // we count only the download for the full/teaser mode of the supported node types.
      $build['#post_render'][] = 'cmicnt_post_render';
    }
  }
}

function cmicnt_admin_links() {
    $links = array(
     '0' => array( 'title' => t('CMI Config'), 'href' => 'admin/config/cmicnt/config' ),
     '1' => array( 'title' => ('CMI Report'), 'href' => 'admin/config/cmicnt/report' ),
    );
   return  theme_links(array('links' => $links, 'attributes' => array('class'=>''), 'heading' => ''));
   
}
//cmicnt

function cmicnt_viewreport() {
  $output = '';
  $header = array(
    array('data' => t('Latest down'), 'field' => 'utime', 'sort' => 'desc'),
    array('data' => t('Name'), 'field' => 'name'),
    array('data' => t('Url')),
    array('data' => t('User')),
    array('data' => t('Count'), 'field' => 'count'),
  );

  
  $query = db_select('cmicnt', 'c')
    ->condition('c.fid',0, '<>')
    ->extend('TableSort');
                          
  $query->fields('c', array('fid', 'uid', 'utime', 'name', 'url', 'count'));

  $query->orderBy('c.utime', 'DESC');//ORDER BY created
  $cmicnt_pager = variable_get('cmicnt_pager', 20);
  $query = $query->extend('PagerDefault')->limit($cmicnt_pager);
  $result = $query
    ->orderByHeader($header)                           
    ->execute();
  
  $rows = array();
  foreach ($result as $record) {
    $user = user_load($record->uid);
    $row = array(format_date($record->utime, 'custom', 'd M Y'), $record->name, $record->url, l($user->name, 'user/'.$user->uid), $record->count);
    $rows[] = array('data' => (array) $row);
  }

  // build the table for the nice output.
  $build['tablesort_table'] = array(
    '#theme' => 'table',
    '#header' => $header,
    '#rows' => $rows,
  );
  $build['pager_pager'] = array('#theme' => 'pager');
  $output .= render($build);
  $output .= l('CMi CSV', 'admin/config/cmicnt/report/cmi-csv');
  return $output;
}

function cmicnt_config_form() {

  $form['cmicnt_supported_nodenids'] = array(
    '#type' => 'textfield',
    '#title' => t('Supported node nid'),
    '#default_value' => variable_get('cmicnt_supported_nodenids', array()),
    '#description' => t('Node nid with a space . If none of them are enter, all node nid will be supported.'),
  );
  
  $valid_extensions = variable_get('cmicnt_valid_extensions', 'mp3 wmv pdf doc docx xls xlsx csv tar zip');

  $form['cmicnt_valid_extensions'] = array(
    '#type' => 'textfield',
    '#title' => t('Valid file name extensions'),
    '#default_value' => $valid_extensions,
    '#size' => 100,
    '#maxlength' => 255,
    '#description' => t('Separate extensions with a space and do not include the leading dot.'),
  );
  $cmicnt_pager = variable_get('cmicnt_pager', 20);
  $form['cmicnt_pager'] = array(
    '#type' => 'textfield',
    '#title' => t('Pager for report'),
    '#default_value' => $cmicnt_pager,
    '#size' => 50,
    '#maxlength' => 105,
  );
  $form['cmicnt_popup_login'] = array(
    '#prefix' => '<div class="configure-login"><b>'.t('Block Popup login config'). ': </b>' .l('configure','admin/structure/block/manage/cmicnt/cmicnt_login_block/configure').'</div>',
  );
  
  
  $form['#submit'][] = 'cmicnt_config_form_submit';
  
  return system_settings_form($form);
}

function cmicnt_config_form_submit($form, &$form_state) {
    variable_set('cmicnt_supported_nodenids', $form_state['values']['cmicnt_supported_nodenids']);
    variable_set('cmicnt_valid_extensions', $form_state['values']['cmicnt_valid_extensions']);
    variable_set('cmicnt_pager', $form_state['values']['cmicnt_pager']);
    
}


if(preg_match('/cmi-csv/', $_GET['q'])){
      cmicnt_export_csv();
}

function cmicnt_export_csv(){
  global $base_url;
  $data = array();
     
  $query = db_select('cmicnt', 'c')
    ->condition('c.fid',0, '<>');
                          
  $query->fields('c', array('fid', 'uid', 'utime', 'name', 'url', 'count'));
  $query->orderBy('c.utime', 'DESC');//ORDER BY created
  $result = $query->execute();

   foreach ($result as $record) {
    $user_link = $base_url.'user/'.$record->uid;
    $data[] = array(format_date($record->utime, 'custom', 'd M Y'), $record->name, $record->url, $user_link, $record->count);
   }
    
  $filename = 'cmi-'.date('D-d-F-Y').'.csv';
  
  $datas = array_merge(array(array("Latest down", "Name", "Url", "User", "Count")),$data);
  $out = '';
  foreach ($datas as $field) {   

      $out .= "$field[0], $field[1], $field[2], $field[3], $field[4]";
      $out .= "\n";
  }
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Length: " . strlen($out));
    header("Content-type: text/x-csv");
    header("Content-Disposition: attachment; filename=$filename");
    echo $out;
    exit;

}


