# CIOOS WordPress Docker Compose

With this project you can quickly run the following:

- [WordPress and WP CLI](https://hub.docker.com/_/wordpress/)
- [phpMyAdmin](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)
- [MySQL](https://hub.docker.com/_/mysql/)

## Requirements

* Docker
* Docker-Compose
* Bash
* Rsync
* Configured `.env` and `wp-config.local.php` files

-------------------------------------------------------------------------------

## Usage

1. Clone this repository 

2. Change the `.enviromnment`, `hosts` and `wp-config.local.php` files to suit your needs

3. Start up Docker Compose and build the containers.

4. Install a new wordpress site, and apply the theme 

//TODO: add wp-cli scripts to the docker compose file so it installs, and selects the proper theme.

## Configuration - Change the .enviromnment and wp-config.local.php files

### .env

Edit the `.env` file to change the 
- default IP address
- Docker MySQL root password
- Docker WordPress database name and remote MySQL password.

#### An example .env

```.env
IP=127.0.0.1
DOCKER_DB_PASSWORD=replace_me_with_a_real_password
DOCKER_DB_NAME=wordpress
```
### wp-config.local.php

Here you will set your URL for your local site

```
define('WP_HOME','https://cioos.local');
define('WP_SITEURL','https://cioos.local');
```
### hosts

For convenience you may add a new entry into your hosts file.

```etc/hosts
# You should have existing entries like this
127.0.0.1        localhost

# Below them, add this. Replace `example.test` with the domain name desired and `127.0.0.1` with the IP specified in `.env`.

127.0.0.1 cioos.local
```
### Building the containers for the first time
```
docker-compose up --build
```

This creates an uninstalled version of wordpress.

The containers are now built and running. You should be able to access the WordPress installation with the configured IP in the browser address, or URL.

### Install wordpress

Follow the instructions to install the wordpress core to your local drive. 

### Activate the theme

Dive into the Wordpress dashboard, and activate the siooc-cioos theme

-------------------------------------------------------------------------------

## Commands

### Stopping containers without removing state

```
docker-compose stop
```

### Starting containers

You can start the containers with the `up` command in daemon mode (by adding `-d` as an argument) or by using the `start` command:

```
docker-compose start
```

### Stop containers and remove volumes

Use `-v` if you need to remove the database volume which is used to persist the database:

```
docker-compose down -v --remove-orphans
```

If you want to clean everything not currently in use:

```shell
docker system prune --volumes
```

### Project from existing Wordpress source

Copy the `docker-compose.yml` file into a new directory. In the directory you create two folders:

* `wp-data` – here you add the database dump
* `wp-app` – here you copy your existing WordPress code

You can now use the `up` command:

```
docker-compose up
```

This will create the containers and populate the database with the given dump. You may set your host entry and change it in the database, or you simply overwrite it in `wp-config.php` by adding:

## Developing or editing a Theme

If you open the wordpress theme in your dev environment to change the files, you may use node and NPM to run some scripts, in a console, in the theme folder itself. The CSS is made by compiling the SASS pre-process scripts to make the changes.

I use `npm run watch` to look for sass changes, and create the CSS files as I need them.
  
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


## WP CLI

The docker compose configuration also provides a service for using the [WordPress CLI](https://developer.wordpress.org/cli/commands/).

Sample command to install WordPress:

```
docker-compose run --rm wpcli core install --url=http://localhost --title=test --admin_user=admin --admin_email=test@example.com
```

Or to list installed plugins:

```
docker-compose run --rm wpcli plugin list
```

For an easier usage you may consider adding an alias for the CLI:

```
alias wp="docker-compose run --rm wpcli"
```

This way you can use the CLI command above as follows:

```
wp plugin list
```

## phpMyAdmin

You can also visit `http://127.0.0.1:8080` to access phpMyAdmin after starting the containers.

The default username is `root`, and the password is the same as supplied in the `.env` file.