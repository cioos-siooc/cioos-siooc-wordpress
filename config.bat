echo on
copy cioos-siooc-wordpress-theme wp-app/wp-content/themes/cioos-siooc-wordpress-theme -Recurse
docker-compose run --rm wpcli wp core install --path="/var/www/html" --url="https://national.v7" --title="CIOOS" --admin_user=admin --admin_password=admin --admin_email=foo@bar.com
docker-compose run --rm wpcli wp core update --path="/var/www/html" --url="https://national.v7"

# Activate the CIOOS theme
docker-compose run --rm wpcli wp theme activate cioos-siooc-wordpress-theme

# update plugins
docker-compose run --rm wpcli wp plugin update akismet

# add plugins
docker-compose run --rm wpcli wp plugin install wordpress-importer

# activate plugins
docker-compose run --rm wpcli wp plugin activate wordpress-importer