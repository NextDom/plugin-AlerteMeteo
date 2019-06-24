<?php

/**
 * Structure d'information sur une zone géographique
 */
class AlerteMeteoArea
{

    /**
     * Code INSEE
     * @var int
     */
    public $insee;

    /**
     * Identifiant de la station liée
     * @var int
     */
    public $id;

    /**
     * Type de zone géographique
     * @var string
     */
    public $type;

    /**
     * Nom de la zone géographique
     * @var string
     */
    public $name;

    /**
     * Code postal
     * @var int
     */
    public $zip;

    /**
     * Code de département
     * @var string
     */
    public $departmentCode;

    /**
     * Nom du département
     * @var string
     */
    public $departmentName;

    /**
     * Code de la région
     * @var string
     */
    public $regionCode;

    /**
     * Nom de la région
     * @var string
     */
    public $regionName;

    /**
     * Structure des informations d'une zone géographique
     *
     * @param array $raw Données brutes contenant les informations
     * @return void
     */
    function __constructor(array $raw)
    {
        // code insee
        $this->insee = $raw["insee"];
        // identifiant de la station
        $this->id = $raw["indicatif"];
        // type de zone géographique
        $this->type = $raw["type"];
        // nom de la zone géographique
        $this->name = $raw["name"];
        // code postal
        $this->zip = $raw["codePostal"];
        // code de département
        $this->departmentCode = $raw["carteDept"];
        // code de département
        $this->departmentName = $raw["nomDept"];
        // code de région
        $this->regionCode = $raw["carteRegion"];
        // code de région
        $this->regionName = $raw["region"];
    }

    /**
     * Extrait les informations d'une zone géographique
     *
     * @param array $data Données brutes provenant d'une ressource distante
     * @return AlerteMeteoArea Données structurées de la zone géographique si disponible, null sinon
     */
    public static function getArea(array $data): ?AlerteMeteoArea
    {
        // Si il existe des informations sur la zone géographique
        if (array_key_exists("ville", $data)) {
            return new AlerteMeteoArea($data["ville"]);
        // Pas d'information extractible
        } else {
            return null;
        }
    }
}
