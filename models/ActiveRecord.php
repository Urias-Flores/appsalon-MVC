<?php

namespace Model;

class ActiveRecord {

    protected static $Connection;
    protected static $table = '';
    protected static $columns = [];

    protected static $alert = [];

    public static function setConnection($Connection) {
        self::$Connection = $Connection;
    }

    public static function setAlerta($type, $message) {
        static::$alert[$type][] = $message;
    }

    public static function getAlert() {
        return static::$alert;
    }

    public function validate() {
        static::$alert = [];
        return static::$alert;
    }

    public static function executeSQL($query) {
        $result = self::$Connection->query($query);

        $array = [];
        while($registro = $result->fetch_assoc()) {
            $array[] = static::createObject($registro);
        }

        $result->free();

        return $array;
    }

    protected static function createObject($registro) {
        $object = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $object, $key  )) {
                $object->$key = $value;
            }
        }
        return $object;
    }

    public function attributes() {
        $attributes = [];
        foreach(static::$columns as $column) {
            if($column === 'ID') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitezeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value ) {
            $sanitized[$key] = self::$Connection->escape_string($value);
        }
        return $sanitized;
    }

    public function sync($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
    
    public function save() {
        $result = '';
        if(!is_null($this->ID)) {
            $result = $this->update();
        } else {
            $result = $this->create();
        }
        return $result;
    }
    
    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        $result = self::executeSQL($query);
        return $result;
    }
    
    public static function find($ID) {
        $query = "SELECT * FROM " . static::$table  ." WHERE ID = ${ID}";
        $result = self::executeSQL($query);
        return array_shift( $result ) ;
    }

    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$table . " WHERE ${column} = '${value}'";
        $result = self::executeSQL($query);
        return array_shift( $result ) ;
    }

    public static function SQL($Consult) {
        $result = self::executeSQL($Consult);
        return $result;
    }

    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT ${limit}";
        $result = self::executeSQL($query);
        return array_shift( $result ) ;
    }
    
    public function create() {
        $attributes = $this->sanitezeAttributes();
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "') ";
        $result = self::$Connection->query($query);
        return [
           'result' =>  $result,
           'ID' => self::$Connection->insert_id
        ];
    }

    public function update() {
        $attributes = $this->sanitezeAttributes();

        $values = [];
        foreach($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE ID = '" . self::$Connection->escape_string($this->ID) . "' ";
        $query .= " LIMIT 1 "; 

        $result = self::$Connection->query($query);
        return $result;
    }

    public function delete() {
        $query = "DELETE FROM "  . static::$table . " WHERE ID = " . self::$Connection->escape_string($this->ID) . " LIMIT 1";
        $result = self::$Connection->query($query);
        return $result;
    }

}