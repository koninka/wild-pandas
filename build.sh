#!/bin/bash

set_permissions() {
   sudo chmod -R a+rw .
   if egrep -i "^www-data" /etc/group > /dev/null; then
      sudo chown $USER:www-data .
   fi
}

echo -n "Would you like to istall dependencies from composer.json (\"y\" or \"n\", default: \"n\"): "
read answer
if [ "$answer" = "y" ]; then
   composer install
fi

set_permissions

if [[ ! -z "$PANDA_PROD" && $PANDA_PROD -eq 1 ]]; then
   php app/console cache:clear --env=prod --no-debug
   os=$(uname)
   if [ "$os" = "Linux" ]; then
      sed -i 's/app_dev/app/g' web/.htaccess
   elif [ "$os" = "Darwin" ]; then
      sed -i '' 's/app_dev/app/g' web/.htaccess
   fi
   php app/console doctrine:schema:update --force
else
   php app/console cache:clear --env=dev
   php app/console doctrine:database:drop --force
   php app/console doctrine:database:create
   php app/console doctrine:schema:create
   php app/console doctrine:fixtures:load --fixtures=src/SlashStudio/AppBundle/DataFixtures/ORM
fi

php app/console assets:install web --symlink

set_permissions

echo "Done!"
