
<?php
$content = (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_REQUEST['content'])) ? str_replace('-', '_', $_REQUEST['content']) : $_REQUEST['content'];
if (file_exists('js/' . $content . '.php')) {
    switch ($content) {
        case $content:
            include_once 'js/' . str_replace('-', '_', $content) . '.php';
            break;
    }
}
?>