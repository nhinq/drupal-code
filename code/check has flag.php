<?php

/**
 * @author Nhi Nguyen
 * @copyright 2016
 */

$flag = flag_get_flag('live_show');
if ($flag->is_flagged($row->uid)){
return true;
}

?>