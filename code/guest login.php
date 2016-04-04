<?php

/**
 * @author Nhinguyen
 * @copyright 2014
 */

function _custom_guest_login($mail) {
    global $user;
    if(valid_email_address($mail)){  
      $account = user_load_by_mail($mail);
      if(!$account){
       $new_name = preg_replace('/@.*$/', '', $mail);
       $new_name = custom_unique_username($new_name); 

      $userinfo = array(
      'name' => $new_name,
      'pass' => user_password(),
      'init' => $mail,
      'mail' => $mail,
      'status' => 1,
      'access' => REQUEST_TIME,
      'roles' => array(5 => 'guest'),
      
    );
             
   $new_account = user_save(drupal_anonymous_user(), $userinfo);
   user_set_authmaps($new_account, array("authname_custom" => $new_account->name));  
    // Log user in.  
    $form_state['uid'] = $new_account->uid;
    //$form_state['redirect'] = 'node/' . $nid;
    user_login_submit(array(), $form_state);
   }
   else{
    
    if($user->uid == 0){
       drupal_goto('user/login' , array('query' => drupal_get_destination()));
    }
   }
   
   
    }
}

function custom_unique_username($name, $uid = 0) {
  // Strip illegal characters.
  $name = preg_replace('/[^\x{80}-\x{F7} a-zA-Z0-9@_.\'-]/', '', $name);

  // Strip leading and trailing spaces.
  $name = trim($name);

  // Convert any other series of spaces to a single underscore.
  $name = preg_replace('/ +/', '_', $name);

  // If there's nothing left use a default.
  $name = ('' === $name) ? t('user') : $name;

  // Truncate to reasonable size.
  $name = (drupal_strlen($name) > (USERNAME_MAX_LENGTH - 10)) ? drupal_substr($name, 0, USERNAME_MAX_LENGTH - 11) : $name;

  // Iterate until we find a unique name.
  $i = 0;
  do {
    $new_name = empty($i) ? $name : $name . '_' . $i;
    $found = db_query_range("SELECT uid from {users} WHERE uid <> :uid AND name = :name", 0, 1, array(':uid' => $uid, ':name' => $new_name))->fetchAssoc();
    $i++;
  } while (!empty($found));

  return $new_name;
}

?>