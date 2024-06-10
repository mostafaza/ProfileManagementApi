<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Projet de Gestion de Profils

Ce projet est une API Laravel pour gérer les profils d'utilisateurs, y compris la création, la mise à jour, la suppression et la récupération des profils actifs.

## Prérequis

- PHP >= 8.0
- Composer
- MySQL ou autre base de données supportée par Laravel

## Installation

1. **Cloner le dépôt :**

   ```bash
   git clone https://github.com/mostafaza/ProfileManagementApi.git

## Installer les dépendances PHP :

```bash
        composer install
```


## Configurez le .env :

```bash
    php artisan key:generate
```
```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nom_de_votre_base_de_donnees
    DB_USERNAME=votre_utilisateur
    DB_PASSWORD=votre_mot_de_passe
```

## Exécutez les migrations et les seeders :

```bash
    php artisan migrate --seed
```
## Configuration du dossier public storage

Le disque public inclus dans le fichier de configuration des systèmes de fichiers de votre application est destiné aux fichiers qui seront accessibles publiquement. Par défaut, le disque public utilise le driver local et stocke ses fichiers dans storage/app/public.

Pour rendre ces fichiers accessibles depuis le web, vous devez créer un lien symbolique de public/storage vers storage/app/public.

```bash
    php artisan storage:link
```

## Exécution de l'application :

```bash
   php artisan serve
```


## Tests :

```bash
    php artisan test
```

<b>Note</b> : Les tests utilisent le trait RefreshDatabase, ce qui signifie qu'ils réactualisent toute la base de données. Veuillez relancer les seeders pour pouvoir utiliser l'application après avoir exécuté les tests :

```
    php artisan db:seed
```

## Routes de l'API :

Connexion admin

```
    POST /api/login
```

Création de profil

```
    POST /api/createProfile
```

Mettre à jour un profil :

```
    PUT /api/updateProfile/{id}
```

Supprimer un profil :

```
    DELETE /api/delProfile/{id}
```

Récupérer les profils actifs :

```
    GET /api/getActiveProfiles
```
## Documentation Postman

<a href="https://documenter.getpostman.com/view/36187956/2sA3XLF4jh" target="_blank"> Cliquez ici </a>

Pour avoir accès à la collection et la manipuler<a href="https://test-entretien-bouhou-mostafa.postman.co/workspace/Test-entretien-Bouhou-Mostafa-W~e35025ca-48a8-4b9d-8b9e-084cc409ac39/collection/36187956-00bf36bb-67b1-458c-bc84-5099449e427c" target="_blank">cliquez ici</a> .

<b>Note</b> : Une fois connectés en tant qu'administrateurs, veuillez mettre la clé générée par Sanctum dans l'en-tête `Authorization` en tant que `Bearer Token` pour les requêtes `createProfile`, `updateProfile`, `delProfile`, `getActiveProfiles` .


