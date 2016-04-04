<?php

/**
 * @author N.Nguyen
 * @copyright 2013
 */

$query = db_select('users', 'u')
    ->condition('u.uid', 12 , '>')
    ->fields('u', array('uid'));
   $result =  $query->execute();
 foreach($result as $uid){
  user_delete($uid->uid);
 }

?>

<?php

/**
 * @author N.Nguyen
 * @copyright 2013
 */

  $node = db_fetch_object(db_query('SELECT nid FROM {node} n WHERE type = product'));
 foreach($node as $nid){
   $node = node_load($nid);
   node_unpublish_action($node);
 }

?>


<?php

/**
 * @author N.Nguyen
 * @copyright 2013
 */

$query = db_select('node', 'n')
    ->condition('n.type', 'bookings')
    ->fields('n', array('nid'));
   $result =  $query->execute();
 foreach($result as $uid){
  user_delete($uid->uid);
 }

?>