# Changelog

## Guide des numéros de versions

Les versions de l’application se déclinent sous la forme **`w.x.y[z]`** :

- **`w`** : Numéro de version stable
- **`x`** : Numéro de version d'interface graphique depuis la version stable
- **`y`** : Numéro de version de backend depuis la version stable
- **`z`** : Indicateur de stabilité de la version (**`a`**: alpha, **`b`** : beta, **`rc`** : release candidate),

Les numéros y et z sont remis à 0 lorsque l’on change de version stable. 
L'absence d'indicateur de stabilité correspond à une version stable.

## Liste de choses à faire

### Backend

- [ ] Extraction des données de [ws.meteofrance.com](http://ws.meteofrance.com)
- [ ] Extraction des données de [meteofrance.re](http://www.meteofrance.re/)
- [ ] Récupération des régions (France métropole uniquement)
- [ ] Récupération des départements (France métropolitaine)
- [ ] Récupération des départements (Outre-Mer)
- [ ] Récupération des stations (villes)
- [ ] Récupération des prévisions par station
- [ ] Récupération des départements de la métropole en vigilance
- [ ] Récupération des informations de vigilance en Outre-Mer
- [ ] Récupération des alertescyclonique (Outre Mer)

### Frontend

- [ ] Affichage d'un widget météo en fonction de la prévision affichée
- [ ] Affichage des vigilances
- [ ] Affichage des alertes cycloniques

## Journal de modifications

### v0.0.0a - 22.06.2019

- Personnalisation de la description du plugin
- Mise en place de la base du plugin via extra-tools
