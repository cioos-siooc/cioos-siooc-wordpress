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
* Configured `.env` and `.script-env` files

An example .env

```.env
IP=127.0.0.1
DOCKER_DB_PASSWORD=replace_me_with_a_real_password
DOCKER_DB_NAME=wordpress
```
   
* An example `/scripts/.script-env` file

```.script-env
# Scripting variables
DEV_WORDPRESS_DB_PASSWORD=wordpress
PROD_WORDPRESS_DB_PASSWORD=replace_me_with_a_real_password
```

## Configuration

Edit the `.env` and `scripts/.script-env` files to change the default IP address, Docker MySQL root password, Docker WordPress database name and remote MySQL password.

## Usage

1. Clone this repository and open a terminal in the project directory.

2. To run the shell script to download the production MySQL dump and Wordpress Files:

```shell
bash pull-prod-db-and-files-to-local.sh
```

3. To build and start up Docker Compose and the containers described in `docker-compose.yml`: 

```
docker-compose up --build
```

This creates two new folders next to your `docker-compose.yml` file.

* `wp-data` – used to store and restore database dumps
* `wp-app` – the location of your WordPress application

The containers are now built and running. You should be able to access the WordPress installation with the configured IP in the browser address. By default it is `http://127.0.0.1`.

For convenience you may add a new entry into your hosts file.
e.g.

```etc/hosts
# You should have existing entries like this
127.0.0.1        localhost

# Below them, add this. Replace `example.test` with the domain name desired and `127.0.0.1` with the IP specified in `.env`.
127.0.0.1 example.test
```


## Commands

### Starting containers

You can start the containers with the `up` command in daemon mode (by adding `-d` as an argument) or by using the `start` command:

```
docker-compose start
```

### Stopping containers without removing state

```
docker-compose stop
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

```
define('WP_HOME','http://example.test');
define('WP_SITEURL','http://example.test');
```

### Creating database dumps

```
./export.sh
```

### Developing a Theme

Configure the volume to load the theme in the container in the `docker-compose.yml`:

```
volumes:
  - ./theme-name/trunk/:/var/www/html/wp-content/themes/theme-name
```

### Developing a Plugin

Configure the volume to load the plugin in the container in the `docker-compose.yml`:

```
volumes:
  - ./plugin-name/trunk/:/var/www/html/wp-content/plugins/plugin-name
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

For an easier usage you may consider adding an alias for the CLI:

```
alias wp="docker-compose run --rm wpcli"
```

This way you can use the CLI command above as follows:

```
wp plugin list
```

### phpMyAdmin

You can also visit `http://127.0.0.1:8080` to access phpMyAdmin after starting the containers.

The default username is `root`, and the password is the same as supplied in the `.env` file.