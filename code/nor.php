<?php

define('DRUPAL_ROOT', getcwd());

require_once dirname(__FILE__) . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
?>

then add

<?php
 is_membership();
?>
 