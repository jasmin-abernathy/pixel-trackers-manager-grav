# Roadmap PTM Grav

## Phase 0 — socle

- [x] dépôt privé séparé ;
- [x] plugin Grav 2.x minimal ;
- [x] manifeste `blueprints.yaml` ;
- [x] configuration par défaut ;
- [x] snapshot local PTM Rules ;
- [x] inventaire des plugins installés/actifs ;
- [x] stockage JSON/YAML sans base SQL ;
- [x] garde-fous de chemin et écriture atomique ;
- [ ] installer et activer le plugin sur un Grav 2.x exécutable ;
- [ ] vérifier PHP 8.3 / 8.4 / 8.5 en situation réelle.

## Phase 1 — connaissance de l'écosystème Grav

- [ ] inventorier systématiquement les plugins Grav liés aux formulaires, analytics, consentement, médias, cartes, paiement, authentification et newsletters ;
- [ ] renseigner `data/grav-plugins.json` ;
- [ ] ajouter `grav_plugin_slugs` dans PTM Rules si cela reste pertinent au niveau commun ;
- [ ] distinguer capacité d'un plugin et preuve réellement observée.

## Phase 2 — premier scan

- [ ] recenser les routes/pages publiques ;
- [ ] scan progressif par petits lots ;
- [ ] analyser le HTML rendu avec PTM Rules ;
- [ ] ignorer les simples liens sortants ;
- [ ] signaler les domaines tiers inconnus ;
- [ ] analyser les formulaires rendus ;
- [ ] conserver l'historique dans `user/data/ptm/scans/` ;
- [ ] tester les faux positifs et faux négatifs.

## Phase 3 — Admin 2.0

- [ ] créer une page PTM dédiée via l'API/Admin 2.0 ;
- [ ] afficher inventaire, progression, observations et historique ;
- [ ] ajouter les actions de scan avec permissions explicites ;
- [ ] ne jamais dépendre de l'ancien Admin Classic.

## Phase 4 — vérification navigateur

- [ ] observer les requêtes déclenchées dynamiquement par JavaScript ;
- [ ] comparer avant choix / refus / acceptation lorsqu'un CMP existe ;
- [ ] conserver cette vérification local-first autant que possible.

## Phase 5 — remédiation / consentement

- [ ] recommandations cliquables ;
- [ ] interopérabilité avec un CMP Grav existant avant de créer une bannière PTM ;
- [ ] prototype de blocage uniquement après fiabilisation du scanner ;
- [ ] refus aussi simple que l'acceptation ;
- [ ] fermeture ≠ consentement.
