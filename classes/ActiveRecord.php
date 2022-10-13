<?php

namespace App;

class ActiveRecord
{
    // Database
    protected static $db;
    protected static $DBcolumns = [];
    protected static $table = '';

    // Errors
    protected static $errors = [];

    // Messages
    protected static $messageCreated;
    protected static $messageUpdated;
    protected static $messageDeleted;

    /*******  Getters & Setters *******/
    // Set the Database conection
    public static function setDB($database)
    {
        self::$db = $database;
    }

    // Set Image
    public function setImage(string $image)
    {
        // Delete the old image
        if (!is_null($this->id)) {
            $this->deleteImage();
        }
        if ($image) {
            $this->image = $image;
        }
    }

    // Get Errors
    public static function getErrors()
    {
        return static::$errors;
    }

    // Get all from current table from DB
    public static function getAll()
    {
        $query = "SELECT * FROM " . static::$table;
        return self::sqlRequest($query);
    }

    // Get all from current table from DB
    public static function getLimit($limit)
    {
        $query = "SELECT * FROM " . static::$table;
        $query.= " LIMIT " . $limit;
        return self::sqlRequest($query);
    }
    /*****  Getters & Setters END *****/

    // Find 
    public static function findOnDB($rowID)
    {
        //Query to get a Row by id
        $query = "SELECT * FROM " . static::$table . " WHERE id=${rowID}";
        $result = self::sqlRequest($query);

        return array_shift($result);
    }

    // Sends SQL Query to the DB
    public static function sqlRequest(string $query)
    {
        // SQL request to the DB
        $result = self::$db->query($query);

        // Create the new Array of Objects
        $array = [];
        while ($row = $result->fetch_assoc()) {
            $array[] = static::createObject($row);
        }

        // Realese memory
        $result->free();

        //Returns the Array of objects
        return $array;
    }

    // Creates an self object 
    public static function createObject($sqlRow): static
    {
        // Create a new self Object
        $object = new static;

        // Fill the Object attributes
        foreach ($sqlRow as $key => $value) {
            // If the attribute $key exists in the Object
            // Then fill it with the value
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }
        return $object;
    }

    public function saveToDB()
    {
        // If the ID already exists, then Update the Row
        if (!is_null($this->id)) {
            $this->updateRow();
        } else {
            // If there's no ID then Create a New Row
            return $this->createOnDB();
        }
    }

    // Insert a New Row Into Database.currentTable
    public function createOnDB()
    {
        // Sanitize Attributes
        $attributes = $this->sanitizeAttributes();

        // Insert query
        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        $result = self::$db->query($query);

        $this->redirect($result, static::$messageCreated);
    }

    // Update Row
    public function updateRow()
    {
        // Sanitize Attributes
        $attributes = $this->sanitizeAttributes();

        $values = [];
        foreach ($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        // Update query
        $query = "UPDATE " . static::$table . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $result = self::$db->query($query);

        $this->redirect($result, static::$messageUpdated);
    }

    // Delete Row
    public function deleteRow()
    {
        // Then delete the Row from the database
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);

        $this->redirect($result, static::$messageDeleted);
    }

    protected function redirect(bool $queryResult, string $redirectionMessage)
    {
        // If the query was OK then redirect
        if ($queryResult) {
            // If the Row was deleted then remove the image
            if ($redirectionMessage === PROPERTY_DELETED) {
                $this->deleteImage();
            }
            // After the query was successfuly executed go back to admin
            //This header redirects only if there is not any HTML BEFORE it
            redirectToAdmin($redirectionMessage);
        }
    }

    // Delete Image
    public function deleteImage()
    {
        // Check if the Image exists
        if (file_exists(IMAGE_FOLDER . $this->image)) {
            // Then Delete the Image
            unlink(IMAGE_FOLDER . $this->image);
        }
    }

    // Identify and Set DB Attributes
    public function mapAttributes(): array
    {
        $attributes = [];

        foreach (static::$DBcolumns as $attributeName) {
            // If the ColumnName is ID then ignore it.
            if ($attributeName === 'id') continue;

            $attributes[$attributeName] = $this->$attributeName;
        }
        return $attributes;
    }

    // Sanitize Attributes
    public function sanitizeAttributes()
    {
        $attributes = $this->mapAttributes();
        $sanitized = [];

        // escape_string Validates the data sent by the user
        // to avoid sql injections and scripting
        foreach ($attributes as $key => $value) {

            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Validations
    public function validate()
    {
        static::$errors = [];
        /******* Form Validations *******/

        /******* Form Validations END *******/

        return static::$errors;
    }

    // Synchronizes the Object on Memory with the changes done by the user
    public function syncChanges($arrayPost = [])
    {
        foreach ($arrayPost as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
