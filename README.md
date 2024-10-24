# Guide d'installation

Ce guide vous permettra d'installer et de configurer rapidement le projet.

## Prérequis

- Docker et Docker Compose installés sur votre machine
- Un éditeur de texte pour modifier le fichier .env

## Étapes d'installation

1. Configuration du fichier .env

   - Le fichier .env est déjà pré-configuré pour un lancement immédiat
   - Aucune modification n'est nécessaire pour un premier démarrage

2. Lancement des conteneurs Docker

   ```bash
   cd /chemin/vers/le/projet
   docker-compose up --build
   ```

3. Réinitialisation de la base de données

   ```bash
   docker-compose exec php php /var/www/html/private/db-reset.php
   ```

4. Insertion des données initiales

   ```bash
   docker-compose exec php php /var/www/html/private/db-insert.php
   ```

5. Accès à l'application
   - Ouvrez votre navigateur
   - Accédez à `http://localhost:80`

## Support

En cas de problème lors de l'installation, assurez-vous que :

- Les ports ne sont pas déjà utilisés par d'autres services
- Docker est bien démarré sur votre machine
- Tous les services Docker sont correctement lancés
