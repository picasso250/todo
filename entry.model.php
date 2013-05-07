<?php
/**
 * @file    entry.model
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

require_once 'db.php';

function todo_add($data)
{
    $fields = implode(', ', array_keys($data));
    $qs = trim(str_repeat('?,', count($data)), ',');
    $sql = "INSERT INTO `todo_entry` ($fields) VALUES ($qs)";
    $stmt = db_exec($sql, array_values($data));
    return true;
}

function todo_del($id)
{
    $sql = "DELETE FROM `todo_entry` WHERE `id`=?";
    $stmt = db_exec($sql, array($id));
    return true;
}

function todo_edit($id, $data)
{
    foreach ($data as $field => $value) {
        $sets[] = "`$field`=?";
        $values[] = $value;
    }
    $expr = implode(', ', $sets);
    $sql = "UPDATE `todo_entry` SET $sets WHERE `id`=?";
    $values[] = $id;
    db_exec($sql, $values);
    return true;
}

function todo_get_list()
{
    $sql = "SELECT * FROM `todo_entry` ORDER BY `id` ASC";
    $stmt = db_exec($sql);
    $ret = array();
    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        $ret[$row->id] = $row;
    }
    return $ret;
}
