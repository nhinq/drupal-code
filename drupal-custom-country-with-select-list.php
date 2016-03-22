<?php

/**
 * @author Nhi Nguyen
 * @copyright 2016
 */
function custom_form_alter(&$form, $form_state, $form_id){
  if( module_exists('addressfield') ){
    require_once DRUPAL_ROOT . '/includes/locale.inc';
    module_load_include('inc', 'addressfield', 'addressfield.administrative_areas');
    if(isset($form_state['values']['billing']['country'])){
      $address['country'] = $form_state['values']['billing']['country'];            
    }else{
      $address['country'] = 'US';
    }
    
    $countries = country_get_list();
    $form['billing']['country']['#type'] = 'select';
    $form['billing']['country']['#options'] = $countries;
    $form['billing']['country']['#default_value'] = $address['country'];
    $form['billing']['country']['#ajax'] = array(
      'callback' => 'custom_billing_country_callback',
      'wrapper' => 'wrapper-billing-state-div',
      'effect' => 'fade',
    );
             
    $administrative_areas = addressfield_get_administrative_areas($address['country']);
    if(!empty($administrative_areas)){
      $form['billing']['state']['#type'] = 'select';
      $form['billing']['state']['#options'] = $administrative_areas;             
    }else{
      $form['billing']['state']['#required'] = false;
    }
    
    $form['billing']['state']['#prefix'] = '<div id="wrapper-billing-state-div">';
    $form['billing']['state']['#suffix'] = '</div>';
             
  }
}

function custom_billing_country_callback($form, $form_state) {
 return $form['billing']['state'];
}

?>