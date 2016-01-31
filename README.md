# gpx-rev-geocode
Géocodage inversé sur les points d'un fichier GPX (avec la BAN)

## Convertir le GPX en CSV

Un fichier GPX (ici 2022490.gpx) comporte des points géolocalisés et pour chaque point une date/heure et une altitude.
Nous souhaitons récupérer une adresse pour chaque point stocké dans ce fichier, on parle de géocodage inverse (x,y -> adresse)

<img src="/img/carteGpx.jpg" width="400">

Le site d'Etalab https://adresse.data.gouv.fr/api/ propose différents outils qui peuvent nous aider à réaliser ce géocodage inverse. Nous allons nous intéresser à la fonction batch qui permet d'envoyer un csv et de récupérer les adresses associées aux points.

D'abord il faut convertir le ficher gpx en csv ce qui est fait dans le script php fourni.

Pour le lancer : 
```bash
# !! d'abord modifier dans le fichier php le nom du gpx à transformer
php -f gpx2csv.php
```

Ce script permet de passer de notre fichier gpx (format xml) à un fichier csv, le script créé un nouveau fichier 2022490.gpx.csv.

<img src="/img/convertCSV.jpg" width="400">

## Géocodage inverse sur adresse.data.gouv.fr

Ensuite une simple requête curl (fait sous linux) permet de lancer le géocodage inverse en mode batch...

```bash
# définir le chemin absolu du répertoire
path="/Users/ericpommereau/Documents/src/gpxRevGeo"
curl --form "data=@${path}/2022490.gpx.csv" http://api-adresse.data.gouv.fr/reverse/csv/ > 2022490.gpx.csv_rgeo.csv
```

Un nouveau fichier a été créé 2022490.gpx.csv_rgeo.csv, il contient les adresses (les plus proches) associées à chaque point.

<img src="/img/CSVreverse.jpg" width="400">

## Discussions, S.A.V.

Pour discuter de ce tutoriel vous pouvez nous retrouver sur le [forum de la CIMI](http://forum.cimi.ext.minint.fr/viewtopic.php?f=10&t=569) (accessible sur le réseau du MININT).
