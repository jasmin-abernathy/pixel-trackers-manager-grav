# Architecture PTM — Grav

## Principe

PTM Grav est un adaptateur du moteur commun PTM. Il ne doit pas recréer une base SQL sur un CMS flat-file.

```text
PTM Rules
   ↓ snapshot local
PTM Grav
   ├── inventaire des plugins Grav
   ├── analyse des pages rendues
   ├── détection générique des ressources tierces
   ├── analyse des formulaires
   └── stockage JSON dans user/data/ptm/
```

## Stockage

Les données runtime sont prévues dans :

```text
user/data/ptm/
├── environment.json
├── scans/
│   └── <scan-id>.json
└── state/
    └── current-scan.json
```

Le code du plugin ne crée actuellement aucun de ces fichiers tant qu'aucune fonctionnalité ne lui demande explicitement une écriture.

Le stockage JSON utilise une écriture temporaire dans le même dossier puis un renommage atomique. Les chemins contenant `..` ou des caractères non autorisés sont rejetés.

## Grav 2

Le portage cible Grav 2.x et PHP 8.3+. Le cœur repose sur les événements Grav. Une future interface dédiée dans Admin 2.0 devra utiliser les mécanismes API/Admin 2.0 de Grav plutôt que les anciennes pages Twig de l'Admin Classic.

## PTM Rules

`data/rules.json` est un snapshot versionné du dépôt `ptm-rules`. Le plugin n'appelle jamais GitHub pendant l'exécution d'un scan.

## Non-objectifs du socle 0.0.1

- aucun crawl automatique ;
- aucun blocage de scripts ;
- aucune bannière de consentement ;
- aucune conclusion juridique automatique ;
- aucun envoi de données vers Le Potager du Web.
