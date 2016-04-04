<?php
function THEMENAME_menu_link(array $variables) {
$element = $variables['element'];
$sub_menu = '';

if ($element['#below']) {
$sub_menu = drupal_render($element['#below']);
}

if (empty($element['#localized_options'])) {
$element['#localized_options'] = array();
}

/* Changes URL to current page and adds the anchor name #top to the end based on menu title "Jump to Top"*/
if (($element['#title']) == "Jump to Top") {
$current_url = "http://" .$_SERVER['HTTP_HOST'] . request_uri();
$output = l($element['#title'], $current_url , array('fragment' => "top"));
}
else {
$output = l($element['#title'], $element['#href'], $element['#localized_options']);
}

return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}
?>