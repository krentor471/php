<?php

namespace src\Models;

use src\Services\Db;

abstract class ActiveRecordEntity
{
    public static function findAll(): array
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
        $result = $db->query("SELECT * FROM `$tableName`");
        return $result === null ? [] : $result;
    }

    public static function getById($id)
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
        $result = $db->query("SELECT * FROM `$tableName` WHERE id = :id", [':id' => $id], static::class);
        return $result === null || count($result) === 0 ? null : $result[0];
    }

    abstract protected static function getTableName();

    public function save()
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
        $props = get_object_vars($this);
        if (isset($this->id) && $this->id) {
            // update
            $columns = [];
            $params = [];
            foreach ($props as $key => $value) {
                if ($key === 'id') continue;
                $columns[] = "$key = :$key";
                $params[":$key"] = $value;
            }
            $params[':id'] = $this->id;
            $sql = "UPDATE `$tableName` SET ".implode(', ', $columns)." WHERE id = :id";
            $db->query($sql, $params, static::class);
        } else {
            // insert
            $columns = array_keys($props);
            $params = [];
            foreach ($columns as $col) {
                $params[":$col"] = $props[$col];
            }
            $sql = "INSERT INTO `$tableName` (".implode(', ', $columns).") VALUES (".implode(', ', array_keys($params)).")";
            $db->query($sql, $params, static::class);
            $this->id = $db->getLastInsertId();
        }
    }

    public function delete()
    {
        $db = Db::getInstance();
        $tableName = static::getTableName();
        $db->query("DELETE FROM `$tableName` WHERE id = :id", [':id' => $this->id], static::class);
    }

    public function getId()
    {
        return $this->id;
    }
}
