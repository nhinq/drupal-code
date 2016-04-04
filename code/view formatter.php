<?php

/**
 * @author Nhi Nguyen
 * @copyright 2014
 */

/**
 *
 */
function HOOK_field_formatter_info() {
  return array(
    'og_inviter_user' => array(
      'label' => t('Inviter User'),
      'field types' => array(),
      'settings' => array(),
    )
  );
}


function HOOK_field_formatter_view(
  
  $entity_type,
  $entity,
  $field,
  $instance,
  $langcode,
  &$items,
  $display
) {
  $element = array();
  switch ($display['type']) {
    
    case 'og_inviter_user':
     
      foreach ($items as $delta => $item) {
        $account = user_load($item['iid']);
        $element[$delta]['#markup'] = format_username($account);
      }
      break;

  }


  return $element;
}


?>