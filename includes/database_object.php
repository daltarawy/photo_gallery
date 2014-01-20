<?php
// If it's going to need the database, then it's
// probably smart to require it before we start.
require_once (LIB_PATH . DS . 'database.php');

class DatabaseObject {

    // I'm waiting for Late Static Bindings in PHP 5.3
    // http://www.php.net/lsb
    // Common Database Methods
    public static function find_all() {
        return static::find_by_sql("SELECT * FROM " . static::$table_name);
    }

    // public static function find_by_id($id = 0) {
    // $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id={$id} LIMIT 1");
    // return !empty($result_array) ? array_shift($result_array) : false;
    // }

    public static function find_by_id($id = 0) {
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id=" . $database -> escape_value($id) . " LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_criteria_record($record = null) {
        // check the incoming array
        // sanitized the incoming array both keys and values
        if (isset($record) && $record != null) {
            global $database;
            $record = static::sanitized_attributes($keys = true, $record);
            $attribute_pairs = array();
            foreach ($record as $key => $value) {
                $attribute_pairs[] = "{$key}='{$value}'";
            }

            $sql = "SELECT * FROM " . static::$table_name;
            $sql .= " WHERE ";
            $sql .= join(" and ", $attribute_pairs);
            // echo $sql;
            return static::find_by_sql($sql);
        } else {
            return null;
        }

    }

    public static function find_by_sql($sql = "") {
        global $database;
        $result_set = $database -> query($sql);
        $object_array = array();
        while ($row = $database -> fetch_array($result_set)) {
            $object_array[] = static::instantiate($row);
        }
        return $object_array;
    }

    public static function find_by_page($page_num) {
        global $database;
        return static::find_by_sql("SELECT * FROM " . static::$table_name . " LIMIT " . ($page_num - 1) * ROWS_PER_PAGE . " , " . ROWS_PER_PAGE);
        // return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function count_all() {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $result_set = $database -> query($sql);
        $row = $database -> fetch_array($result_set);
        return array_shift($row);
    }

    private static function instantiate($record) {
        // Could check that $record exists and is an array
        $class_name = get_called_class();
        $object = new $class_name;
        // Simple, long-form approach:
        // $object->id              = $record['id'];
        // $object->username    = $record['username'];
        // $object->password    = $record['password'];
        // $object->first_name = $record['first_name'];
        // $object->last_name   = $record['last_name'];

        // More dynamic, short-form approach:
        foreach ($record as $attribute => $value) {
            if ($object -> has_attribute($attribute)) {
                $object -> $attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute) {
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $this -> attributes);
    }

    protected function attributes() {
        // return an array of attribute names and their values
        // echo "indide protected function attributes() " . "<br />";
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this -> $field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes($keys = false, $record = null) {
        global $database;
        $clean_record = array();
        if ($keys == true && $record != null) {
            // sanitize the keys and values before submitting
            // Note: does not alter the actual value of each attribute
            foreach ($record as $key => $value) {
                $clean_record[$database -> escape_value($key)] = $database -> escape_value($value);
            }
        } else {
            // sanitize only the values before submitting
            foreach ($this->attributes() as $key => $value) {
                $clean_record[$key] = $database -> escape_value($value);
            }
        }
        return $clean_record;
    }

    public function save() {
        // A new record won't have an id yet.
        return isset($this -> id) ? $this -> update() : $this -> create();
    }

    public function create() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this -> sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if ($database -> query($sql)) {
            $this -> id = $database -> insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this -> sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=" . $database -> escape_value($this -> id);
        $database -> query($sql);
        return ($database -> affected_rows() == 1) ? true : false;
    }

    public function delete() {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE id=" . $database -> escape_value($this -> id);
        $sql .= " LIMIT 1";
        $database -> query($sql);
        return ($database -> affected_rows() == 1) ? true : false;
        // NB: After deleting, the instance of User still
        // exists, even though the database entry does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted";
        // but, for example, we can't call $user->update()
        // after calling $user->delete().
    }

}