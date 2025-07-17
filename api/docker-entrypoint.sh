#!/bin/sh
set -e

echo "🔧 Correction des permissions (var, vendor, public)..."
chown -R www-data:www-data var vendor public

# Lancement de Symfony etc. (cf. message précédent)
exec "$@"
