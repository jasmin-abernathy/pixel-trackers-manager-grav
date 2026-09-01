# Sécurité — PTM Grav

## Principes du socle

- aucune URL arbitraire n'est encore acceptée par le scanner ;
- aucun secret n'est stocké dans le dépôt ;
- aucun appel réseau n'est effectué par le catalogue de règles ;
- les données runtime vivent hors du dossier du plugin, dans `user/data/ptm/` ;
- les écritures JSON utilisent un fichier temporaire et un renommage atomique ;
- les chemins relatifs contenant `..` sont refusés ;
- les résultats d'audit ne doivent jamais être interprétés comme une conclusion juridique automatique.

## Avant le premier crawl

Le futur récupérateur HTTP devra notamment imposer : domaine du site uniquement, limite de taille, limite de redirections, délai d'attente, validation des redirections et User-Agent explicite.

## Admin 2.0

Les futures opérations sensibles devront passer par l'API Grav avec authentification et permissions, sans endpoint public de scan ou d'écriture.
