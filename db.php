<?php
/**
 * @file    db
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

function db_get()
{
    static $db;
    if (is_null($db)) {
        $db = new Pdo('mysql:host=localhost;dbname=xc_todo', 'root', '');
    }
    return $db;
}
function db_exec($sql, $values = array())
{
    $db = db_get();
    $stmt = $db->prepare($sql);
    $i = 0;
    foreach ($values as $key => $value) {
        $i++;
        $stmt->bindValue($i, $value);
    }
    $stmt->execute();
    $has_error = $stmt->errorCode() + 0;
    if ($has_error) {
        var_dump($stmt->errorInfo());
        throw new Exception("error", 1);
    }
    return $stmt;
}
