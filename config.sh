# import .env variables
export $(grep -v '^#' .env | xargs)

# docker compose exec --user root php-fpm chmod +x -R /var/www/html/wp-content

docker compose run --rm wpcli wp core install --path="/var/www/html" --title="CIOOS" --admin_user=$CLI_ADMIN_USER --admin_password=$CLI_ADMIN_PASSWORD --admin_email=$CLI_ADMIN_EMAIL --url=$BASE_URL
docker compose run --rm wpcli wp core update --path="/var/www/html"

#  Change default tagline.
docker compose run --rm wpcli wp option update blogdescription "A starter WordPress environment built with Docker." --allow-root

#  Turn on debugging.
docker compose run --rm wpcli wp config set WP_DEBUG true --raw --type="constant" --allow-root
docker compose run --rm wpcli wp config set WP_DEBUG_LOG true --raw --type="constant" --allow-root

#  Remove all posts, comments, and terms.
docker compose run --rm wpcli wp site empty --yes --allow-root

#  Remove default plugins and themes.
docker compose run --rm wpcli wp plugin delete hello --allow-root
docker compose run --rm wpcli wp plugin delete akismet --allow-root
docker compose run --rm wpcli wp theme delete twentytwentythree --allow-root
docker compose run --rm wpcli wp theme delete twentytwentyfour --allow-root
docker compose run --rm wpcli wp theme delete twentytwentyfive --allow-root

#  Remove widgets.
docker compose run --rm wpcli wp widget delete recent-posts-2 --allow-root
docker compose run --rm wpcli wp widget delete recent-comments-2 --allow-root
docker compose run --rm wpcli wp widget delete archives-2 --allow-root
docker compose run --rm wpcli wp widget delete search-2 --allow-root
docker compose run --rm wpcli wp widget delete categories-2 --allow-root
docker compose run --rm wpcli wp widget delete meta-2 --allow-root

# Activate the CIOOS theme
docker compose run --rm wpcli wp theme activate cioos-siooc-wordpress-theme

# add plugins
# docker compose run --rm wpcli wp plugin install elementor
docker compose run --rm wpcli wp plugin install wordpress-importer
docker compose run --rm wpcli wp plugin install polylang
docker compose run --rm wpcli wp plugin install all-in-one-wp-migration
docker compose run --rm wpcli wp plugin install duplicator
docker compose run --rm wpcli wp plugin install w3-total-cache
docker compose run --rm wpcli wp plugin install wpfront-notification-bar
docker compose run --rm wpcli wp plugin install disable-author-archives
docker compose run --rm wpcli wp plugin install easy-wp-smtp
docker compose run --rm wpcli wp plugin install lazy-blocks
docker compose run --rm wpcli wp plugin install nextend-smart-slider3-pro
docker compose run --rm wpcli wp plugin install users-customers-import-export-for-wp-woocommerce
docker compose run --rm wpcli wp plugin install wordfence
docker compose run --rm wpcli wp plugin install wp-sri

# update plugins
docker compose run --rm wpcli wp plugin update akismet

# activate plugins
# docker compose run --rm wpcli wp plugin activate elementor
docker compose run --rm wpcli wp plugin activate wordpress-importer
docker compose run --rm wpcli wp plugin activate polylang
docker compose run --rm wpcli wp plugin activate all-in-one-wp-migration
docker compose run --rm wpcli wp plugin activate duplicator
docker compose run --rm wpcli wp plugin activate w3-total-cache
docker compose run --rm wpcli wp plugin activate wpfront-notification-bar
docker compose run --rm wpcli wp plugin activate disable-author-archives
docker compose run --rm wpcli wp plugin activate easy-wp-smtp
docker compose run --rm wpcli wp plugin activate lazy-blocks
docker compose run --rm wpcli wp plugin activate nextend-smart-slider3-pro
docker compose run --rm wpcli wp plugin activate users-customers-import-export-for-wp-woocommerce
docker compose run --rm wpcli wp plugin activate wordfence
docker compose run --rm wpcli wp plugin activate wp-sri

