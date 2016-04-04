<?php

 $tid = arg(2); $vid = 2;
    if ($tid && !isset($children[$tid])) {
    $query = db_select('taxonomy_term_data', 't');
    $query->join('taxonomy_term_hierarchy', 'h', 'h.tid = t.tid');
    $query->addField('t', 'tid');
    $query->condition('h.parent', $tid);
    if ($vid) {
      $query->condition('t.vid', $vid);
    }
    $query->addTag('term_access');
    $query->orderBy('t.weight');
    $query->orderBy('t.name');
    $tids = $query->execute()->fetchCol();
    if(!empty($tids)) {
      $term = implode(',', $tids);
      print "'$term'";
    }else{
      print $tid;
    }  
  }