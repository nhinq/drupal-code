<?php

/**
 * @author Nhi Nguyen
 * @copyright 2015
 */

 
 
 db_update('taxonomy_vocabulary')
      ->fields(array('weight' => -1))
      ->condition('vid', 31)
      ->execute();
 
 

?>