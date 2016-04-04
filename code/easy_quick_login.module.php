<?php

/**
 * @author Nhi Nguyen
 * @copyright 2015
 */

/**
args: uid, token, redirect link

*/
 
function easy_quick_login_menu() { 
  
  $items['easy-quick-login/%/%/%'] = array(
    'page callback' => 'easy_quick_login_page',
    'page arguments' => array(1, 2, 3),
    'access callback' => true,
    'type' => MENU_CALLBACK,
  );
  
  return $items;
     
} 

function easy_quick_login_page($uid, $token, $redirect){
	$token = base64_decode($token);	
	if($uid){
      _cesoft_login_finalize($uid, $token);
      drupal_goto($redirect);
	}else{
	  drupal_access_denied();
	}
}

function _cesoft_login_finalize($uid, $token){
  global $user;
  $ok = db_query("select uid from {users} where uid=:uid and pass=:pass", array(':uid' => $uid, ':pass' => $token))->fetchField();  
  if($ok){		
	  $user = user_load($uid);
	  user_login_finalize($user);
  }  
	 
}

function _cesoft_login_test(){
    global $user;
    $account = user_load($user->uid);
    $token = base64_encode($account->pass);
    $redirect = '<front>';
     
    $link = '<a class="button" href="'.url('easy-quick-login/'.$account->uid.'/'.$token.'/'.$redirect, array('absolute' => true)).'">here</a>';
}

?>