#!/bin/bash

WP_CMD="docker-compose run --rm wpcli wp"
$WP_CMD core install --path="/var/www/html" --url="http://localhost:8000" --title="Local Wordpress By Docker" \
    --admin_user=admin --admin_password=secret --admin_email=foo@bar.com

$WP_CMD core update --path="/var/www/html" --url="http://localhost:8000"

# Windows Docker copy of the theme directory into wp-app directory
docker cp cioos-siooc-wordpress-theme/ cioos-siooc-wordpress_wp_1:/var/www/html/wp-content/themes

# Linux file copy option
export VOL_WP_APP=`sudo docker volume inspect cioos-siooc-wordpress_wp-app | jq -r -c '.[] | .Mountpoint'`
# cp -R cioos-siooc-wordpress-theme/ $VOL_WP_APP/var/www/html/wp-content/themes

# Activate the CIOOS theme
$WP_CMD theme activate cioos-siooc-wordpress-theme

# update plugins
$WP_CMD plugin update akismet

# add plugins
$WP_CMD plugin install all-in-one-wp-migration
$WP_CMD plugin install disable-author-archives
$WP_CMD plugin install wordfence

