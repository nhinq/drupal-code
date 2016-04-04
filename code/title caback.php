function mymodule_menu_alter(&$items) {
    $items['toggle-review-process']['title callback'] = 'mymodule_title_callback';
    $items['toggle-review-process']['title arguments'] = array(1, 'some string');
}

function mymodule_title_callback($arg1, $arg2) {
    $title = 'create the title';
    return $title;
}