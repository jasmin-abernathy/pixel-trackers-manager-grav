# Pixel Trackers Manager — Grav

Portage **Grav 2.x** de Pixel Trackers Manager (PTM), développé par **Le Potager du Web**.

> État : `0.0.1-dev` — socle initial. Ne pas utiliser en production avant tests sur une installation Grav 2.x exécutable.

## Objectif

Apporter à Grav les principes communs de PTM : audit local-first, détection de traceurs et services tiers, distinction entre preuve observée et intégration potentielle, inventaire des plugins actifs, analyse des formulaires et recommandations explicables.

## Installation de développement

Le dossier du plugin doit être nommé `ptm` et placé dans :

```text
user/plugins/ptm/
```

Le dépôt Git peut conserver son nom long `pixel-trackers-manager-grav` ; pour un test local, clonez ou copiez son contenu dans `user/plugins/ptm/`.

## Architecture initiale

- `ptm.php` : point d'entrée du plugin ;
- `blueprints.yaml` : manifeste et configuration ;
- `ptm.yaml` : configuration par défaut ;
- `data/rules.json` : snapshot local de PTM Rules ;
- `data/grav-plugins.json` : futur catalogue des plugins Grav pertinents ;
- `classes/RuleCatalog.php` : lecture validée du catalogue ;
- `classes/PluginInventory.php` : inventaire des plugins Grav ;
- `classes/FlatFileStorage.php` : stockage JSON local ;
- `docs/` : architecture, sécurité et roadmap.

Les données d'exécution seront stockées dans `user/data/ptm/`. **Aucune base SQL n'est requise.**

## État du portage

Le socle ne lance volontairement aucun scan et ne bloque aucune ressource. La prochaine étape est un test sur une installation Grav 2.x réelle, puis l'inventaire systématique de l'écosystème Grav avant de coder le premier scan progressif.

## Principes

- local-first ;
- aucun appel GitHub requis pendant un scan ;
- plugin installé ≠ traceur actif ;
- preuve observée ≠ conclusion juridique ;
- domaines tiers inconnus toujours visibles ;
- stockage flat-file cohérent avec Grav ;
- compatibilité ciblée : Grav 2.x, PHP 8.3+.

## Licence

GPL-2.0-or-later, cohérente avec PTM WordPress, PTM SPIP et PTM Rules.
