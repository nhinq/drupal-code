<?php

/**
 * @author N.Nguyen
 * @copyright 2013
 */

$nodes = db_query("SELECT nid FROM {node} WHERE type = :type", array(':type' => "course"))->fetchObject();
 //update type by NID
foreach($nodes as $nid){
   db_update('node')
      ->fields(array('type' => 'lesson_page'))
      ->condition('nid', $nid)
      ->execute();
}
///*/
/*/*
 db_update('node')
      ->fields(array('type' => 'lesson_page'))
      ->condition('type', 'course')
      ->execute();
 */
?>