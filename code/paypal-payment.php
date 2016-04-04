<?php

/**
 * @author N.Nguyen
 * @copyright 2013
 */

//Form alter for registration form.
function user_type_register_form_alter(&$form, &$form_state, $form_id){
  switch($form_id) {
      case 'user_register_form':        
        $form['account']['user_type'] = array(
          '#type' => 'select',
          '#title' => t('Membership Type:'),
          '#options' => array(
            0 => t('General $50.00/Yr'),
            1 => t('Student $50.00/Yr'),
            2 => t('Government $50.00/Yr'),
            ),
           '#weight' => 1,
           '#description' => t('Select the membership type, which you want to have.'),
          );
        $form['account']['user_type_submit'] = array(
          '#type' => 'submit',
          '#value' => t('Submit'),
          '#submit' => array('user_type_register_form_submit'),
          '#validate' => array('user_type_register_form_alter_validate'),
          '#weight' => 10,
        );        
        $form['account']['name']['#description'] = t('');
        $form['account']['mail']['#description'] = t('');
        $form['#method'] = 'post';
        unset ($form['actions']); //unset the default submit Button      
        return $form;
      break;
    }   
}

function user_type_register_form_submit($form, &$form_state){
  global $base_url;
  $username = $form_state['values']['name'];
  $user_email = $form_state['values']['mail'];
  $user_pass = $form_state['value']['password'];
  $user_type = $form_state['values']['user_type'];
  $user_first_name = $form_state['values']['field_first_name']['und'][0]['value'];
  $user_last_name = $form_state['values']['field_last_name']['und'][0]['value'];
  $user_company_name = $form_state['values']['field_company_name']['und'][0]['value'];
  $user_address_line_1 = $form_state['values']['field_address_line_1']['und'][0]['value'];
  $user_address_line_2 = $form_state['values']['field_address_line_2']['und'][0]['value'];
  $user_city = $form_state['values']['field_user_city']['und'][0]['value'];
  $user_state = $form_state['values']['field_user_state']['und'][0]['value'];
  $user_zip = $form_state['values']['field_user_zip']['und'][0]['value'];
  $user_phone_number = $form_state['values']['field_phone_number_']['und'][0]['value'];
  $user_mobile_number = $form_state['values']['field_mobile_number_']['und'][0]['value'];
  $user_fax_number = $form_state['values']['field_fax_number_']['und'][0]['value'];

  $paypal = array();
  $paypal['cmd'] = '_xclick';
  $paypal['business'] = 'rajeev_1359782736_biz@gmail.com';
  $paypal['page_style'] = 'Primary';
  $paypal['bn'] = 'PP-DonationsBF';
  $paypal['item_name'] = 'Membership';
  $paypal['currency_code'] = 'USD';
  $paypal['no_shipping'] = '1';
  $paypal['tax'] = '0';
  $paypal['lc'] = 'US';
  $paypal['rm'] = '1';
  $paypal['notify_url'] = $base_url.'/?q=paypal/payment';
  $paypal['return'] = $base_url.'/?q=paypal/payment';
  $paypal['cancel_return'] = $base_url.'/?q=user/register';   
  $paypal['uname'] = $username;
  $paypal['email'] = $user_email;
  $paypal['pass'] = $user_pass;
  if($user_type == 0){
    $paypal['user_type'] = 'General';
  }
  elseif($user_type == 1){
    $paypal['user_type'] = 'Student';
  }
  elseif ($user_type == 2){
    $paypal['user_type'] = 'Government';
  }
  $paypal['first_name'] = $user_first_name;
  $paypal['last_name'] = $user_last_name;
  $paypal['comp_name'] = $user_company_name;
  $paypal['address1'] = $user_address_line_1;
  $paypal['address2'] = $user_address_line_2;
  $paypal['city'] = $user_city;
  $paypal['state'] = $user_state;
  $paypal['zip'] = $user_zip;
  $paypal['phone'] = $user_phone_number;
  $paypal['mobile'] = $user_mobile_number;
  $paypal['fax'] = $user_fax_number;

  switch($user_type){    
    case '0':
      //dpm("General");
      $membership_price = 10;
      $paypal['amount'] = $membership_price;
      $paypal['item_number'] = 1;

      $query = http_build_query($paypal, '', '&');

      //watchdog('Query--',$query);

      $form_state['redirect'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr?' .$query;

      break;

    case '1':
      //dpm("Student");
        $membership_price = 12;
      $paypal['amount'] = $membership_price;
      $paypal['item_number'] = 2;

      $query = http_build_query($paypal, '', '&');

      $form_state['redirect'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr?' .$query;
      break;

    case '2':
      //dpm("Government");
      $membership_price = 15;      
      $paypal['amount'] = $membership_price;
      $paypal['item_number'] = 3;

      $query = http_build_query($paypal, '', '&');

      $form_state['redirect'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr?' .$query;
      break;
  }

}

?>