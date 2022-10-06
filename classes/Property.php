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
        $this->sellers_id = $propertyArray['sellers_id'] ?? 1;
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
        // Delete the old image
        if (isset($this->id)) {
            $this->deleteImage();
        }
        if ($image) {
            $this->image = $image;
        }
    }

    // Get Errors
    public static function getErrors()
    {
        return self::$errors;
    }

    // Get all Properties from DB
    public static function getAllProperties()
    {
        $query = "SELECT * FROM properties";
        return self::sqlRequest($query);
    }
    /*****  Getters & Setters END *****/

    // Find Property
    public static function findProperty($propertyID)
    {
        //Query to get the property by id
        $query = "SELECT * FROM properties WHERE id=${propertyID}";
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
            $array[] = self::createObject($row);
        }

        // Realese memory
        $result->free();

        //Returns the Array of objects
        return $array;
    }

    // Creates an self object 
    public static function createObject($sqlRow): self
    {
        // Create a new Property Object
        $object = new self;

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
        // If the ID already exists, then Update the Property
        if (isset($this->id)) {
            $this->updateProperty();
        } else {
            // If there's no ID then Create a New Property
            return $this->createProperty();
        }
    }

    // Insert a New Property Into Database.Properties
    public function createProperty()
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

    // Update Property
    public function updateProperty()
    {
        // Sanitize Attributes
        $attributes = $this->sanitizeAttributes();

        $values = [];
        foreach ($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        // Update query
        $query = "UPDATE properties SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        // if the query was successfuly executed then Go to Admin
        if (self::$db->query($query)) {
            // After the property is updated go back to admin
            //This header redirects only if there is not any HTML BEFORE it
            redirectToAdmin(PROPERTY_UPDATED);
        }
    }

    // Delete Property
    public function deleteProperty()
    {
        // Then delete the property from the database
        $query = "DELETE FROM properties WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        if (self::$db->query($query)) {
            $this->deleteImage();

            // After the property is deleted go back to admin
            //This header redirects only if there is not any HTML BEFORE it
            redirectToAdmin(PROPERTY_DELETED);
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
            self::$errors[] = "El precio debe ser menor a $100,000,000,00";
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
