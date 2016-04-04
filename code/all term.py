<?php
    $tid = arg(2);
    $tids = taxonomy_get_children($tid, 2);
    if(!empty($tids)) {
      $term = implode(',', $tids);
      return "'$term'";
    }else{
      return $tid;
    }  
    // $vid return '16,11,13,12,18,15,17,14' ;
  