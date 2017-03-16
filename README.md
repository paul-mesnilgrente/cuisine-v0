# cuisine

## Install

```bash
git clone git@github.com:paul-mesnilgrente/cuisine.git
cd cuisine
composer update
php app/console doctrine:schema:update --force
php app/console doctrine:fixtures:load
php app/console assetic:dump --env=prod --no-debug
rm -rf app/cache/* app/logs/*
sudo chown -R www-data:www-data app/logs app/cache web/uploads
cd ../
mv cuisine /var/www/
```

Créer un virtualhost apache.
