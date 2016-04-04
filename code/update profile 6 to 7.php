<?php

/**
 * @author Nguyen
 * @copyright 2013
 */

db_update('system')
    ->fields(array('status' => 1, 'filename' => 'profiles/standard/standard.profile'))
    ->condition('filename', 'profiles/standard/standard.profile')
    ->execute();
?>