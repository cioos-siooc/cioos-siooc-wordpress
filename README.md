# CIOOS WordPress Docker Compose

Comes with the following:

- [WordPress and WP CLI](https://hub.docker.com/_/wordpress/)
- [phpMyAdmin](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)
- [MySQL](https://hub.docker.com/_/mysql/)
- Theme development tools

## Requirements

* Docker
* Docker-Compose
* Bash
* Rsync
* Configured `.env`file
* Node 
* composer


## Configuration

Edit the `.env` file to change the default IP address, Docker MySQL root password, Docker WordPress database name and remote MySQL password.

An example .env is provided

```.env
IP=127.0.0.1
DOCKER_DB_PASSWORD=***********************
DOCKER_DB_NAME=wordpress
DOCKER_DB_USER=root
```
Place an SQL file in /wp-data to replace the database of the local site you are spinning up.



## Usage

1. Clone this repository 
2. Start up Docker
   ```
   docker-compose up
   ```
3. Edit your host file
   ```etc/hosts
   # You should have existing entries like this
   127.0.0.1        localhost

   # Below them, add this. Replace `example.test` with the domain name desired and `127.0.0.1` with the IP specified in `.env`.
   127.0.0.1 example.test
   ```
4. Edit the lines in wp-config-local
   ```wp-config-local.php
   define('WP_HOME','http://example.test');
   define('WP_SITEURL','http://example.test');
   ```
5. Wordpress needs you to install a database and get going (see WP CLI)
6. Install the development tools in the theme folder:

   ```sh
   $ composer install
   $ npm install
   ```
   
## Commands

### Starting containers

You can start the containers with the `up` command in daemon mode (by adding `-d` as an argument) or by using the `start` command:

   ```
   docker-compose start
   ```

### Stopping containers

   ```
   docker-compose stop
   ```

### Stop containers

Use `-v` if you need to remove the database volume which is used to persist the database:

   ```
   docker-compose down -v
   ```

If you want to clean everything not currently in use:

   ```shell
   docker system prune --volumes
   ```
   
### Theme dev commands
   ```
   - `composer lint:wpcs` : checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
   - `composer lint:php` : checks all PHP files for syntax errors.
   - `composer make-pot` : generates a .pot file in the `languages/` directory.
   - `npm run compile:css` : compiles SASS files to css.
   - `npm run compile:rtl` : generates an RTL stylesheet.
   - `npm run watch` : watches all SASS files and recompiles them to css when they change.
   - `npm run lint:scss` : checks all SASS files against [CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).
   - `npm run lint:js` : checks all JavaScript files against [JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).
   - `npm run bundle` : generates a .zip archive for distribution, excluding development and system files.
   ```

### WP CLI

The docker compose configuration also provides a service for using the [WordPress CLI](https://developer.wordpress.org/cli/commands/).

Sample command to install WordPress:

   ```
   docker-compose run --rm wpcli core install --url=http://localhost --title=test --admin_user=admin --admin_email=test@example.com
   ```

Or to list installed plugins:

   ```
   docker-compose run --rm wpcli plugin list
   ```

Try adding an alias for the CLI:

   ```
   alias wp="docker-compose run --rm wpcli"
   ```

   This way you can use the CLI command above as follows:

   ```
   wp plugin list
   ```

### phpMyAdmin

You can also visit `http://YOURSITE.THING:8080` to access phpMyAdmin after starting the containers.

The default username is `root`, and the password is the same as supplied in the `.env` file.
