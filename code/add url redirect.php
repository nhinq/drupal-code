<?php

/**
 * @author Nhi Nguyen
 * @copyright 2015
 */

$redirect = new stdClass();
    redirect_object_prepare($redirect);
    $redirect->source = 'node-1';
    $redirect->redirect = 'node/1';
    $redirect->language = 'en';
    // Check if the redirect exists before saving.
    $hash = redirect_hash($redirect);
    if (!redirect_load_by_hash($hash)) {
      redirect_save($redirect);
    }

?>