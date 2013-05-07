<?php
/**
 * @file    todo
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'function.php';

ob_start();
session_start();
date_default_timezone_set('PRC');

require_once 'app.class.php';
$request = new Request();
$response = new Response();

require_once 'entry.model.php';

if (_post('new_entry')) {
    todo_add(array('title' => _post('new_entry')));
    // exit;
    $response->redirect($request->uri);
}

if (_get('del')) {
    todo_del(_get('del'));
    $response->redirect($request->uri);
}

$list = _post('entry');
if ($list) {
    foreach ($list as $id => $title) {
        todo_edit($id, array('title' => $title));
    }
    $response->redirect($request->uri);
}

$list = todo_get_list();

include 'index.phtml';
