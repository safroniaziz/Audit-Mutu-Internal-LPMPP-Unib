#!/bin/bash

# Script deployment untuk server
echo "🚀 Starting deployment..."

# Update composer dependencies
echo "📦 Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

# Install node dependencies
echo "📦 Installing npm dependencies..."
npm ci

# Build assets
echo "🔨 Building assets..."
npm run build

# Cache Laravel
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "✅ Deployment completed!"
