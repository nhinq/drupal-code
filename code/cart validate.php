<?php

/**
 * @author Nhi Nguyen
 * @copyright 2015
 */


//cart validate
function ces_custom_form_commerce_cart_add_to_cart_form_alter(&$form, &$form_state) {
  $form['#validate'][] = 'ces_custom_cart_validate';
}

function ces_custom_cart_validate($form, &$form_state) {

  $order = commerce_cart_order_load($GLOBALS['user']->uid);

  if ($order) {
    $order_wrapper = entity_metadata_wrapper('commerce_order', $order);  

    if ( $order_wrapper->commerce_line_items->value() ) {
      form_set_error('', 'You can only have one item in your <a href="cart">Cart</a>');
    }
    
    
  }
  
}

?>