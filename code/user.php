<?php

/**
 * @author Cesoftco
 * @copyright 2012
 */
  global $user;
 if($user->uid > 0){ 
    $account = user_load($user->uid);
    $name = isset($account->field_first_name['und'][0]['value']) ?
     $account->field_first_name['und'][0]['value']:
     format_username($account);
    
    print '<div id="welcome-user-block">Hi, ' . $name . '</div>';
 }

  if ($user->uid > 0) {
      $content = userpoints_get_points_list();
      print $content['total']['#markup'].l('Xem các giao d?ch', 'myuserpoints');
    }
 if(($user->uid > 0) && ($user->roles[3] == 'administrator')){ 
    print '<div id="tool-user-block">' . l(t('Qu?n l? web'), 'admin/dashboard'). '</div>';
  } 
  if($user->uid>0){ 
    print '<div id="logout-user-block">' .l(t('Logout'), 'user/logout'). '</div>';
  } 
?>
