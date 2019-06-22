# Origines des informations

Toutes les ressources utilisées par le plugin résultent d'un rapide reverse-engineering du site de [Météo France Réunion](http://www.meteofrance.re) et de la partie concernant la réunion sur la version mobile du site [WS Météo France](http://ws.meteofrance.com/home#!domtom_DEPT974) et n'a bénéficié d'aucune documentation officielle. De ce fait, la façon d'extraire les informations pourrait être inexacte et ne pourront servir de références pour d'autres développement.

### Informations textuelles :

#### Données prévisionnelles globales

- URL : `http://www.meteofrance.re/mf3-rpc-portlet/rest/carte/reunion/DEPT_FRANCE/DEPT974?echeance=#date#&nightMode=#night#`
- Remarque : il n'est pas possible de récupérer directement les données par requête javascript à moins d'écrire les entêtes CORS ou de passer par [cors-anywhere](https://cors-anywhere.herokuapp.com/)
- Format des données : JSON
- Paramètres :
  - `#date#` : détermine la date des prévisions à récupérer au format `aaaammjjhhmm`. On peut aller jusqu'à J+5 pour les prévisions.
    Les heures et minutes déterminent la période de la journée :
    - `0600` : matin
    - `1200` : après-midi
    - `0000` : nuit, dans ce cas, il faut avancer la date d'un jour pour correspondre à minuit (exemple: les prévisions pour la nuit du 07/06/2019 devront être datées par 201906***08**0000*)
  - `#night#` : détermine si les descriptifs textuels récupérés devront être adaptés au contexte de la nuit. Les valeurs (chaîne de caractères) possibles sont `true` ou `false`

#### Données prévisionnelles d'une station

- URL : `http://ws.meteofrance.com/ws/getDetail/domtom/#station#.json`
- Format des données : JSON
- Paramètre :
  - `#station#` : numéro de la station à cibler. Ce numéro peut être récupéré de la prévision globale `previsionLieux.prevision.lieu.id`

#### Données sur les vigilances

- URL: `http://www.meteofrance.re/vigilance-reunion/#zone#`
- Format: HTML à extraire
- Paramètre :
  - `#zone#` : identifiant numérique de la zone allant de 1 à 12 en commençant par les terres intérieurs. (cf. `meteoRE._zones` dans `core/class/meteoRE.class.php` pour les correspondances)

#### Données sur les normales annuelles climatologiques sur une station

- URL : `http://www.meteofrance.re/mf3-rpc-portlet/rest/climat/NORMALES/ANNUELLE/#station#/STATION_CLIM_FR?echeance=#currentyear#`
- Format des données : JSON
- Paramètres :
  - `#station#` : numéro de la station à cibler. Ce numéro peut être récupéré de la prévision globale `previsionLieux.prevision.lieu.id`
  - `#currentyear#` : Date du 1er janvier de l'année suivante celle ciblée (exemple : *01012019* pour les données de l'année 2018)

### Cartes disponibles

#### Carte de l'île

- URL : `http://www.meteofrance.re/mf3-re-theme/images/contents/meteo/cartessvg/large/DEPT974.svg`
- Format de l'image : SVG

#### Cyclo-genèse

- URL : `http://files.meteofrance.com/files/reunion/cyclogenese/cyclogenese.png`
- Format de l'image : PNG

#### Activités cycloniques

- URL : `http://www.meteofrance.re/mf3-re-theme/images/cyclones/carte/DEPT974-CYCLONE.png`
- Format de l'image : PNG
