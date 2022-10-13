<?php

namespace App;

class Property extends ActiveRecord
{
    // Database
    protected static $table = 'properties';
    protected static $DBcolumns = ['id', 'tittle', 'price', 'image', 'description', 'bedrooms', 'wc', 'parking', 'datecreated', 'sellers_id'];


    // Messages
    protected static $messageCreated = PROPERTY_REGISTERED;
    protected static $messageUpdated = PROPERTY_UPDATED;
    protected static $messageDeleted = PROPERTY_DELETED;


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
    public function __construct($array = [])
    {
        $this->id = $array['id'] ?? null;
        $this->tittle = $array['tittle'] ?? '';
        $this->price = $array['price'] ?? '';
        $this->image = $array['image'] ?? '';
        $this->description = $array['description'] ?? '';
        $this->bedrooms = $array['bedrooms'] ?? '';
        $this->wc = $array['wc'] ?? '';
        $this->parking = $array['parking'] ?? '';
        $this->datecreated = date('Y/m/d');
        $this->sellers_id = $array['sellers_id'] ?? '';
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
}
