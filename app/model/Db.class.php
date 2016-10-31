<?php

// This class was taken and modified from the one provided for the Hokie Gear site
class Db
{
    private static $_instance = null;
    private $conn;

    private function __construct()
    {
        $host = DB_HOST;
        $database = DB_DATABASE;
        $username = DB_USER;
        $password = DB_PASS;
        // Create the connection with the global database config
        $conn = mysql_connect($host, $username, $password)
        or die ('Error: Could not connect to MySql database');

        mysql_select_db($database);
    }

    // Access the singleton
    public static function instance()
    {
        if (self::$_instance === null) {
            self::$_instance = new Db();
        }
        return self::$_instance;
    }


    private static function escape($text) {
        if (is_null($text)) {
            return 'NULL';
        } else {
            $escaped = mysql_real_escape_string($text);
            return "'{$escaped}'";
        }
    }

    private static function generateQueryClause($properties, $delimiter) {
        $whereClauses = array_map(function($item) use ($properties) {
            $val = self::escape($properties[$item]);
            return "{$item} = {$val}";
        }, array_keys($properties));

        return implode($whereClauses, $delimiter);
    }

    private static function query($query) {
        $result = mysql_query($query);
        if (!$result)
            die('Invalid query: ' . $query);
        return $result;
    }

    public static function select($query, $class_name = null) {
        $result = self::query($query);
        $items = array();
        while ($item = mysql_fetch_object($result, $class_name)) {
            $items[] = $item;
        }

        return $items;
    }

    public static function selectAll($db_table, $class_name = null) {
        return self::select("SELECT * FROM {$db_table};", $class_name);
    }

    public static function search($db_table, $properties, $qry, $class_name = null) {
        $whereClause = implode(array_map(function($item) use ($qry) {
            return "INSTR({$item}, '{$qry}') > 0";
        }, $properties), " OR ");

        $orderByClause = implode(array_map(function($item) use ($qry) {
            return "INSTR({$item}, '{$qry}') DESC";
        }, $properties), ", ");

        $query = "SELECT * FROM {$db_table} WHERE {$whereClause} ORDER BY {$orderByClause};";
        return self::select($query, $class_name);
    }

    public static function selectByProperties($db_table, $properties, $class_name = null) {
        $whereClause = self::generateQueryClause($properties, " AND ");
        $query = "SELECT * FROM {$db_table} WHERE {$whereClause};";
        return self::select($query, $class_name);
    }

    public static function selectByProperty($db_table, $column, $val, $class_name = null) {
        return self::selectByProperties($db_table, array($column => $val), $class_name);
    }

    public static function selectById($db_table, $id, $class_name = null) {
        return self::selectByProperty($db_table, "id", $id, $class_name);
    }

    public static function update($db_table, $id, $properties) {
        $setClause = self::generateQueryClause($properties, ", ");
        $query = "UPDATE {$db_table} SET {$setClause} WHERE id='{$id}';";
        return self::query($query);
    }

    public static function insert($db_table, $properties) {
        $columns = implode(array_keys($properties), ', ');
        $values = implode(array_map(function($val) {
            return self::escape($val);
        }, array_values($properties)), ', ');
        $query = "INSERT INTO {$db_table} ({$columns}) VALUES ({$values});";
        self::query($query);
        return mysql_insert_id();
    }

    public static function deleteByProperties($db_table, $properties) {
        $whereClause = self::generateQueryClause($properties, " AND ");
        $query = "DELETE * FROM {$db_table} WHERE {$whereClause};";
        self::query($query);
    }

    public static function deleteByProperty($db_table, $column, $val) {
        return self::deleteByProperties($db_table, array($column => $val));
    }

    public static function deleteById($db_table, $id) {
        return self::deleteByProperty($db_table, "id", $id);
    }
}
