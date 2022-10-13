<?php

namespace App;

class Seller extends ActiveRecord
{
    // Database
    protected static $table = 'sellers';
    protected static $DBcolumns = ['id', 'name', 'lastname', 'phone'];

    // Messages
    protected static $messageCreated = SELLER_REGISTERED;
    protected static $messageUpdated = SELLER_UPDATED;
    protected static $messageDeleted = SELLER_DELETED;

    // Attributes
    public $id;
    public $name;
    public $lastname;
    public $phone;


    // Constructor
    public function __construct($array = [])
    {
        $this->id = $array['id'] ?? null;
        $this->name = $array['name'] ?? '';
        $this->lastname = $array['lastname'] ?? '';
        $this->phone = $array['phone'] ?? '';
    }

    // Validations
    public function validate()
    {
        /******* Form Validations *******/
        // Name Validations
        if (!$this->name) {
            self::$errors[] = "El nombre es obligatorio";
        }

        // Lastname Validations
        if (!$this->lastname) {
            self::$errors[] = "El apellido es obligatorio";
        }

        // Phone Validations
        if (!$this->phone) {
            self::$errors[] = "El Teléfono es obligatorio";
        }

        if (!preg_match('/[0-9]{10}/', $this->phone)) {
            self::$errors[] = "Teléfono inválido";
        }

        return self::$errors;
    }
}
