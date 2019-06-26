<?php

/**
 * Cette classe permet de récolter les ressources distantes provenant de :
 * - ws.metefrance.com
 * - meteofrance.re 
 */

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/class/AlerteMeteoArea.class.php';
require_once dirname(__FILE__) . '/../../../../core/class/AlerteMeteoForecast.class.php';

class AlerteMeteoResource
{
    /**
     * URLs utilisées pour récupérer les ressources distantes
     * @var array
     */
    private $_urls = array(
        // Prévisions
        "forecast" => array(
            // France métropolitaine
            "country" => "http://ws.meteofrance.com/ws/getCarte/france/code/PAYS007/taille/569x533/jour/#jour#.json",
            // Région (France métropolitaine)
            "region" => "http://ws.meteofrance.com/ws/getCarte/france/code/#region#/taille/534x438/jour/#jour#.json",
            // Département (y compris Outre-Mer)
            "department" => "http://ws.meteofrance.com/ws/getCarte/#type#/code/#departement#/taille/500x474/jour/#jour#.json",
            // Ville (à comprendre station)
            "city" => "http://ws.meteofrance.com/ws/getDetail/#type#/#station#.json"
        ),
        // Cartes cyclonique (Outre-Mer uniquement)
        "maps" => array(
            // cyclo genèse
            'genesis' => 'http://files.meteofrance.com/files/reunion/cyclogenese/cyclogenese.png',
            // cyclone
            'hurricane' => 'http://www.meteofrance.re/mf3-re-theme/images/cyclones/carte/#departement#-CYCLONE.png'
        )
    );

    /* * ***********************Méthodes privées*************************** */

    /**
     * Permet de construire une URL pour récupérer des ressources distantes
     *
     * @param string $type Type de données (prévision ou carte)
     * @param string $target Type de ressources demandées
     * @param array $data Données décrivant la ressource à récupérer (optionnel)
     * @return string URL correspondant à la ressource demandée
     */
    private function _forgeUrl(string $type, string $target, array $data = null): string
    {
        $response = $this->_urls[$type][$target];
        // Si il y a des données à insérer
        if (isset($data)) {
            // Pour chaque données
            foreach ($data as $key => $value) {
                // Insérer dans l'URL de la requête
                $response = str_replace('#' . $key . '#', $value, $response);
            }
        }
        // retourne l'URL construite
        return $response;
    }

    /**
     * Récupère une ressource distante
     *
     * @param string $url URL de la ressource distante
     * @return array|null Données récupérées
     */
    private function _getResource(string $url): ?array
    {
        $response = null;
        // démarrage de curl
        $curl = curl_init();
        // renseignement de l'url à consulter
        curl_setopt($curl, CURLOPT_URL, $url);
        // requis pour que les codes d'erreur HTTP soient signalés vers curl_error ($curl)
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        // tentative de récupération des informations
        $raw = curl_exec($curl);
        // récupération d'une' possible erreur
        if (curl_error($curl)) {
            $error_msg = curl_error($curl);
        }
        // fermeture de curl
        curl_close($curl);
        // si erreur
        if (!isset($error_msg)) {
            // TODO - Traitement de l'erreur
        } else {
            $response = json_decode($raw, true);
        }
        return $response;
    }

    /**
     * Récupère la liste des régions en France métropolitaine
     *
     * @return array Liste des régions de la France métropolitaine
     */
    public function getRegions(): array
    {
        $response = array();
        // TODO
        return $response;
    }

    /**
     * Récupère la liste des départements d'une région métropolitaine
     *
     * @param string $region code de la région auxquels sont liés les départements à lister
     * @return array Liste des départements de la France métropolitaine
     */
    public function getMetropolisDepartments(string $region): array
    {
        $response = array();
        // TODO
        return $response;
    }

    /**
     * Récupère la liste des villes d'un département
     *
     * @param bool $metropolis Détermine si il s'agit de départements en France métropolitaine
     * @param string $department code du département auxquels sont liés les villes à lister
     * @return array Liste des villes du département ciblé
     */
    public function getCities(bool $metropolis, string $department): array
    {
        $response = array();
        // TODO
        return $response;
    }

    /**
     * Récupérer une prévision
     *
     * @param bool $metropolis Détermine si il s'agit d'une station en France métropolitaine
     * @param string $type Type de la cible (région, département, ville)
     * @param string $target Identifiant de la cible (code de région, de département ou identifiant de station)
     * @return AlerteMeteoForecast
     */
    public function getForecast(bool $metropolis, string $type, string $target): AlerteMeteoForecast
    {
        $response = null;
        // TODO
        return response;
    }
}
