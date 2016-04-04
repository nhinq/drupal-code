<?php

$query = db_select('node', "n"); 
  $query->fields('n', array('nid'));
  $query->join('field_data_field_section', 's', 's.entity_id = n.nid');   
  $query->condition('s.field_section_tid',1);
  $query->condition('n.type','article');
  $query->orderBy('n.created', 'DESC');
  $result = $query->execute()->fetchField();
  return $result;
  
  
  $result = db_query("SELECT node.title AS node_title, node.nid AS nid, node.created AS node_created, node.sticky AS node_sticky, 'node' AS field_data_field_images_node_entity_type
FROM 
{node} node
INNER JOIN {field_data_field_section} field_data_field_section ON node.nid = field_data_field_section.entity_id AND (field_data_field_section.entity_type = 'node' AND field_data_field_section.deleted = '0')
LEFT JOIN {field_data_field_week} field_data_field_week ON node.nid = field_data_field_week.entity_id AND (field_data_field_week.entity_type = 'node' AND field_data_field_week.deleted = '0')
WHERE (( (field_data_field_week.field_week_value = ':week' ) )AND(( (field_data_field_section.field_section_tid = '3') AND (node.status = '1') )))
ORDER BY node_created DESC, node_sticky ASC
LIMIT 1 OFFSET 0", array(':week' =>$GLOBALS['week_number']));

$record = $result->fetchAssoc();  
return $record['nid'];
  
 $result = db_query("SELECT node.title AS node_title, node.nid AS nid, node.created AS node_created, node.sticky AS node_sticky, 'node' AS field_data_field_images_node_entity_type
FROM 
{node} node
LEFT JOIN {og_membership} og_membership_node ON node.nid = og_membership_node.etid AND og_membership_node.entity_type = 'node'
INNER JOIN {field_data_field_section} field_data_field_section ON node.nid = field_data_field_section.entity_id AND (field_data_field_section.entity_type = 'node' AND field_data_field_section.deleted = '0')
LEFT JOIN {field_data_field_week} field_data_field_week ON node.nid = field_data_field_week.entity_id AND (field_data_field_week.entity_type = 'node' AND field_data_field_week.deleted = '0')
WHERE (( (field_data_field_week.field_week_value = :week) )AND(( (node.status = '1') AND (node.promote <> '0') )AND( (node.type IN  ('article', 'venue_blog')) AND (field_data_field_section.field_section_tid = '1') )))
ORDER BY node_created DESC, node_sticky ASC
LIMIT 1 OFFSET 0", array(':week' =>$GLOBALS['week_number']));

$record = $result->fetchAssoc();  
return $record['nid'];?>
  