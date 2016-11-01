<?php

// This class is the base class for objects representing database tables
abstract class DbObject implements IteratorAggregate {
    public $id = null;

    // Gets the table name that the class represents
    protected abstract function getTable();

    // Creates a new DBObject and sets the given properties
    public function __construct($args = array()) {
        $this->update($args);
    }

    // Sets the properties and value given to the DBObject
    public function update($newValues) {
        foreach ($this as $column => $value) {
            if (array_key_exists($column, $newValues)) {
                $this->$column = $newValues[$column];
            }
        }
    }

    // Saves the item to the database
    public function save() {
        if (is_null($this->id)) {
			$this->id = Db::instance()->insert($this->getTable(), (array)$this);
		} else {
			Db::instance()->update($this->getTable(), $this->id, (array)$this);
		}
    }

    // Removes this object from the database
    public function delete() {
        if (!is_null($this->$id)) {
            Db::instance()->deleteById($this->$id);
        }
    }

    // Gets the iterator of the DBObject's public properties
    public function getIterator()
    {
        return new ArrayIterator($this);
    }
}
