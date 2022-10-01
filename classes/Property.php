<?php

namespace App;

class Property
{
    // Database
    protected static $db;
    protected static $DBcolumns = ['id', 'tittle', 'price', 'image', 'description', 'bedrooms', 'wc', 'parking', 'datecreated', 'sellers_id'];

    // Errors
    protected static $errors = [];

    // Attributes
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
        $this->image = $propertyArray['image'] ?? '';
        $this->description = $propertyArray['description'] ?? '';
        $this->bedrooms = $propertyArray['bedrooms'] ?? '';
        $this->wc = $propertyArray['wc'] ?? '';
        $this->parking = $propertyArray['parking'] ?? '';
        $this->datecreated = date('Y/m/d');
        $this->sellers_id = $propertyArray['sellers_id'] ?? '';
    }

    /*******  Getters & Setters *******/
    // Set the Database conection
    public static function setDB($database)
    {
        self::$db = $database;
    }

    // Set Image
    public function setImage(string $image)
    {
        if ($image) {
            $this->image = $image;
        }
    }

    // Get Errors
    public static function getErrors()
    {
        return self::$errors;
    }
    /*****  Getters & Setters END *****/


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

        //$result = self::$db->query($query);
        // Returns if the query was successfuly executed
        return self::$db->query($query);
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

    // Validations
    public function validate()
    {
        /******* Form Validations *******/
        // Tittle Validations
        if (!$this->tittle) {
            self::$errors[] = "Debes añadir un título";
        }
        // Price Validations
        if (!$this->price || $this->price < 1) {
            self::$errors[] = "El precio es obligatorio";
        }
        if (strlen($this->price) >= 9) {
            self::$errors[] = "El precio debe ser menor a $this->100,000,000,00";
        }
        // Description Validations
        if (strlen($this->description) < 10) {
            self::$errors[] = "La descripción debe contener 10 caracteres o más";
        }
        // Bedrooms Validations
        if (!$this->bedrooms || $this->bedrooms < 1) {
            self::$errors[] = "El número de habitaciones es obligartorio";
        }

        if ($this->bedrooms >= 10) {
            self::$errors[] = "La cantidad máxima de habitaciones es de 9";
        }
        // WC Validations
        if (!$this->wc || $this->wc < 1) {
            self::$errors[] = "El número de baños es obligartorio";
        }
        if ($this->wc >= 10) {
            self::$errors[] = "La cantidad máxima de baños es de 9";
        }
        // Parking Validations
        if (!$this->parking || $this->parking < 1) {
            self::$errors[] = "El número de estacionamientos es obligartorio";
        }
        if ($this->parking >= 10) {
            self::$errors[] = "La cantidad máxima de estacionamientos es de 9";
        }
        // Seller Validations
        if (!$this->sellers_id) {
            self::$errors[] = "Debes seleccionar un vendedor";
        }

        // Image Validation
        if (!$this->image) {
            self::$errors[] = "La imagen es obligatoria";
        }
        /******* Form Validations END *******/

        return self::$errors;
    }
}
