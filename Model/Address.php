<?php

class Address{
    private $addressLine1;
    private $addressLine2;
    private $postcode;
    private $city;
    private $state;
    private $country;
    
    public function __construct(string $addressLine1, string $addressLine2, string $postcode, string $city, string $state, string $country) {
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }
    
    public function getAddressLine1(): string {
        return $this->addressLine1;
    }

    public function getAddressLine2(): string {
        return $this->addressLine2;
    }

    public function getPostcode(): string {
        return $this->postcode;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function getState(): string {
        return $this->state;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function setAddressLine1(string $addressLine1): void {
        $this->addressLine1 = $addressLine1;
    }

    public function setAddressLine2(string $addressLine2): void {
        $this->addressLine2 = $addressLine2;
    }

    public function setPostcode(string $postcode): void {
        $this->postcode = $postcode;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }

    public function setState(string $state): void {
        $this->state = $state;
    }

    public function setCountry(string $country): void {
        $this->country = $country;
    }



}

