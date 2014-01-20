<?php
class ClassObject {


    public static function instantiate_by_record($record) {
        // Could check that $record exists and is an array
        $class_name = get_called_class();
        $object = new $class_name;
        // More dynamic, short-form approach:
        foreach ($record as $attribute => $value) {
            if (array_key_exists($attribute, get_class_vars(get_class($object)))) {
                $object -> $attribute = $value;
            }
        }
        return $object;
    }

}
