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

### Etudes de l'existant

- [ ] Extraction des données de [ws.meteofrance.com](http://ws.meteofrance.com)
- [ ] Extraction des données de [meteofrance.re](http://www.meteofrance.re/)

### Backend

- [ ] Récupération des régions (France métropole uniquement)
- [ ] Récupération des départements de la France métropolitaine
- [ ] Récupération des départements d'Outre-Mer)
- [ ] Récupération des villes (à comprendre les stations)
- [ ] Récupération des prévisions par pays (France métropolitaine), région, département et ville
- [ ] Récupération des départements de la métropole en vigilance
- [ ] Récupération des informations de vigilance en Outre-Mer
- [ ] Récupération des alertes cycloniques (Outre Mer)

### Frontend

- [ ] Personnalisation du plugin
  - [x] Icône
- [ ] Affichage d'un widget météo en fonction de la prévision affichée
- [ ] Affichage des vigilances
- [ ] Affichage des alertes cycloniques

## Journal de modifications

### v0.0.1a - 23.06.2019

- Initialisation de la classe ressource pour manipuler les ressources distantes
- Documentation technique ([ressources distantes](./infos_meteofrance.md))
- Icône de plugin

### v0.0.0a - 22.06.2019

- Personnalisation de la description du plugin
- Mise en place de la base du plugin via extra-tools
