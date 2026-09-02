# Pixel Trackers Manager — Grav

Portage **Grav 2.x** de Pixel Trackers Manager (PTM), développé par **Le Potager du Web**.

> État : `0.0.2-dev` — première baseline réelle intégrée. Ne pas utiliser en production avant validation runtime complète.

## Objectif

Apporter à Grav les principes communs de PTM : audit local-first, détection de traceurs et services tiers, distinction entre preuve observée et intégration potentielle, inventaire des plugins actifs, analyse des formulaires et recommandations explicables.

## Installation de développement

Le dossier du plugin doit être nommé `ptm` et placé dans :

```text
user/plugins/ptm/
```

Le dépôt Git peut conserver son nom long `pixel-trackers-manager-grav` ; pour un test local, clonez ou copiez son contenu dans `user/plugins/ptm/`.

## État du portage — 0.0.2

La première installation réelle de référence est une installation Grav 2.0.22 sous PHP 8.3.33 et Apache, avec Quark 2 1.1.11.

PTM-Grav dispose maintenant :

- d’un snapshot local de PTM Rules 0.2.1 ;
- d’un premier catalogue de **10 profils de plugins Grav** observés dans une installation standard ;
- d’un inventaire qui distingue plugin connu, rôle, nature du traitement potentiel et niveau de revue ;
- d’un stockage JSON local dans `user/data/ptm/` ;
- d’une documentation de baseline et de garde-fous contre les faux positifs.

Le socle ne lance volontairement encore aucun crawl et ne bloque aucune ressource.

## Garde-fous importants

- plugin installé ≠ plugin utilisé ;
- plugin utilisé ≠ service tiers actif ;
- chaîne `recaptcha` trouvée dans le code ou une traduction ≠ reCAPTCHA chargé ;
- nom contenant `github` ≠ requête vers GitHub ;
- ressource embarquée localement ≠ ressource distante ;
- preuve observée ≠ conclusion juridique.

Le futur scanner doit privilégier : configuration réelle → contenu configuré → HTML rendu → réseau navigateur.

## Architecture

- `ptm.php` : point d’entrée du plugin ;
- `blueprints.yaml` : manifeste et configuration ;
- `ptm.yaml` : configuration par défaut ;
- `data/rules.json` : snapshot local de PTM Rules ;
- `data/grav-plugins.json` : profils de plugins Grav ;
- `classes/RuleCatalog.php` : lecture validée du catalogue ;
- `classes/PluginInventory.php` : inventaire et classification des plugins Grav ;
- `classes/FlatFileStorage.php` : stockage JSON local ;
- `docs/BASELINE-GRAV-2.0.22.md` : première baseline réelle ;
- `docs/` : architecture, sécurité et roadmap.

**Aucune base SQL n’est requise.**

## Prochaine validation

1. installer PTM dans la baseline Grav 2.0.22 ;
2. vérifier l’inventaire réel des plugins et leurs états ;
3. ajouter un premier écran Admin2 lisible ;
4. implémenter le premier scan du HTML rendu ;
5. comparer ensuite au réseau navigateur ;
6. enrichir le site de test avec quelques scénarios contrôlés.

## Principes

- local-first ;
- aucun appel GitHub requis pendant un scan ;
- domaines tiers inconnus toujours visibles ;
- stockage flat-file cohérent avec Grav ;
- compatibilité ciblée : Grav 2.x, PHP 8.3+.

## Licence

GPL-2.0-or-later, cohérente avec PTM WordPress, PTM SPIP et PTM Rules.
