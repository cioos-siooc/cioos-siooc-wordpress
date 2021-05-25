# CIOOS WordPress Docker Compose & CIOOS Theme 2021

With this project you can run a local version of your site and test the theme. You are able to add in your site's database, and code to replicate your site, or leave it out and start on a fresh build. The fresh build comes with the needed plugins to get a CIOOS site running.

## Requirements

* Docker
* Docker-Compose
* Configured `.env` and `wp-config.local.php` files

## Contents

* 3 folders:
* * config
* * wp-app
* * * wp-content > plugins 
* * * * all-in-one-wp-migration
* * * * elementor
* * * * polylang
* * * * wordpress-importer
* * * wp-content > themes
* * * * cioos-siooc-wordpress-theme
* * wp-data
* docker-compose.yml file
* dockerfile
* sample.env
* wp-config.local.php

-------------------------------------------------------------------------------

## Usage

### Starting a fresh site to test the theme

Starting from scratch will allow you to test the site with the bare minimum of needed plugins and the theme to get it going.  From a scratch build, you can import your content into the site in a few different ways. You may also start from scratch just to make simple edits to the theme where you don't require the full site to work.

## Configuration - Change the .enviromnment and wp-config.local.php files

1. Clone this repository 

2. Change the `.env`, `hosts` and `wp-config.local.php` files to suit your needs

3. Start up Docker Compose and build the containers.

4. Install a new wordpress site, and apply the theme 

//TODO: add wp-cli scripts to the docker compose file so it installs, and selects the proper theme.

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

Dive into the Wordpress dashboard, and activate the siooc-cioos theme in 

-------------------------------------------------------------------------------

### Importing your site's content

## Use the all-in-one-wp-migration, Elementor templates, or the wordpress-importer to bring content from the live site

**all-in-one-wp-migration**, will allow you to grab all the content on the site and move it into the fresh theme. Wp-migration-pro will allow you to rewrite the entire site and database, as you find it on production, if you chose to. You can pick and chose the portions you want as well.

**wordpress-importer** will get your content only. It will not be styled in the Elementor systm. This can be useful for quick changes

**Elementor templates** allow a page or component built in Elementor to be replicated on another site. THis will keep the Elementor styling, but it will be a long process, as each page needs to be saved, and loaded individually.

## Use Docker

If you have an **SQL database dump**, and the **code files**, you can create a clone of the site in docker. Place the files that your site uses in _wp-app_ and your database in _wp_data_. When you run docker-compose up --rebuild, it will rebuild the site, and it will include the files and database you gave it.

* `wp-data` – here you add the database dump
* `wp-app` – here you copy your existing WordPress code - make sure a wp-config.local.php is included in the code to make it work locally.

You can now use the `up` command:

```
docker-compose up
```

This will create the containers and populate the database with the given dump. You may set your host entry and change it in the database, or you simply overwrite it in `wp-config.local.php`

## Docker- Compose Commands

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


## phpMyAdmin

You can also visit `http://127.0.0.1:8080` to access phpMyAdmin after starting the containers.

The default username is `root`, and the password is the same as supplied in the `.env` file.




<!-- ## WP CLI  - coming soon!

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
``` -->
