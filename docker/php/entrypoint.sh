#!/bin/bash
set -e

cd /var/www/html

# Gii Extension for model generate (do not use in production)
if [ -d "/var/www/html/models" ]; then
  chgrp -R www-data /var/www/html/models
  chmod -R 775 /var/www/html/models
fi

# Gii Extension for controller generate (do not use in production)
if [ -d "/var/www/html/controllers" ]; then
  chgrp -R www-data /var/www/html/controllers
  chmod -R 775 /var/www/html/controllers
fi

# Gii Extension for views generate (do not use in production)
if [ -d "/var/www/html/views" ]; then
  chgrp -R www-data /var/www/html/views
  chmod -R 775 /var/www/html/views
fi

# Для сборки assets файлов
if [ -d "/var/www/html/web/assets" ]; then
  chgrp -R www-data /var/www/html/web/assets
  chmod -R 775 /var/www/html/web/assets
fi

# На всякий случай мало-ли
echo "🔄 Waiting for MySQL at mysql:3306..."

# Ждём, пока порт не станет доступен
while ! nc -z "mysql" "3306"; do
  echo "⏳ MySQL not ready, retrying in 1s..."
  sleep 1
done

echo "✅ MySQL is ready!"

# Установка зависимостей и выполнение миграций
composer install && php yii migrate --interactive=0

exec "$@"