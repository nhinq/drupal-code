<?php

/**
 * @author N.Nguyen
 * @copyright 2013
 */
/*
$arrival = $data->_field_data['nid']['entity']->field_arrival['und'][0]['value'];
$departure = $data->_field_data['nid']['entity']->field_departure['und'][0]['value'];
$rooms = $data->_field_data['nid']['entity']->field_rooms['und'][0]['value'];

  $days = daydiff($arrival, $departure);
  $night = $rooms * $days;
   */
  
  $query = db_select('node', 'n')->condition('n.type','bookings');
  
  $query->fields('n', array('nid'));
  $query->fields('a', array('field_arrival_value'));
  $query->fields('d', array('field_departure_value'));
  $query->fields('r', array('field_rooms_value'));
 
  $query->leftJoin('field_data_field_arrival', 'a', 'a.entity_id = n.nid');
  $query->leftJoin('field_data_field_departure', 'd', 'd.entity_id = n.nid');
  $query->leftJoin('field_data_field_rooms', 'r', 'r.entity_id = n.nid');  
  
  $nodes = $query->execute();
  foreach($nodes as $node){
    $days = daydiff($node->field_arrival_value, $node->field_departure_value);
    $night = $node->field_rooms_value * $days;
  }
  
    
?>