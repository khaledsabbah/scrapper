
apt-get update && apt-get install -y --no-install-recommends git zip unzip curl nano
curl --silent --show-error https://getcomposer.org/installer | php
php composer.phar install
    
# install from nodesource using apt-get
# https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-an-ubuntu-14-04-server
curl -sL https://deb.nodesource.com/setup_8.x | bash -
apt-get install -y nodejs
apt-get install -y build-essential
npm install
php composer.phar dump-autoload
php artisan config:clear
php artisan cache:clear
chmod 777 -R /var/www/html/storage/logs/
chmod 777 -R /var/www/html/storage/framework/views
