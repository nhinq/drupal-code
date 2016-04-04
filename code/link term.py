<?
//vocabulary Categories
$vid = 2;
//get terms
$terms = taxonomy_get_tree($vid, $parent = 0, $max_depth = NULL, $load_entities = FALSE);

foreach ($terms AS $term) {
  $links[$term -> tid] = array(
    'title' => $term -> name,
    'href' => 'categories/' . $term -> name,
    'attributes' => array('class' => array('category'), 'title' => $term -> name),
  );
}

$attributes =array('class' => 'menu-categories');
$heading = array('text' => t('Categories'), 'level' => 'h2', 'class' => 'menu-categories-title');

print theme_links(array('links' => $links, 'attributes' => $attributes, 'heading' => $heading));