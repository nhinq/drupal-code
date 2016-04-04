<?php

/**
 * @author Nhi Nguyen
 * @copyright 2016
 */

function HOOK_preprocess_page(&$variables) {
 
      $node = $variables['node'];
      $variables['new_lass'] = 'newcls-'.$node->field_section['und'][0]['tid'];
      
}

?>

<?php
//page.tpl.php
 print $new_lass; ?>