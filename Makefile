THIS_FILE := $(lastword $(MAKEFILE_LIST))

cs:
	php-cs-fixer fix --verbose

cs-dry-run:
	php-cs-fixer fix --verbose --dry-run

c-inst:
	composer install

dev: set-permissions cache-dev install-assets
	$(MAKE) -f $(THIS_FILE) set-permissions

prod: set-permissions cache-prod dump install-assets
	$(MAKE) -f $(THIS_FILE) set-permissions

set-permissions:
	sudo chmod -R ug+rw .
	sudo chmod -R a+rw app/cache app/logs

clear-cache-dev: set-permissions cache-dev
	$(MAKE) -f $(THIS_FILE) set-permissions

clear-cache-prod: set-permissions cache-prod
	$(MAKE) -f $(THIS_FILE) set-permissions

cache-dev:
	php app/console cache:clear --env=dev

cache-prod:
	php app/console cache:clear --env=prod --no-debug

update-db:
	php app/console doctrine:schema:update --force --dump-sql

reload-db:
	php app/console doctrine:database:drop --force
	php app/console doctrine:database:create
	php app/console doctrine:schema:create

load-fixtures:
	php app/console doctrine:fixtures:load

dump:
	composer dump-autoload --optimize
	php app/console assetic:dump --env=prod --no-debug

install-assets: install-web-assets install-mopa-assets

install-web-assets:
	php app/console assets:install web --symlink

install-mopa-assets:
	php app/console mopa:bootstrap:symlink:less
	php app/console mopa:bootstrap:install:font