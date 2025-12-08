#!/usr/bin/env bash

echo "🚀 Démarrage du déploiement Laravel sur Render"

# Installer les dépendances
composer install --no-dev --optimize-autoloader

# Générer la clé d'application
php artisan key:generate --force

# Optimiser l'application
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exécuter les migrations (optionnel - mieux via webhook)
# php artisan migrate --force

echo "✅ Build terminé"