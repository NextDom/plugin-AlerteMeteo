<?php

/**
 * Structure d'information pour une prévision
 */
class AlerteMeteoForecast
{

    /**
     * Date
     * @var int
     */
    public $date;

    /**
     * Echéance (0 pour le jour courant)
     * @var int
     */
    public $day;

    /**
     * Moment de la journée
     * @var string
     */
    public $moment;

    /**
     * Nom du moment de la journée
     * @var string
     */
    public $name;

    /**
     * Description textuelle de la météo
     * @var string
     */
    public $description;

    /**
     * Code du pictogramme utilisé pour la prévision
     * @var string
     */
    public $picto;

    /**
     * Direction du vent
     * @var int
     */
    public $windDirection;

    /**
     * Vitesse du vent
     * @var int
     */
    public $windSpeed;

    /**
     * Force du vent
     * @var int
     */
    public $windStrength;

    /**
     * Température minimale
     * @var int
     */
    public $temperatureMin;

    /**
     * Température maximale
     * @var int
     */
    public $temperatureMax;

    /**
     * Température à afficher
     * @var int
     */
    public $temperature;

    /**
     * Indice UV
     * @var int
     */
    public $uv;

    /**
     * Probabilité de pluie
     * @var float
     */
    public $rain;

    /**
     * Probabilité de neige
     * @var float
     */
    public $snow;

    /**
     * Probabilité de gel
     * @var float
     */
    public $freeze;

    /**
     * Indice de confiance
     * @var int
     */
    public $trust;

    /**
     * Données affichables
     * @var float
     */
    public $display;

    /**
     * Données complète
     * @var float
     */
    public $complete;

    /**
     * Début du créneau (timestamp)
     * @var int
     */
    public $start;

    /**
     * Fin du créneau (timestamp)
     * @var int
     */
    public $end;

    /**
     * Température de la mer
     * @var int
     */
    public $seaTemperature;

    /**
     * Etat de la mer
     * @var string
     */
    public $seatState;

    /**
     * Structure des informations d'une prévision
     *
     * @param array $raw Données brutes contenant les informations
     * @return void
     */
    function __construct(array $raw)
    {
        // date de la prévision
        $this->date = $raw["date"];
        // jour de la prévision par rapport à la date courante (par défaut 0 pour j+0)
        $this->day = $raw["jour"];
        // moment de la journée
        $this->moment = $raw["moment"];
        // nom du moment de la journée
        $this->name = $raw["name"];
        // description textuelle de la météo
        $this->description = $raw["description"];
        // code picto
        $this->picto = $raw["picto"];
        // direction du vent
        $this->windDirection = $raw["directionVent"];
        // vitesse du vent
        $this->windSpeed = $raw["vitesseVent"];
        // force du vent
        $this->windStrength = $raw["forceRafales"];
        // température minimale
        $this->temperatureMin = $raw["temperatureMin"];
        // température maximale
        $this->temperatureMax = $raw["temperatureMax"];
        // température à afficher
        $this->temperature = $raw["temperatureCarte"];
        // indice uv
        $this->uv = $raw["indiceUV"];
        // probabilité de pluie
        $this->rain = $raw["probaRain"];
        // probabilité de neige
        $this->snow = $raw["probaNeige"];
        // probabilité de gel
        $this->freeze = $raw["probaGel"];
        // indice de confiance
        $this->trust = $raw["indiceConfiance"];
        // témoin d'affichage
        $this->display = $raw["affichable"];
        // témoin de  complétion des données
        $this->complete = $raw["complete"];
        // créneau de début
        $this->start = $raw["creneauDebutTs"];
        // créneau de fin
        $this->end = $raw["creneauFinTs"];
        // température de la mer
        $this->seaTemperature = $raw["temperatureMer"];
        // état de la mer
        $this->seatState = $raw["etatMer"];
    }

    /**
     * Extrait les prévisions sur 10 jours
     *
     * @param array $data
     * @return array Tableau de prévision sur 10 jours
     */
    public static function getResumesForecast(array $data): array
    {
        $response = array();
        // Si des données de prévisions sont disponibles
        if (array_key_exists("resumes", $data) && $data["resumes"] != null && sizeof($data["resumes"]) > 0) {
            // on parcourt la liste des prévision disponibles
            foreach ($data["resumes"] as $forecast) {
                $response[] = new AlerteMeteoForecast($forecast);
            }
        }
        return $response;
    }

    /**
     * Extrait les prévisions sur 5 jours
     *
     * @param array $data
     * @return array Tableau de prévision sur 5 jours (matin et midi)
     */
    public static function getForecast(array $data): array
    {
        $response = array();
        // Si des données de prévisions sont disponibles
        if (array_key_exists("previsions", $data) && $data["previsions"] != null && sizeof($data["previsions"]) > 0) {
            // on parcourt la liste des prévision disponibles
            foreach ($data["previsions"] as $forecast) {
                $response[] = new AlerteMeteoForecast($forecast);
            }
        }
        return $response;
    }

    /**
     * Extrait les prévisions sur 48 heures
     *
     * @param array $data
     * @return array Tableau de prévision sur 48 heures sur des palliers de 3 heures
     */
    public static function get48HForecast(array $data): array
    {
        $response = array();
        // Si des données de prévisions sont disponibles
        if (array_key_exists("previsions48h", $data) && $data["previsions48h"] != null && sizeof($data["previsions48h"]) > 0) {
            // on parcourt la liste des prévision disponibles
            foreach ($data["previsions48h"] as $forecast) {
                $response[] = new AlerteMeteoForecast($forecast);
            }
        }
        return $response;
    }
}
