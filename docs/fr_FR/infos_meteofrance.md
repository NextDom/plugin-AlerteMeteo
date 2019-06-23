# Origines des informations

Toutes les ressources utilisées par le plugin résultent d'un rapide reverse-engineering du site de [Météo France Réunion](http://www.meteofrance.re) et de la partie concernant la réunion sur la version mobile du site [WS Météo France](http://ws.meteofrance.com/home#!domtom_DEPT974) et n'a bénéficié d'aucune documentation officielle. 

De ce fait, la façon d'extraire les informations pourrait être inexacte et ne pourront servir de références pour d'autres développement.

### Informations textuelles :

#### Données prévisionnelles globales des départements d'Outre-Mer

- URL : `http://www.meteofrance.re/mf3-rpc-portlet/rest/carte/reunion/DEPT_FRANCE/DEPT#departement#?echeance=#date#&nightMode=#night#`
- Remarques :
  - il n'est pas possible de récupérer directement les données par requête javascript à moins d'écrire les entêtes CORS ou de passer par [cors-anywhere](https://cors-anywhere.herokuapp.com/) ou sinon faire directement du CURL
  - l'extension du site (.re, .yt, etc) importe peu c'est le numéro de département qui détermine le contenu des données
- Format des données : JSON
- Paramètres :
  - `#departement#` : numéro de département (exemple : `974` pour la Réunion).
  - `#date#` : détermine la date des prévisions à récupérer au format `aaaammjjhhmm`. On peut aller jusqu'à J+5 pour les prévisions.
    Les heures et minutes déterminent la période de la journée :
    - `0600` : matin
    - `1200` : après-midi
    - `0000` : nuit, dans ce cas, il faut avancer la date d'un jour pour correspondre à minuit (exemple: les prévisions pour la nuit du 07/06/2019 devront être datées par 201906***08**0000*)
  - `#night#` : détermine si les descriptifs textuels récupérés devront être adaptés au contexte de la nuit. Les valeurs (chaîne de caractères) possibles sont `true` ou `false`

#### Données prévisionnelles de la France métropolitaine

- URL : `http://ws.meteofrance.com/ws/getCarte/france/code/PAYS007/taille/569x533/jour/#jour#.json`
- Format des données : JSON
- Paramètre :
  - `#jour#` : numéro du jour de la prévision (0 pour le jour courant);

#### Données prévisionnelles d'une région (France métropolitaine uniquement)

- URL : `http://ws.meteofrance.com/ws/getCarte/france/code/#region#/taille/534x438/jour/#jour#.json`
- Format des données : JSON
- Paramètres :
  - `#region#` : code de région (récupérable à partir des prévision de la France métropolitaine `result.previsions.ville.carteRegion`)
  - `#jour#` : numéro du jour de la prévision (0 pour le jour courant);

#### Données prévisionnelles d'un département (France métropolitaine et Outre-Mer)

- URL : `http://ws.meteofrance.com/ws/getCarte/#type#/code/#departement#/taille/500x474/jour/#jour#.json`
- Format des données : JSON
- Paramètres :
  - `#type#` : `domtom` ou `france` détermine quelle type de territoire il s'agit
  - `#departement#` : code de département (récupérable à partir des prévisions d'une région : `result.previsions.ville.carteDept`)

#### Données prévisionnelles d'une ville/station (valable pour la France métropolitaine et les Outre-Mer)

- URL : `http://ws.meteofrance.com/ws/getDetail/#type#/#station#.json`
- Format des données : JSON
- Paramètres :
  - `#type#` : `domtom` ou `france` détermine quelle type de territoire il s'agit
  - `#station#` : numéro de la station à cibler (récupérable à partir des prévisions d'une région : `result.previsions.ville.indicatif`)

#### Données sur les vigilances de la Réunion

- URL: `http://www.meteofrance.re/vigilance-reunion/#zone#`
- Format: HTML à extraire
- Paramètre :
  - `#zone#` : identifiant numérique de la zone allant de 1 à 12 en commençant par les terres intérieurs.
  
    ```php
    private $_zones = [
        array (
            'id' => 1,
            'zone' => 'Nord',
            'description' => 'Saint-Denis, Sainte-Marie'
        ),
        array (
            'id' => 2,
            'zone' => 'Est',
            'description' => 'Sainte-Suzanne, Saint-André, Salazie, Bras Panon, Saint-Benoît, Plaine des Palmistes, Sainte-Rose'
        ),
        array (
            'id' => 3,
            'zone' => 'Sud-Est',
            'description' => 'Saint-Joseph, Saint-Philippe'
        ),
        array (
            'id' => 4,
            'zone' => 'Sud',
            'description' => 'Petite-île, Saint-Pierre, Le Tampon, L\'Entre-Deux, Saint-Louis, Cilaos, L\'Etang-Salé, Les Avirons'
        ),
        array (
            'id' => 5,
            'zone' => 'Ouest',
            'description' => 'Saint-Leu, Trois Bassins, Saint-Paul, Le Port, La Possession'
        ),
        array (
            'id' => 6,
            'zone' => 'Zone côtière',
            'description' => 'De Champ Borne au Cap Bernard'
        ),
        array (
            'id' => 7,
            'zone' => 'Zone côtière',
            'description' => 'De la Pointe des Cascades à Champ Borne'
        ),
        array (
            'id' => 8,
            'zone' => 'Zone côtière',
            'description' => 'De La Pointe de la Table à La Pointe des Cascades'
        ),
        array (
            'id' => 9,
            'zone' => 'Zone côtière',
            'description' => 'De La Pointe au Sel à La Pointe de la Table'
        ),
        array (
            'id' => 10,
            'zone' => 'Zone côtière',
            'description' => 'De La Pointe des Aigrettes à La Pointe au Sel'
        ),
        array (
            'id' => 11,
            'zone' => 'Zone côtière',
            'description' => 'De La Pointe des Galets à La Pointe des Aigrettes'
        ),
        array (
            'id' => 12,
            'zone' => 'Zone côtière',
            'description' => 'Du Cap Bernard à La Pointe des Galets'
        )
    ];
    ```

#### Données sur les normales annuelles climatologiques sur une station (Outre-Mer)

- URL : `http://www.meteofrance.re/mf3-rpc-portlet/rest/climat/NORMALES/ANNUELLE/#station#/STATION_CLIM_FR?echeance=#currentyear#`
- Format des données : JSON
- Paramètres :
  - `#station#` : numéro de la station à cibler. Ce numéro peut être récupéré de la prévision globale `previsionLieux.prevision.lieu.id`
  - `#currentyear#` : Date du 1er janvier de l'année suivante celle ciblée (exemple : *01012019* pour les données de l'année 2018)

### Cartes disponibles

#### Départements

##### La Réunion

- URL : `http://www.meteofrance.re/mf3-re-theme/images/contents/meteo/cartessvg/large/#departement#.svg`
- Format de l'image : SVG
- Paramètre :
  - `#departement#` : code de département (exemple : `DEPT974` pour la Réunion)

#### Cyclo-genèse (Outre-Mer)

- URL : `http://files.meteofrance.com/files/reunion/cyclogenese/cyclogenese.png`
- Remarque : la même carte est utilisée pour plusieurs départements d'Outre-Mer
- Format de l'image : PNG

#### Activités cycloniques (Outre-Mer)

- URL : `http://www.meteofrance.re/mf3-re-theme/images/cyclones/carte/#departement#-CYCLONE.png`
- Paramètre :
  - `#departement#` : code de département (exemple : `DEPT974` pour la Réunion)
- Format de l'image : PNG
