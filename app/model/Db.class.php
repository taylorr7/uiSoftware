<?php

// This class was taken and modified from the one provided for the Hokie Gear site
class Db
{
    // Singleton instance
    private static $_instance = null;
    private $conn;

    private function __construct()
    {
        $host = DB_HOST;
        $database = DB_DATABASE;
        $username = DB_USER;
        $password = DB_PASS;
        // Create the connection with the global database config
        $this->conn = mysql_connect($host, $username, $password)
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

    // Converts a string to MySQL escaped text
    private function escape($text) {
        if (is_null($text)) {
            return 'NULL';
        } else {
            $escaped = mysql_real_escape_string($text);
            return "'{$escaped}'";
        }
    }

    // Creates a MySQL clause equating the keys and values of properties
    private function generateQueryClause($properties, $delimiter) {
        $whereClauses = array_map(function($item) use ($properties) {
            $val = $this->escape($properties[$item]);
            return "{$item} = {$val}";
        }, array_keys($properties));

        return implode($whereClauses, $delimiter);
    }

    // Performs a database query
    private function query($query) {
        $result = mysql_query($query, $this->conn);
        if (!$result)
            die('Invalid query: ' . mysql_error());
        return $result;
    }

    // Loads objects from database
    public function select($query, $class_name = null) {
        $result = $this->query($query);
        $items = array();
        if (is_null($class_name)) {
            while ($item = mysql_fetch_assoc($result)) {
                $items[] = $item;
            }
        } else {
            while ($item = mysql_fetch_object($result, $class_name)) {
                $items[] = $item;
            }
        }

        return $items;
    }

    // Loads all objects in a table
    public function selectAll($db_table, $class_name = null) {
        return $this->select("SELECT * FROM {$db_table};", $class_name);
    }

    // Searches a table by properties
    public function search($db_table, $properties, $qry, $class_name = null) {
        $whereClause = implode(array_map(function($item) use ($qry) {
            return "INSTR({$item}, '{$qry}') > 0";
        }, $properties), " OR ");

        $orderByClause = implode(array_map(function($item) use ($qry) {
            return "INSTR({$item}, '{$qry}') DESC";
        }, $properties), ", ");

        $query = "SELECT * FROM {$db_table} WHERE {$whereClause} ORDER BY {$orderByClause};";
        return $this->select($query, $class_name);
    }

    // Loads objects when given properties match
    public function selectByProperties($db_table, $properties, $class_name = null) {
        $whereClause = $this->generateQueryClause($properties, " AND ");
        $query = "SELECT * FROM {$db_table} WHERE {$whereClause};";
        return $this->select($query, $class_name);
    }

    // Loads object when single property matches
    public function selectByProperty($db_table, $column, $val, $class_name = null) {
        return $this->selectByProperties($db_table, array($column => $val), $class_name);
    }

    // Loads object from database with given id
    public function selectById($db_table, $id, $class_name = null) {
        return $this->selectByProperty($db_table, "id", $id, $class_name);
    }

    // Performs update of existing data
    public function update($db_table, $id, $properties) {
        $setClause = $this->generateQueryClause($properties, ", ");
        $query = "UPDATE {$db_table} SET {$setClause} WHERE id='{$id}';";
        return $this->query($query);
    }

    // Adds new row to table
    public function insert($db_table, $properties) {
        $columns = implode(array_keys($properties), ', ');
        $values = implode(array_map(function($val) {
            return $this->escape($val);
        }, array_values($properties)), ', ');
        $query = "INSERT INTO {$db_table} ({$columns}) VALUES ({$values});";
        $this->query($query);
        return mysql_insert_id();
    }

    // Deletes rows that match properties
    public function deleteByProperties($db_table, $properties) {
        $whereClause = $this->generateQueryClause($properties, " AND ");
        $query = "DELETE FROM {$db_table} WHERE {$whereClause};";
        return $this->query($query);
    }

    // Deletes row that matches property
    public function deleteByProperty($db_table, $column, $val) {
        return $this->deleteByProperties($db_table, array($column => $val));
    }

    // Deletes row that has given id
    public function deleteById($db_table, $id) {
        return $this->deleteByProperty($db_table, "id", $id);
    }
}
