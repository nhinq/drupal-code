<?php
function mymodule_block_info() {
  $blocks['taxonomy_menu'] = array(
    'info' => t('Taxonomy menu'),
  );

  return $blocks;
}

function mymodule_block_view($delta = '') {
  $block = array();
 
  // Taxonomy menu block.
  if ($delta == 'taxonomy_menu') {
    $terms = taxonomy_get_tree(1); // Use the correct vocabulary id.
   
    // Get the active trail tid-s.
    $active = arg(2);
    $active_parents = taxonomy_get_parents_all($active);
    $active_parents_tids = array();
    foreach ($active_parents as $parent) {
      $active_parents_tids[] = $parent->tid;
    }
   
    // Build the menu.
    $term_count = count($terms);
    $cont = '<ul class="taxonomy_menu">';
    for ($i = 0; $i < $term_count; $i++) {
      // Build the classes string.
      $classes = '';
      $children = taxonomy_get_children($terms[$i]->tid);
      $active_trail = in_array($terms[$i]->tid, $active_parents_tids);
      if ($active_trail && $children) $classes .= 'expanded active-trail ';
      elseif ($active_trail) $classes .= 'active-trail ';
      elseif ($children) $classes .= 'collapsed ';
     
      if ($i == 0) $cont .= '<li class="first '.$classes.'">'.l($terms[$i]->name, 'taxonomy/term/'.$terms[$i]->tid);
      else {
        if ($terms[$i]->depth == $depth) $cont .= '</li><li class="'.$classes.'">'.l($terms[$i]->name, 'taxonomy/term/'.$terms[$i]->tid);
        elseif ($terms[$i]->depth > $depth) $cont .= '<ul class="level-'.$terms[$i]->depth.'"><li class="first '.$classes.'">'.l($terms[$i]->name, 'taxonomy/term/'.$terms[$i]->tid);
        elseif ($terms[$i]->depth < $depth) {
          // Add missing end-tags depending of depth level difference.
          for ($j = $terms[$i]->depth; $j < $depth; $j++) {
            $cont .= '</li></ul>';
          }
          $cont .= '</li><li class="'.$classes.'">'.l($terms[$i]->name, 'taxonomy/term/'.$terms[$i]->tid);
        }
        // If we have reached the last element add all possibly missing end-tags.
        if (!isset($terms[$i+1])) {
          for ($j = 0; $j < $terms[$i]->depth; $j++) {
            $cont .= '</li></ul>';
          }
        }
      }
      $depth = $terms[$i]->depth;
    }
    $cont .= '</li></ul>';
   
    // Set the menu html as block content.
    $block['content'] = array('#markup' => $cont);
  }
 
  return $block;
}