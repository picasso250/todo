<?php
/**
 * @file    db
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

function db_exec($sql, $values = array())
{
    static $db;
    if (is_null($db)) {
        $db = new Pdo('mysql:host=localhost;dbname=xc_todo', 'root', '');
    }
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

function db_qm($n)
{

}
