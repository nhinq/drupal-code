<?php

/**
 * @author Nhi Nguyen
 * @copyright 2014
 */

function ces_inviter_update_projects_alter(&$projects){
    unset($projects['og']);//menu_target la ten module
}

?>