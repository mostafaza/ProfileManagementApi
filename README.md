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

## Exécution de l'application :

```bash
   php artisan serve
```


## Tests :

```bash
    php artisan test
```

## Routes de l'API :

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
    DELETE /api/deleteProfile/{id}
```

Récupérer les profils actifs :

```
    GET /api/profiles/active
```
## Postman

Tout est configuré sur Postman. Vous pouvez retrouver la collection Postman via

<a href="https://test-entretien-bouhou-mostafa.postman.co/workspace/Test-entretien-Bouhou-Mostafa-W~e35025ca-48a8-4b9d-8b9e-084cc409ac39/collection/36187956-00bf36bb-67b1-458c-bc84-5099449e427c">ce lien</a>



