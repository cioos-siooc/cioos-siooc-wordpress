echo on

//docker-compose exec --user root php-fpm chmod +x -R /var/www/html/wp-content

docker-compose run --rm wpcli wp core install --path="/var/www/html" --title="CIOOS" --admin_user=admin --admin_password=admin --admin_email=foo@bar.com
docker-compose run --rm wpcli wp core update --path="/var/www/html"

// Change default tagline.
docker-compose run --rm wpcli wp option update blogdescription "A starter WordPress environment built with Docker." --allow-root

// Turn on debugging.
docker-compose run --rm wpcli wp config set WP_DEBUG true --raw --type="constant" --allow-root
docker-compose run --rm wpcli wp config set WP_DEBUG_LOG true --raw --type="constant" --allow-root

// Remove all posts, comments, and terms.
docker-compose run --rm wpcli wp site empty --yes --allow-root

// Remove default plugins and themes.
docker-compose run --rm wpcli wp plugin delete hello --allow-root
docker-compose run --rm wpcli wp plugin delete akismet --allow-root
docker-compose run --rm wpcli wp theme delete twentyfifteen --allow-root
docker-compose run --rm wpcli wp theme delete twentysixteen --allow-root

// Remove widgets.
docker-compose run --rm wpcli wp widget delete recent-posts-2 --allow-root
docker-compose run --rm wpcli wp widget delete recent-comments-2 --allow-root
docker-compose run --rm wpcli wp widget delete archives-2 --allow-root
docker-compose run --rm wpcli wp widget delete search-2 --allow-root
docker-compose run --rm wpcli wp widget delete categories-2 --allow-root
docker-compose run --rm wpcli wp widget delete meta-2 --allow-root






# Activate the CIOOS theme
docker-compose run --rm wpcli wp theme activate cioos-siooc-wordpress-theme

# add plugins
docker-compose run --rm wpcli wp plugin install wordpress-importer
docker-compose run --rm wpcli wp plugin install elementor
docker-compose run --rm wpcli wp plugin install polylang

# update plugins
docker-compose run --rm wpcli wp plugin update akismet

# activate plugins
docker-compose run --rm wpcli wp plugin activate wordpress-importer
docker-compose run --rm wpcli wp plugin activate elementor
docker-compose run --rm wpcli wp plugin activate polylang