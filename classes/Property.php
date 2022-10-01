<?php

namespace App;

class Property
{
    // Database
    protected static $db;
    protected static $DBcolumns = ['id', 'tittle', 'price', 'image', 'description', 'bedrooms', 'wc', 'parking', 'datecreated', 'sellers_id'];

    public $id;
    public $tittle;
    public $price;
    public $image;
    public $description;
    public $bedrooms;
    public $wc;
    public $parking;
    public $datecreated;
    public $sellers_id;

    // Constructor
    public function __construct($propertyArray = [])
    {
        $this->id = $propertyArray['id'] ?? '';
        $this->tittle = $propertyArray['tittle'] ?? '';
        $this->price = $propertyArray['price'] ?? '';
        $this->image = $propertyArray['image'] ?? 'image.jpg';
        $this->description = $propertyArray['description'] ?? '';
        $this->bedrooms = $propertyArray['bedrooms'] ?? '';
        $this->wc = $propertyArray['wc'] ?? '';
        $this->parking = $propertyArray['parking'] ?? '';
        $this->datecreated = date('Y/m/d');
        $this->sellers_id = $propertyArray['sellers_id'] ?? '';
    }

    // Set the Database conection
    public static function setDB($database)
    {
        self::$db = $database;
    }


    // Insert a New Property Into Database.Properties
    public function saveToDB()
    {
        // Sanitize Attributes
        $attributes = $this->sanitizeAttributes();


        // Insert query
        $query = " INSERT INTO properties ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        $result = self::$db->query($query);
    }

    // Identify and Set DB Attributes
    public function mapAttributes(): array
    {
        $attributes = [];

        foreach (self::$DBcolumns as $attributeName) {
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
}
