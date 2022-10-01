<?php

namespace App;

class Property
{
    public $id;
    public $tittle;
    public $price;
    public $description;
    public $bedrooms;
    public $wc;
    public $parking;
    public $datecreated;
    public $sellers_id;

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
        $this->datecreated = $propertyArray['datecreated'] ?? '';
        $this->sellers_id = $propertyArray['sellers_id'] ?? '';
    }
}
