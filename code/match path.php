<?php

/**
 * @author Nhi Nguyen
 * @copyright 2015
 */

  $patterns = array('user', 'user/*', 'checkout', 'checkout/*');
  $pages = implode("\n", $patterns); 
  $securepages = variable_get('ces_securepages_pages');
  $path = drupal_strtolower(drupal_get_path_alias($_GET['q']));
  $secure = drupal_match_path($path, $securepages);

?>