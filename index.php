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
    $response->render('view/index.phtml');
});

respond('/add', function ($request, $response) {
    if (_post('title')) {
        $id = todo_add(array('title' => _post('title')));
        $response->entry = todo_get($id);
        $response->render('view/entry.phtml');
    }
    $response->render('view/new_entry.phtml');
});

respond('/[i:id]/del', function ($request, $response) {
    todo_del($request->id);
    $response->json(array('code' => 200));
});

respond('/[i:id]/done/[i:is_done]', function ($request, $response) {
    todo_edit($request->id, array('is_done' => $request->is_done));
    $response->json(array('code' => 200));
});

respond('POST', '/[i:id]', function ($request, $response) {
    todo_edit($request->id, array('title' => $request->title));
    $data = todo_get($request->id);
    $response->json(array('code' => 200, 'data' => $data));
});

dispatch();
