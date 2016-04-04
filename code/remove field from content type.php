<?php

/**
 * @author Nhi Nguyen
 * @copyright 2016
 */

function yardage_update_7008() {
  
    $field_name = 'field_license';
    field_delete_field($field_name);
}

?>