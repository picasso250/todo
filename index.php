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

require_once 'lib/klein.php';

require_once 'entry.model.php';

respond('/', function ($request, $response) {
    $response->list = todo_get_list();
    $response->render('index.phtml');
});

respond('/add', function ($request, $response) {
    $msg = array('code' => 200, 'post' => $request->param());
    if (_post('title')) {
        $id = todo_add(array('title' => _post('title')));
        $msg['code'] = 201;
        $msg['id'] = $id;
    }
    $response->json($msg);
});

respond('/[i:id]/del', function ($request, $response) {
    todo_del($request->id);
    $response->json(array('code' => 200));
});

respond('POST', '/[i:id]', function ($request, $response) {
    todo_edit($request->id, array('title' => $request->title));
    $data = todo_get($request->id);
    $response->json(array('code' => 200, 'data' => $data));
});

dispatch();
