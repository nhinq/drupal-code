<?php

$result = db_select('node', 'n')
    ->condition('type', array('best_service', 'celebrity_corner','great_ideas','ceo_introduction','league_tables','marketing_service','nitty_gritty','rds_blog','venue_blog'))
    ->condition('fs.field_section_tid', 2)
    ->fields('n', array('nid', 'title'))
    ->join('field_data_field_section', 'fs', 'fs.entity_id = n.nid')
    ->orderBy('created', 'DESC')
    ->execute()
    ->fetchField();