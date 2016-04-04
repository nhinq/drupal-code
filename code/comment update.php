<?php

/**
 * @author Nhi Nguyen
 * @copyright 2014
 */

$nodes = db_select('node', 'n') // Table name no longer needs {}
    ->fields('n', array('nid'))
    ->condition('type', 'page', '!=')
    ->execute();
    
    foreach($nodes as $c_node){
      $node = node_load($c_node->nid);
      $node->comment = 2;
      node_save($node);
 
    }
  
    

?>