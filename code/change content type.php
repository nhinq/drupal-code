<?php

/**
 * @author Nguyen
 * @copyright 2013
 */

db_update('node')
->fields(array('type' => 'article'))
->condition('nid', array(198,199))
->execute();

?>