<?php

/**
 * Cette classe permet de récolter les ressources distantes provenant de :
 * - ws.metefrance.com
 * - meteofrance.re 
 */
class AlerteMeteoResources
{
    /**
     * URLs utilisées pour récupérer les ressources distantes
     * @var array
     */
    private $_urls = array(
        // Prévisions
        "forecast" => array (
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
        "maps" => array (
            // cyclo genèse
            'genesis' => 'http://files.meteofrance.com/files/reunion/cyclogenese/cyclogenese.png',
            // cyclone
            'hurricane' => 'http://www.meteofrance.re/mf3-re-theme/images/cyclones/carte/#departement#-CYCLONE.png'
        )
    );

    /*     * ***********************Méthodes privées*************************** */

    /**
     * Permet de construire une URL pour récupérer des ressources distantes
     *
     * @param string $type Type de données (prévision ou carte)
     * @param string $target Type de ressources demandées
     * @param array $data Données décrivant la ressource à récupérer (optionnel)
     * @return string URL correspondant à la ressource demandée
     */
    private function _forgeUrl (string $type, string $target, array $data = null): string {
        $response = $this->_urls['cors'] . $this->_urls[$target];
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

}