# Baseline réelle — Grav 2.0.22

## Environnement observé

Première installation Grav réelle utilisée comme référence pour PTM-Grav :

- Grav 2.0.22 ;
- PHP 8.3.33 ;
- Apache ;
- thème Quark 2 1.1.11 ;
- installation encore proche de l’état initial, avant ajout volontaire de services de test.

Aucun secret, compte utilisateur ou fichier privé de l’installation n’est conservé dans ce dépôt.

## Plugins présents dans la baseline

L’installation contient les plugins suivants :

- Admin2 2.1.3 ;
- API 1.0.22 ;
- Email 5.0.7 ;
- Error 2.0.4 ;
- Flex Objects 1.4.10 ;
- Form 9.1.24 ;
- Github Markdown Alerts 2.0.0 ;
- Login 3.9.4 ;
- Problems 3.0.1 ;
- Shortcode Core 6.2.5.

Ces plugins constituent désormais les premiers profils connus de `data/grav-plugins.json`.

## Enseignements pour PTM

### Plugin installé ≠ service actif

Le plugin `Form` contient, dans ses sources et traductions, des références documentaires à des services tels que reCAPTCHA. Ces chaînes ne prouvent pas que le service est configuré ou chargé sur le site.

PTM ne doit donc pas transformer un simple scan statique de tous les fichiers d’un plugin en preuve active.

Ordre de preuve recommandé :

1. inventaire des plugins et de leur configuration ;
2. analyse des pages et formulaires réellement configurés ;
3. HTML public rendu ;
4. ressources réseau réellement chargées dans le navigateur.

### Ressources locales

Admin2 embarque notamment ses polices et ressources d’interface dans le plugin. Leur présence locale ne doit pas être confondue avec un chargement Google Fonts distant.

### Plugins fonctionnels

Des noms comme `Github Markdown Alerts` ne prouvent pas une communication avec GitHub côté visiteur. PTM classe donc les composants fonctionnels locaux sans déduire un service tiers à partir de leur nom.

## Données sensibles

Une installation Grav peut contenir des fichiers privés dans `user/config/`, des comptes et des données runtime. Ils ne doivent jamais être copiés dans les fixtures de PTM.

Pour les prochains jeux de test, utiliser uniquement des extraits neutralisés ou des scénarios synthétiques.

## Prochaine étape

Après validation de PTM sur cette baseline propre, enrichir le site de test avec quelques scénarios volontaires : formulaire local, embed vidéo, service externe, anti-spam/CAPTCHA, analytics et consentement. Les résultats attendus devront être documentés avant de lancer PTM.
