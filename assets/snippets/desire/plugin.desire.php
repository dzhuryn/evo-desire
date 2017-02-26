<?php

require_once MODX_BASE_PATH.'assets/snippets/desire/class.desire.php';
$storage = isset($_SESSION['desire_storage'])?$_SESSION['desire_storage']:'cookie';
$desire = new desire($storage,$modx);

switch ($_GET['q']) {
    case 'add-to-desire':
        $id=!empty($_GET['id'])?intval($_GET['id']):0;
        $desire->addItem($id);
        die();
        break;
    case 'delete-from-desire':
        $id=!empty($_GET['id'])?intval($_GET['id']):0;
        $desire->deleteItem($id);
        die();
        break;
}
